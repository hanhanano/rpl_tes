{{-- statistik/rekapitulasi-tahapan.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <!-- Sedang Berlangsung -->
    <!-- <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Zm7.75-4.25a.75.75 0 0 0-1.5 0V8c0 .414.336.75.75.75h3.25a.75.75 0 0 0 0-1.5h-2.5v-3.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Belum Berlangsung</p>
        <p class="text-2xl font-bold" x-text="data.tahapan.belumBerlangsung"></p>
        <p class="text-xs text-gray-400">Tahapan Telah Dibuat</p>
    </div> -->

    <!-- Sedang Berlangsung -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Zm7.75-4.25a.75.75 0 0 0-1.5 0V8c0 .414.336.75.75.75h3.25a.75.75 0 0 0 0-1.5h-2.5v-3.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Sedang Berlangsung</p>
        <p class="text-2xl font-bold" x-text="data.tahapan.sedangBerlangsung"></p>
        <p class="text-xs text-gray-400">Tahapan dalam proses</p>
    </div>
    
    <!-- Sudah Selesai -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-emerald-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Tahapan Selesai</p>
        <p class="text-2xl font-bold" x-text="data.tahapan.sudahSelesai"></p>
        <p class="text-xs text-gray-400">Selesai sesuai rencana</p>
    </div>
    
    <!-- Tertunda -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M6.701 2.25c.577-1 2.02-1 2.598 0l5.196 9a1.5 1.5 0 0 1-1.299 2.25H2.804a1.5 1.5 0 0 1-1.3-2.25l5.197-9ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 1 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Tertunda/Mundur</p>
        <p class="text-2xl font-bold" x-text="data.tahapan.tertunda"></p>
        <p class="text-xs text-gray-400">Tahapan tertunda/lintas triwulan</p>
    </div>

    <!-- Total Tahapan -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-green-950">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8c0 .982-.472 1.854-1.202 2.402a2.995 2.995 0 0 1-.848 2.547 2.995 2.995 0 0 1-2.548.849A2.996 2.996 0 0 1 8 15a2.996 2.996 0 0 1-2.402-1.202 2.995 2.995 0 0 1-2.547-.848 2.995 2.995 0 0 1-.849-2.548A2.996 2.996 0 0 1 1 8c0-.982.472-1.854 1.202-2.402a2.995 2.995 0 0 1 .848-2.547 2.995 2.995 0 0 1 2.548-.849A2.995 2.995 0 0 1 8 1c.982 0 1.854.472 2.402 1.202a2.995 2.995 0 0 1 2.547.848c.695.695.978 1.645.849 2.548A2.996 2.996 0 0 1 15 8Zm-3.291-2.843a.75.75 0 0 1 .135 1.052l-4.25 5.5a.75.75 0 0 1-1.151.043l-2.25-2.5a.75.75 0 1 1 1.114-1.004l1.65 1.832 3.7-4.789a.75.75 0 0 1 1.052-.134Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Total Tahapan</p>
        <p class="text-2xl font-bold" x-text="data.tahapan.total"></p>
        <p class="text-xs text-gray-400">Tahapan per triwulan</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-6">
    <!-- Persentase Realisasi -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M11.986 3H12a2 2 0 0 1 2 2v6a2 2 0 0 1-1.5 1.937V7A2.5 2.5 0 0 0 10 4.5H4.063A2 2 0 0 1 6 3h.014A2.25 2.25 0 0 1 8.25 1h1.5a2.25 2.25 0 0 1 2.236 2ZM10.5 4v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75V4h3Z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M2 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7Zm6.585 1.08a.75.75 0 0 1 .336 1.005l-1.75 3.5a.75.75 0 0 1-1.16.234l-1.75-1.5a.75.75 0 0 1 .977-1.139l1.02.875 1.321-2.64a.75.75 0 0 1 1.006-.336Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Persentase Realisasi Tahapan</p>
        <p class="text-2xl font-bold">
            <span x-text="data.tahapan.persentaseRealisasi"></span>%
        </p>
        <p class="text-xs text-gray-400">Tahapan diselesaikan</p>
    </div>
</div>