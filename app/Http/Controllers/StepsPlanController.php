<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\StepsPlan;

class StepsPlanController extends Controller
{
    //tampil data tahapan
    public function index(Request $request, Publication $publication)
    {
        // ambil input search dari query string (?search=...)
        $search = $request->input('search');

        // query dasar: hanya ambil steps dari publikasi tertentu
        $query = StepsPlan::where('publication_id', $publication->publication_id)->with('stepsFinals');

        // filter kalau ada search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('plan_name', 'LIKE', '%' . $search . '%')
                ->orWhere('plan_type', 'LIKE', '%' . $search . '%');
            });
        }

        // eksekusi query
        $stepsplans = $query->get();

        // Menghitung total rencana dan realisasi
        $total_rencana   = $stepsplans->count();
        $total_realisasi = $stepsplans->whereNotNull('stepsFinals')->count();

        // $publication = Publication::findOrFail($publication->slug_publication);

        $rekapPlans = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
        $rekapFinals = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
        $progressKumulatif = 0;
        $lintasTriwulan = 0;
        
         foreach ($publication->stepsPlans as $plan) {
                // hitung berdasarkan tanggal rencana
                $q = getQuarter($plan->plan_start_date);
                if ($q) $rekapPlans[$q]++;

                // kalau sudah ada realisasi, hitung juga
                if ($plan->stepsFinals) {
                    $fq = getQuarter($plan->stepsFinals->actual_started);
                    if ($fq) $rekapFinals[$fq]++;

                    // cek apakah realisasi lintas triwulan
                    if ($fq && $q && $fq != $q) {
                        $lintasTriwulan++;
                    }
                }
            }

            // hitung progress kumulatif
            $totalPlans = array_sum($rekapPlans);
            $totalFinals = array_sum($rekapFinals);
            if ($totalPlans > 0) {
                $progressKumulatif = ($totalFinals / $totalPlans) * 100;
            } else {
                $progressKumulatif = 0;
            }
        $publication->progressKumulatif = $progressKumulatif;
        
        return view('tampilan.detail', compact('stepsplans', 'total_rencana', 'total_realisasi', 'publication', 'search', 'publication'));
    }

    
    //simpan data untuk formulir "Tambah Tahapan"
    public function store(Request $request, Publication $publication)
    {
        // validasi input
        $request->validate([
            'plan_type' => 'required|string',
            'plan_name' => 'required|string|max:256',
        ]);

        // Simpan ke database, ambil publication_id dari model Publication
        StepsPlan::create([
            'plan_type'      => $request->plan_type,
            'plan_name'      => $request->plan_name,
            'publication_id' => $publication->publication_id, // FK id, bukan slug
        ]);

        return redirect()
            ->back()
            // ->route('steps.index', $publication) // balik ke detail publikasi slug
            ->with('success', 'Tahapan berhasil ditambahkan.');
    }


    // Fungsi untuk update tahapan
    public function updateStage(Request $request, StepsPlan $plan){
        // validasi input
        $request->validate([
            'plan_type' => 'required|string',
            'plan_name' => 'required|string|max:256',
        ]);

        // perbarui data
        $plan->update([
            'plan_type' => $request->plan_type,
            'plan_name' => $request->plan_name,
        ]);

        // Redirect pesan sukses
        return redirect()->back()->with('success', 'Tahapan berhasil diperbarui.');
    }

    // Perbarui data untuk formulir "Edit Rencana"
    public function update(Request $request, StepsPlan $plan){
        // dd($request->hasFile('plan_doc'));
        // Cek apakah ada file lama
        $existingPlanDoc = $plan->plan_doc;

        // Atur validasi file
        $fileValidation = $existingPlanDoc ? 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048' : 'required|file|mimes:pdf,jpg,png,jpeg,docx|max:2048';
        
        $validated = $request->validate([
            'plan_start_date' => 'required|date',
            'plan_end_date'   => 'required|date|after_or_equal:plan_start_date',
            'plan_desc'       => 'required|string',
            'plan_doc'        => $fileValidation,
        ]);
        
        // Upload dokumen jika ada
        // if ($request->hasFile('plan_doc')) {
        //     // dd($request->hasFile('plan_doc'));
        //     $path = $request->file('plan_doc')->store('documents', 'public');
        //     $validated['plan_doc'] = $path;
        //     // dd($validated);
        // }

        // Upload dokumen jika ada atau gunakan dokumen lama
        if ($request->hasFile('plan_doc')) {
            // Hapus dokumen lama jika ada
            if ($existingPlanDoc) {
                \Storage::disk('public')->delete($existingPlanDoc);
            }
            $path = $request->file('plan_doc')->store('documents', 'public');
            $validated['plan_doc'] = $path;
        } else {
            // Gunakan dokumen lama jika tidak ada upload baru
            $validated['plan_doc'] = $existingPlanDoc;
        }
        
        // Perbarui data
        $plan->update($validated);
        return redirect()->back()->with('success', 'Rencana berhasil diperbarui.');
    }

    


    // public function update(Request $request, StepsPlan $plan)
    // {
    //     if ($request->input('edit_type') === 'full') {
    //         // validasi form rencana lengkap
    //         $existingPlanDoc = $plan->plan_doc;
    //         $fileValidation = $existingPlanDoc ? 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048'
    //                                         : 'required|file|mimes:pdf,jpg,png,jpeg,docx|max:2048';

    //         $validated = $request->validate([
    //             'plan_type' => 'required|string',
    //             'plan_name' => 'required|string|max:256',
    //             'plan_start_date' => 'required|date',
    //             'plan_end_date'   => 'required|date|after_or_equal:plan_start_date',
    //             'plan_desc'       => 'nullable|string',
    //             'plan_doc'        => $fileValidation,
    //         ]);

    //         if ($request->hasFile('plan_doc')) {
    //             if ($existingPlanDoc) {
    //                 \Storage::disk('public')->delete($existingPlanDoc);
    //             }
    //             $validated['plan_doc'] = $request->file('plan_doc')->store('documents', 'public');
    //         } else {
    //             $validated['plan_doc'] = $existingPlanDoc;
    //         }

    //     } else {
    //         // validasi edit tahapan sederhana
    //         $validated = $request->validate([
    //             'plan_type' => 'required|string',
    //             'plan_name' => 'required|string|max:256',
    //         ]);

    //         // field lain tetap null kalau memang tidak diisi
    //         $validated['plan_start_date'] = null;
    //         $validated['plan_end_date']   = null;
    //         $validated['plan_desc']       = null;
    //         $validated['plan_doc']        = null;
    //     }

    //     $plan->update($validated);

    //     return redirect()->back()->with('success', 'Rencana berhasil diperbarui.');
    // }


    // Untuk menghapus tahapan
    public function destroy(StepsPlan $plan){
        //Hapus data
        $plan->delete();

        //Redirect kembali dengan pesan sukses
        return redirect()->back()->with('succes', 'Tahapan berhasil dihapus.');
    }
}