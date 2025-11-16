{{-- statistik.blade.php --}}
<div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg" 
     x-data="{
         tab: 'publikasi',
         triwulan: 1,
         loading: true,
         data: {
             publikasi: {
                 total: 0,
                 sedangBerlangsung: 0,
                 sudahSelesai: 0
             },
             tahapan: {
                 total: 0,
                 belumBerlangsung:0,
                 sedangBerlangsung: 0,
                 sudahSelesai: 0,
                 tertunda: 0,
                 persentaseRealisasi: 0
             }
         },
         async fetchData() {
             this.loading = true;
             try {
                 // Panggil route yang sama (index) tapi dengan parameter AJAX
                 const response = await fetch(`{{ route('daftarpublikasi') }}?triwulan=${this.triwulan}`, {
                     headers: {
                         'X-Requested-With': 'XMLHttpRequest',
                         'Accept': 'application/json'
                     }
                 });
                 const result = await response.json();
                 this.data = result;
             } catch (error) {
                 console.error('Error fetching data:', error);
                 alert('Gagal memuat data. Silakan coba lagi.');
             } finally {
                 this.loading = false;
             }
         }
     }"
     x-init="fetchData(); $watch('triwulan', () => fetchData())">
    
    <div class="flex justify-between items-center mb-4">
        <!-- Header -->
        <div>
            <h2 class="text-lg font-semibold text-blue-900">Statistik Dashboard</h2>
            <p class="text-sm text-gray-500">Rekapitulasi data berdasarkan triwulan dan jenis tampilan</p>
        </div>
        
        <!-- Dropdown Triwulan -->
        <div class="relative">
            <label for="triwulan" class="mr-2 text-sm font-medium text-gray-700">Triwulan:</label>
            <select id="triwulan" 
                    class="rounded-md border text-sm" 
                    x-model="triwulan"
                    :disabled="loading">
                <option value="1">Triwulan I</option>
                <option value="2">Triwulan II</option>
                <option value="3">Triwulan III</option>
                <option value="4">Triwulan IV</option>
            </select>
            
            <!-- Loading Spinner -->
            <span x-show="loading" class="ml-2">
                <svg class="animate-spin h-4 w-4 text-blue-600 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    <!-- Tab Button -->
    <div class="flex flex-col sm:flex-row border rounded overflow-hidden text-sm font-medium mb-4">
        <button 
            class="flex items-center justify-center gap-2 flex-1 py-2"
            :class="tab === 'publikasi' ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-600 hover:bg-white hover:text-blue-900'"
            @click="tab = 'publikasi'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M11.986 3H12a2 2 0 0 1 2 2v6a2 2 0 0 1-1.5 1.937V7A2.5 2.5 0 0 0 10 4.5H4.063A2 2 0 0 1 6 3h.014A2.25 2.25 0 0 1 8.25 1h1.5a2.25 2.25 0 0 1 2.236 2ZM10.5 4v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75V4h3Z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M3 6a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H3Zm1.75 2.5a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5ZM4 11.75a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
            Rekapitulasi Publikasi
        </button>
        <button 
            class="flex items-center justify-center gap-2 flex-1 py-2"
            :class="tab === 'tahapan' ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-600 hover:bg-white hover:text-blue-900'"
            @click="tab = 'tahapan'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4Zm.75 7a.75.75 0 0 0-.75.75v1.5a.75.75 0 0 0 1.5 0v-1.5A.75.75 0 0 0 4.75 9Zm2.5-1.75a.75.75 0 0 1 1.5 0v4a.75.75 0 0 1-1.5 0v-4Zm4-3.25a.75.75 0 0 0-.75.75v6.5a.75.75 0 0 0 1.5 0v-6.5a.75.75 0 0 0-.75-.75Z" clip-rule="evenodd" />
            </svg>
            Rekapitulasi Tahapan
        </button>
    </div>
    
    <!-- Konten Tab -->
    <div x-show="!loading">
        <div x-show="tab === 'publikasi'">
            @include('statistik.rekapitulasi-publikasi')
        </div>

        <div x-show="tab === 'tahapan'">
            @include('statistik.rekapitulasi-tahapan')
        </div>
    </div>
    
    <!-- Loading State -->
    <div x-show="loading" class="text-center py-12">
        <svg class="animate-spin h-12 w-12 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="text-gray-500 mt-4">Memuat data...</p>
    </div>
</div>