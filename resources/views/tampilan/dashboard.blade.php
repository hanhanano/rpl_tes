<div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border">
        
        <!-- Ringkasan Kinerja -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-1">Status Publikasi Tahunan</h2>
            <p class="text-sm text-gray-500 mb-3">Jumlah publikasi tahunan berdasarkan status penyelesaian</p>
            <div class="flex justify-center">
                <canvas id="kinerjaChart"></canvas>
            </div>
            <!-- Label -->
            <div class="flex flex-wrap gap-4 mt-3 text-sm justify-center">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3" style="background-color: #2a9d90"></span> Selesai
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3" style="background-color: #f4a261"></span> Berlangsung
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3" style="background-color: #e76f51"></span> Belum
                </div>
            </div>
        </div>

        <!-- Statistik Tahapan per Triwulan -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-1">Ringkasan Kinerja</h2>
            <p class="text-sm text-gray-500 mb-3">Perbandingan rencana dan realisasi survei per triwulan</p>
            <div class="flex justify-center">
                <canvas id="tahapanChart"></canvas>
            </div>
            <!-- Label I -->
            <div class="flex gap-4 mt-3 text-sm justify-center">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-blue-900"></span> Total Tahapan
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-emerald-500"></span> Tahapan Selesai
                </div>
            </div>

            <!-- Label II -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-center mt-4 text-sm">
                @foreach($dataTahapanSummary as $data)
                    <div class="bg-gray-50 p-2 rounded-lg">
                        <p class="font-bold">{{ $data['q'] }}</p>
                        <p>{{ $data['ratio'] }}</p>
                        <p class="{{ $data['color'] }}">{{ $data['percent_text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Proporsi Publikasi vs Tahapan Selesai -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="font-semibold mb-2">Proporsi Publikasi vs Tahapan Selesai</h2>
            <p class="text-sm text-gray-500 mb-3">Perbandingan jumlah publikasi selesai dengan tahapan selesai</p>
            <div class="flex justify-center">
                <canvas id="ringChart" width="100" height="100"></canvas>
            </div>
            <!-- Label II -->
            <div class="grid grid-cols-2 gap-2 text-center mt-4 text-sm">
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="text-emerald-600 text-lg font-bold">{{ $dataRingSummary['publikasiSelesai'] }}</p>
                    <p class="text-gray-500 text-xs">Publikasi Selesai</p>
                    <p class="text-gray-500 text-xs">dari {{ $dataRingSummary['totalPublikasi'] }} total publikasi</p>
                </div>
                <div class_bg-gray-50 p-2 rounded-lg">
                    <p class="text-blue-900 text-lg font-bold">{{ $dataRingSummary['tahapanSelesai'] }}</p>
                    <p class="text-gray-500 text-xs">Tahapan Selesai</p>
                    <p class="text-gray-500 text-xs">dari {{ $dataRingSummary['totalTahapan'] }} total tahapan</p>
                </div>
            </div>
        </div>
    </div>
</div>