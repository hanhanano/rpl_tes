<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;  
use App\Exports\PublicationExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ZipArchive;

class PublicationExportController extends Controller
{
    // Export per publication
    public function export($slug_publication)
    {
        // 1. Ambil data publikasi
        $publication = Publication::with(['stepsplans.stepsFinals.struggles'])->where('slug_publication', $slug_publication)->firstOrFail();

        // 2. Export Excel
        $excelFileName = sprintf(
            "%s_%s.xlsx",
            str_replace(' ', '_', $publication->publication_name),
            str_replace(' ', '_', $publication->publication_report)
        );
        $excelPath = "exports/{$excelFileName}";
        // File Excel disimpan di storage/app/exports
        Excel::store(new PublicationExport($slug_publication), $excelPath);

        // 3. Buat file ZIP
        $zipFileName = sprintf(
            "%s_%s.zip",
            str_replace(' ', '_', $publication->publication_name),
            str_replace(' ', '_', $publication->publication_report)
        );
        $zipPath = "exports/{$zipFileName}";
        $zip = new ZipArchive;

        // Pastikan direktori 'exports' ada
        if (!Storage::exists('exports')) {
            Storage::makeDirectory('exports');
        }

        // Buka file zip untuk ditambahkan isinya
        if ($zip->open(Storage::path($zipPath), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            // Tambahkan file Excel ke dalam zip
            // Menggunakan Storage::path() untuk mendapatkan path absolut yang benar
            $excelFullPath = Storage::path($excelPath);
            if (file_exists($excelFullPath)) {
                $zip->addFile($excelFullPath, $excelFileName);
            }

            // Tambahkan dokumen-dokumen terkait ke dalam zip
            foreach ($publication->stepsplans as $plan) {
                // Dokumen Plan (dari storage/app/public)
                if ($plan->plan_doc && Storage::disk('public')->exists($plan->plan_doc)) {
                    // Buat nama file: gabungan plan_type + plan_name + ekstensi asli
                    $filename = Str::slug($plan->plan_type . '_' . $plan->plan_name, '_') 
                        . '.' . pathinfo($plan->plan_doc, PATHINFO_EXTENSION);
                    
                    $zip->addFile(Storage::disk('public')->path($plan->plan_doc), "bukti_dukung_rencana/" . $filename);
                }
                
                if ($plan->stepsFinals) {
                    $final = $plan->stepsFinals;
                    // Dokumen Final (dari storage/app/public)
                    if ($final->final_doc && Storage::disk('public')->exists($final->final_doc)) {
                        // Buat nama file: gabungan plan_type + plan_name + ekstensi asli
                        $filename = Str::slug($plan->plan_type . '_' . $plan->plan_name, '_') 
                            . '.' . pathinfo($plan->plan_doc, PATHINFO_EXTENSION);
                        
                        $zip->addFile(Storage::disk('public')->path($final->final_doc), "bukti_dukung_realisasi/" . $filename);
                    }
                    // Dokumen Struggles (dari storage/app/public)
                    foreach ($final->struggles as $struggle) {
                        if ($struggle->solution_doc && Storage::disk('public')->exists($struggle->solution_doc)) {
                            // Buat nama file: gabungan plan_type + plan_name + ekstensi asli
                            $filename = Str::slug($plan->plan_type . '_' . $plan->plan_name, '_') 
                                . '.' . pathinfo($plan->plan_doc, PATHINFO_EXTENSION);
                            
                            $zip->addFile(Storage::disk('public')->path($struggle->solution_doc), "bukti_dukung_kendala_solusi/" . $filename);
                        }
                    }
                }
            }
            $zip->close();
        }

        // 4. Unduh file ZIP
        if (Storage::exists($zipPath)) {
            return Storage::download($zipPath);
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }
    }

    // Export all publication
    public function exportTable()
    {
        
        $publications = Publication::with([
            'user',
            'stepsPlans.stepsFinals.struggles'
        ])->get();

        // ============================
        // Olah data publikasi
        // ============================
        foreach ($publications as $publication) {
            $rekapPlans   = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $rekapFinals  = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $lintasTriwulan = 0;
            $totalPlans   = 0;
            $totalFinals  = 0;

            foreach ($publication->stepsPlans as $plan) {
                $totalPlans++;

                // hitung rencana
                $q = $this->getQuarter($plan->plan_start_date);
                if ($q) $rekapPlans[$q]++;

                // hitung realisasi
                if ($plan->stepsFinals) {
                    $totalFinals++;
                    $fq = $this->getQuarter($plan->stepsFinals->actual_started);
                    if ($fq) $rekapFinals[$fq]++;

                    if ($fq && $q && $fq != $q) {
                        $lintasTriwulan++;
                    }
                }
            }

            // progress kumulatif
            $progressKumulatif = $totalPlans > 0
                ? round(($totalFinals / $totalPlans) * 100, 2)
                : 0;

            // progress per triwulan
            $progressTriwulan = [];
            foreach ([1, 2, 3, 4] as $q) {
                if ($rekapPlans[$q] > 0) {
                    $progressTriwulan[$q] = round(($rekapFinals[$q] / $rekapPlans[$q]) * 100, 2);
                } else {
                    $progressTriwulan[$q] = 0;
                }
            }

            // simpan ke publikasi
            $publication->rekapPlans = $rekapPlans;
            $publication->rekapFinals = $rekapFinals;
            $publication->lintasTriwulan = $lintasTriwulan;
            $publication->progressKumulatif = $progressKumulatif;
            $publication->progressTriwulan = $progressTriwulan;
            $publication->totalPlans = $totalPlans;
            $publication->totalFinals = $totalFinals;
        }

        // ============================
        // Buat spreadsheet
        // ============================
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Utama
        $sheet->mergeCells('A1:A2')->setCellValue('A1', 'No');
        $sheet->mergeCells('B1:B2')->setCellValue('B1', 'Nama Publikasi/Laporan');
        $sheet->mergeCells('C1:C2')->setCellValue('C1', 'Nama Kegiatan');
        $sheet->mergeCells('D1:D2')->setCellValue('D1', 'PIC');
        $sheet->mergeCells('E1:E2')->setCellValue('E1', 'Tahapan');
        $sheet->mergeCells('F1:F2')->setCellValue('F1', 'Progress Kumulatif (%)');
        $sheet->mergeCells('G1:G2')->setCellValue('G1', 'Lintas Triwulan');

        $sheet->mergeCells('H1:K1')->setCellValue('H1', 'Rencana Kegiatan');
        $sheet->mergeCells('L1:O1')->setCellValue('L1', 'Realisasi Kegiatan');

        // Sub Header
        $sheet->setCellValue('H2', 'Triwulan I');
        $sheet->setCellValue('I2', 'Triwulan II');
        $sheet->setCellValue('J2', 'Triwulan III');
        $sheet->setCellValue('K2', 'Triwulan IV');
        $sheet->setCellValue('L2', 'Triwulan I');
        $sheet->setCellValue('M2', 'Triwulan II');
        $sheet->setCellValue('N2', 'Triwulan III');
        $sheet->setCellValue('O2', 'Triwulan IV');

        // ============================
        // Isi data
        // ============================
        $row = 3;
        foreach ($publications as $index => $publication) {
            $sheet->setCellValue("A{$row}", $index + 1);
            $sheet->setCellValue("B{$row}", $publication->publication_report);
            $sheet->setCellValue("C{$row}", $publication->publication_name);
            $sheet->setCellValue("D{$row}", $publication->publication_pic);

            // Tahapan
            $sheet->setCellValue("E{$row}", "{$publication->totalFinals}/{$publication->totalPlans} Tahapan");

            // Progress kumulatif
            $sheet->setCellValue("F{$row}", $publication->progressKumulatif . '%');

            // Lintas triwulan
            $sheet->setCellValue("G{$row}", $publication->lintasTriwulan);

            // Rencana per Triwulan
            foreach ([1, 2, 3, 4] as $i => $q) {
                $col = chr(72 + $i); // H,I,J,K
                $sheet->setCellValue("{$col}{$row}", $publication->rekapPlans[$q]);
            }

            // Realisasi per Triwulan
            foreach ([1, 2, 3, 4] as $i => $q) {
                $col = chr(76 + $i); // L,M,N,O
                $sheet->setCellValue("{$col}{$row}", $publication->rekapFinals[$q]);
            }

            $row++;
        }

        // ============================
        // Styling
        // ============================
        $sheet->getStyle('A1:O2')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:O'.($row - 1))
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        foreach (range('A', 'O') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Export
        $writer = new Xlsx($spreadsheet);
        $fileName = 'daftar_publikasi.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    private function getQuarter($date)
    {
        if (!$date) return null;
        $month = date('n', strtotime($date));
        return ceil($month / 3);
    }
}