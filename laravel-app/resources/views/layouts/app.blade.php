<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cyberbullying Detection System')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f8fafc;
        }

        .menu-active {
            background: #eff6ff;
            color: #2563eb;
            font-weight: 600;
        }

        .glass {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.8);
        }
    </style>

    @stack('styles')

</head>

<body class="min-h-screen flex flex-col bg-slate-100">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 glass border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center h-20">

                <!-- LOGO -->
                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl overflow-hidden shadow-lg bg-white">

                        <img src="{{ asset('images/logo.png') }}" alt="YouScan Logo"
                            class="w-full h-full object-contain">

                    </div>

                    <div>

                        <h1 class="font-bold text-slate-800">
                            YouScan
                        </h1>

                        <p class="text-xs text-slate-500">
                            YouTube Comment Analysis System
                        </p>

                    </div>

                </div>

                <!-- MENU -->
                <div class="hidden lg:flex items-center gap-2">

                    <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-xl transition
                        {{ request()->routeIs('dashboard') ? 'menu-active' : 'hover:bg-slate-100' }}">
                        Beranda
                    </a>

                    <a href="{{ route('analysis') }}" class="px-5 py-2 rounded-xl transition
                        {{ request()->routeIs('analysis') ? 'menu-active' : 'hover:bg-slate-100' }}">
                        Analisis
                    </a>

                    <a href="{{ route('history') }}" class="px-5 py-2 rounded-xl transition
                        {{ request()->routeIs('history') ? 'menu-active' : 'hover:bg-slate-100' }}">
                        Riwayat
                    </a>

                    <a href="{{ route('report') }}" class="px-5 py-2 rounded-xl transition
                        {{ request()->routeIs('report') ? 'menu-active' : 'hover:bg-slate-100' }}">
                        Laporan
                    </a>

                    <a href="{{ route('about') }}" class="px-5 py-2 rounded-xl transition
                        {{ request()->routeIs('about') ? 'menu-active' : 'hover:bg-slate-100' }}">
                        Tentang Kami
                    </a>

                </div>

            </div>

        </div>

    </nav>
    <!-- CONTENT -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200 bg-white">

        <div class="max-w-7xl mx-auto px-6 py-6">

            <div class="flex flex-col md:flex-row items-center justify-between">

                <p class="text-sm text-slate-500">
                    © {{ date('Y') }} Cyberbullying Detection System
                </p>

                <div class="flex items-center gap-6 mt-3 md:mt-0">

                    <a href="{{ route('dashboard') }}" class="text-sm text-slate-500 hover:text-blue-600 transition">
                        Beranda
                    </a>

                    <a href="{{ route('analysis') }}" class="text-sm text-slate-500 hover:text-blue-600 transition">
                        Analisis
                    </a>

                    <a href="{{ route('about') }}" class="text-sm text-slate-500 hover:text-blue-600 transition">
                        Tentang
                    </a>

                </div>

            </div>

        </div>

    </footer>


    @stack('scripts')

</body>

</html>