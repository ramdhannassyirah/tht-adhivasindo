<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap"
        rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

            <!-- Logo / Title -->
            <h1 class="text-lg font-semibold text-gray-700">
                {{ config('app.name', 'Laravel') }}
            </h1>

            <!-- Menu -->
            @if (Route::has('login'))
                <nav x-data="{ isLogin: localStorage.getItem('token') }" class="flex items-center gap-4">

                    <template x-if="isLogin">
                        <a href="/dashboard"
                            class="px-4 py-2 rounded-lg bg-blue-500 text-white text-sm hover:bg-blue-600 transition">
                            Dashboard
                        </a>
                    </template>

                    <template x-if="!isLogin">
                        <a href="/login"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-sm hover:bg-gray-100 transition">
                            Login
                        </a>
                    </template>

                </nav>
            @endif

        </div>
    </header>

    <!-- Content -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="p-6">
            {{ $slot }}
        </div>
    </main>


    <!-- FOOTER -->
    <footer class="bg-gray-800 text-gray-300 py-6 text-center">
        <p>&copy; 2026 Toko Sederhana. All rights reserved.</p>
    </footer>



    @stack('scripts')

</body>

</html>
