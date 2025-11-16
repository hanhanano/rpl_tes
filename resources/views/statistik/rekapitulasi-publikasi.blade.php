{{-- statistik/rekapitulasi-publikasi.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <!-- Belum Berlangsung -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Zm7.75-4.25a.75.75 0 0 0-1.5 0V8c0 .414.336.75.75.75h3.25a.75.75 0 0 0 0-1.5h-2.5v-3.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Belum Berlangsung</p>
        <p class="text-2xl font-bold" x-text="data.publikasi.belumBerlangsung"></p>
        <p class="text-xs text-gray-400">Publikasi belum berjalan</p>
    </div>

    <!-- Sedang Berlangsung -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Zm7.75-4.25a.75.75 0 0 0-1.5 0V8c0 .414.336.75.75.75h3.25a.75.75 0 0 0 0-1.5h-2.5v-3.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Sedang Berlangsung</p>
        <p class="text-2xl font-bold" x-text="data.publikasi.sedangBerlangsung"></p>
        <p class="text-xs text-gray-400">Publikasi dalam proses</p>
    </div>

    <!-- Sudah Selesai -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-emerald-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Sudah Selesai</p>
        <p class="text-2xl font-bold" x-text="data.publikasi.sudahSelesai"></p>
        <p class="text-xs text-gray-400">Publikasi telah selesai</p>
    </div>

    <!-- Total -->
    <div class="relative p-4 border rounded text-center">
        <div class="absolute top-2 right-2 text-green-950">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8c0 .982-.472 1.854-1.202 2.402a2.995 2.995 0 0 1-.848 2.547 2.995 2.995 0 0 1-2.548.849A2.996 2.996 0 0 1 8 15a2.996 2.996 0 0 1-2.402-1.202 2.995 2.995 0 0 1-2.547-.848 2.995 2.995 0 0 1-.849-2.548A2.996 2.996 0 0 1 1 8c0-.982.472-1.854 1.202-2.402a2.995 2.995 0 0 1 .848-2.547 2.995 2.995 0 0 1 2.548-.849A2.995 2.995 0 0 1 8 1c.982 0 1.854.472 2.402 1.202a2.995 2.995 0 0 1 2.547.848c.695.695.978 1.645.849 2.548A2.996 2.996 0 0 1 15 8Zm-3.291-2.843a.75.75 0 0 1 .135 1.052l-4.25 5.5a.75.75 0 0 1-1.151.043l-2.25-2.5a.75.75 0 1 1 1.114-1.004l1.65 1.832 3.7-4.789a.75.75 0 0 1 1.052-.134Z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Total Publikasi</p>
        <p class="text-2xl font-bold" x-text="data.publikasi.total"></p>
        <p class="text-xs text-gray-400">Total Tahunan</p>
    </div>
</div>