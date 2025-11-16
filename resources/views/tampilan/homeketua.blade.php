<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Tailwind Elements -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body>
    <header class="fixed top-0 left-0 right-0 w-full bg-[#002b6b] z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center space-x-3">
        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="h-8">
        <span class="text-white font-semibold">BADAN PUSAT STATISTIK</span>
    </div>
</header>

    <div>
        {{-- Navbar --}}
        <x-navbar ></x-navbar>
        {{-- Header --}}
        <x-header></x-header>
    </div>

    <main>
        <div class="max-w-7xl mx-auto px-4 space-y-6">
            <!-- Statistik Dashboard -->
            @include('tampilan.statistik')

            <!-- Daftar Publikasi Survei -->
            @include('tampilan.daftarpublikasi')

            <!-- Grafik Ringkasan -->
            @include('tampilan.dashboard', [
                'dataGrafikBatang' => $dataGrafikBatang,
                'dataGrafikRing' => $dataGrafikRing,
                'dataTahapanSummary' => $dataTahapanSummary,
                'dataRingSummary' => $dataRingSummary
            ])
        </div>
    </main>
</body>
<footer class="bg-blue-950 text-white mt-8">
    <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center">
        <!-- Logo dan instansi -->
        <div class="flex items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg/960px-Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg.png" class="h-8 me-3"
                alt="Logo BPS" />
            <span class="font-semibold text-sm md:text-base">BADAN PUSAT STATISTIK</span>
        </div>

        <!-- Kredit mahasiswa STIS -->
        <div class="mt-4 md:mt-0 text-xs md:text-sm text-center md:text-right">
            <p>© 2025 Badan Pusat Statistik</p>
            <p class="italic">Kredit by Mahasiswa STIS BPS Kota Bekasi</p>
        </div>
    </div>
</footer>

</html>

<script>
    // Ringkasan Kinerja
    new Chart(document.getElementById('kinerjaChart'), {
        type: 'bar',
        data: {
            // Sumbu X sekarang adalah status, dari variabel baru kita
            labels: @json($dataGrafikPublikasi['labels']),
            datasets: [
                { 
                    label: 'Jumlah Publikasi', 
                    data: @json($dataGrafikPublikasi['data']), 
                    // 3 warna baru untuk 3 status
                    backgroundColor: [
                        '#2a9d90', // Selesai
                        '#f4a261', // Sedang Berlangsung
                        '#e76f51'  // Belum Berlangsung
                    ]
                }
            ]
        },
        options: { 
            responsive: true, 
            plugins: { 
                legend: { 
                    display: false // Sembunyikan legenda default
                } 
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Tahapan Chart
    new Chart(document.getElementById('tahapanChart'), {
        type: 'bar',
        data: {
            // Gunakan data yang sama dengan 'Rencana' vs 'Realisasi'
            // 'Total Tahapan' adalah Rencana, 'Tahapan Selesai' adalah Realisasi
            labels: @json($dataGrafikBatang['labels']),
            datasets: [
                { 
                    label: 'Total Tahapan', 
                    data: @json($dataGrafikBatang['rencana']), 
                    backgroundColor: '#00458a' 
                },
                { 
                    label: 'Tahapan Selesai', 
                    data: @json($dataGrafikBatang['realisasi']), 
                    backgroundColor: '#2a9d90' 
                }
            ]
        },
        options: { responsive: true, plugins: { legend: { display: false} } }
    });

    // Proporsi Publikasi vs Tahapan
    new Chart(document.getElementById('ringChart'), {
        type: 'doughnut',
        data: {
            // Labels dan data dari controller 
            labels: @json($dataGrafikRing['labels']),
            datasets: [
                { 
                    data: @json($dataGrafikRing['data']), 
                    backgroundColor: ['#2a9d90', '#00458a'] 
                }
            ]
        },
        options: { 
            responsive: true, 
            cutout: '70%',
            plugins: {
                // legend: {
                //     // Sembunyikan legend default dari Chart.js
                //     display: false 
                // }
            }
        }
    });
</script>