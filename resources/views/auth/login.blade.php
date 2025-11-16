<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Tailwind Elements -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="/js/admin.js" defer></script>

</head>

<body>
    <body>
    <div>
        {{-- Navbar --}}
        <x-navbar ></x-navbar>
        {{-- Header --}}
        <x-header></x-header>
    </div>

    <main>
 <div class="flex flex-col h-screen md:flex-row">
        <!-- Kiri: Deskripsi -->
        <div
            class="flex-col items-center justify-center hidden w-full p-6 md:flex md:w-1/2 md:p-10">
            <h1 class="mb-4 text-2xl font-bold text-center md:text-4xl">Sistem Monitoring Laporan Publikasi</h1>
            <h1 class="mb-4 text-2xl font-bold text-center md:text-4xl">BPS Kota Bekasi</h1>
            <img src="img/mascot.png" alt="Maskot Mang Ntat" class="mt-6 w-[200px] md:w-[300px]">
            <p class="mt-4 text-base tracking-widest text-center md:text-lg">
                Masukkan email dan kata sandi Anda untuk mengakses.
            </p>
        </div>

        <!-- Bar Judul untuk ukuran kecil -->
        <div class="p-4 text-white md:hidden bg-primary">
            <a href="#" class="flex ms-2 md:me-24">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg/960px-Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg.png" class="h-8 me-3"
                    alt="FlowBite Logo" />
                <span
                    class="self-center text-lg font-medium tracking-normal sm:text-xl whitespace-nowrap text-gray-900 dark:text-white">Tim SAKIP BPS Kota Bekasi
                </span>
            </a>
        </div>

        <!-- Kanan: Form Login -->
        <div class="flex flex-col items-center justify-center w-full p-6 mt-10 md:w-1/2 bg-secondary md:p-10">
            <form method="POST" action="{{ route('login.post') }}"
                class="flex flex-col w-full max-w-md p-6 bg-white rounded-lg shadow-md md:p-10">
                @csrf
                <!-- Username/Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold md:text-lg">Username</label>
                    <input type="text" name="email" id="email" placeholder="Masukkan Email"
                        class="block w-full px-3 py-2 mt-1 tracking-widest text-center border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm md:placeholder:text-base lg:placeholder:text-lg">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Kata Sandi -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold md:text-lg">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi"
                        class="block w-full px-3 py-2 mt-1 tracking-widest text-center border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm md:placeholder:text-base lg:placeholder:text-lg">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Remember Me -->
                {{-- <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember-me" class="block ml-2 text-sm text-gray-900">Remember-me</label>
                    </div>
                </div> --}}
                <!-- Button Login -->
                <div>
                    {{-- <a href="#"
                        class="text-sm tracking-wider text-blue-600 hover:underline">Lupa kata sandi? Klik disini
                    </a> --}}
                    <div class="flex justify-center mt-4">
                        <button type="submit"
                             class="w-full md:w-[200px] py-2 px-4 md:py-3 md:px-6 border border-transparent rounded-lg shadow-md 
                                    text-base md:text-xl font-bold text-white bg-blue-800 
                                    hover:bg-emerald-800 hover:text-white 
                                    focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-emerald-500 tracking-wider">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>