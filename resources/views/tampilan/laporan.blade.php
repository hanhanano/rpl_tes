<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Tailwind Elements -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body>
    <div>
        {{-- Navbar --}}
        <x-navbar ></x-navbar>
        {{-- Header --}}
        <x-header></x-header>
    </div>
    <main>
        <h3 class="italic text-gray-500 text-sm text-center">Maaf Halaman Ini Belum Tersedia</h3>
    </main>
    {{-- <main>
        <div class="max-w-7xl mx-auto px-4 space-y-6">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <a href="/ketuatim" class="flex gap-1 rounded-md text-sm px-2 py-2 sm:text-xs hover:bg-emerald-600 hover:text-white"> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Judul -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Sakernas</h1>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2">Sakernas</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-semibold text-blue-800">83%</p>
                        <p class="text-xs sm:text-sm text-blue-800">Progress Keseluruhan</p>
                    </div>
                </div>

                <!-- Badges -->
                <div class="flex gap-2 mb-6">
                    <span class="px-3 py-1 bg-blue-800 text-white rounded-full text-sm">6 Tahapan</span>
                    <span class="px-3 py-1 bg-emerald-600 text-white rounded-full text-sm">5 Selesai</span>
                </div>

                <!-- Card -->
                <div  x-data="{open:false}" >
                    <!-- Card Tahapan -->
                    <div x-show="!open" x-transition class="bg-white rounded-xl shadow p-6 border">
                        <!-- Header Card -->
                        <div class="flex items-center justify-between mb-4">
                            <!-- persiapan -->
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex items-center justify-center rounded-full bg-emerald-600 text-white font-semibold">
                                    P
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold">Perekrutan Anggota</h2>
                                    <div class="flex gap-2 mt-1">
                                        <span class="px-2 py-0.5 bg-gray-200 rounded-lg text-xs">Persiapan</span>
                                        <span class="px-2 py-0.5 bg-emerald-600 text-white rounded-lg text-xs">Selesai</span>
                                        <span class="px-2 py-0.5 bg-gray-200 rounded-lg text-xs">Q1</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Icon ceklis -->
                            <div class="text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <!-- Konten Card -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Rencana -->
                            <div>
                                <h3 class="font-semibold mb-2">Rencana</h3>
                                <p class="text-sm text-gray-600">Periode</p>
                                <p class="text-sm mb-2">15 Januari 2024 - 31 Januari 2024</p>

                                <p class="text-sm text-gray-600">Narasi</p>
                                <p class="text-sm mb-2">Melakukan perekrutan anggota tim survei</p>

                                <p class="text-sm text-gray-600">Dokumen</p>
                                <a href="#" class="text-blue-600 hover:underline text-sm">📄 Kriteria_Rekrutmen.pdf</a>
                            </div>

                            <!-- Realisasi -->
                            <div>
                                <h3 class="font-semibold mb-2">Realisasi</h3>
                                <p class="text-sm text-gray-600">Periode Aktual</p>
                                <p class="text-sm mb-2">15 Januari 2024 - 28 Januari 2024</p>

                                <p class="text-sm text-gray-600">Narasi</p>
                                <p class="text-sm mb-2">Berhasil merekrut 50 anggota tim survei</p>

                                <p class="text-sm text-gray-600">Kendala</p>
                                <p class="text-sm mb-2">Kesulitan mencari kandidat yang sesuai kualifikasi</p>

                                <p class="text-sm text-gray-600">Solusi</p>
                                <p class="text-sm mb-2">Memperluas jangkauan rekrutmen ke universitas</p>

                                <p class="text-sm text-gray-600">Tindak Lanjut</p>
                                <p class="text-sm mb-2">Evaluasi kinerja anggota tim yang baru direkrut</p>

                                <p class="text-sm text-gray-600">Bukti Pendukung Solusi</p>
                                <div class="flex flex-col gap-1">
                                    <a href="#" class="text-blue-600 hover:underline text-sm">📷 Foto_Kegiatan_Rekrutmen.jpg</a>
                                    <a href="#" class="text-blue-600 hover:underline text-sm">📄 Dokumentasi_Proses.pdf</a>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Edit -->
                        <div class="flex justify-end mt-4">
                            <button 
                                @click="open=true"
                                class="text-xs sm:text-sm flex gap-1 px-4 py-2  rounded-lg bg-gray-200 text-gray-700 hover:bg-emerald-600 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Form Edit -->
                <div x-show="open" x-transition>
                    <form enctype="multipart/form-data" class="space-y-4">
                        <div class="flex space-x-2 mb-4">
                            <button type="button" disabled
                                    class="bg-blue-600 text-white px-4 py-2 rounded">
                                Edit Rencana
                            </button>
                            <button type="button" disabled
                                    class="bg-gray-200 text-gray-500 px-4 py-2 rounded cursor-not-allowed">
                                Edit Realisasi
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Rencana</label>
                                <input type="date" name="tanggal_mulai" class="w-full border rounded px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Selesai Rencana</label>
                                <input type="date" name="tanggal_selesai" class="w-full border rounded px-3 py-2">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Triwulan</label>
                            <select name="triwulan" class="w-full border rounded px-3 py-2">
                                <option>Triwulan I</option>
                                <option>Triwulan II</option>
                                <option>Triwulan III</option>
                                <option>Triwulan IV</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Narasi Rencana</label>
                            <textarea name="narasi" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dokumen Pendukung Rencana</label>
                            <input type="file" name="dokumen[]" multiple
                                class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-800">
                            <p class="text-xs text-gray-500">Format yang diterima: PDF, JPG, PNG</p>
                        </div>

                        <div class="flex space-x-2">
                            <button type="submit" 
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">
                                Simpan
                            </button>
                            <button type="button" @click="open = false" 
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                                Batal
                            </button>
                        </div>
                    </form>

                </div>
        </div>
    </main> --}}
</body>
</html>