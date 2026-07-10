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

            <h1 class="text-lg font-semibold text-gray-700">
                {{ config('app.name', 'Laravel') }}
            </h1>

            @if (Route::has('login'))
                <nav x-data="{ isLogin: localStorage.getItem('token'), user: JSON.parse(localStorage.getItem('user')) }" class="flex items-center gap-4">

                    <template x-if="isLogin">
                        <div class="flex items-center gap-2">
                            <p x-text="user.name" class="px-4 py-2 bg-gray-100 rounded-lg text-sm text-gray-700"></p>
                            <template x-if="user.role === 'customer'" class="relative">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path
                                            d="M3.864 16.455c-.858-3.432-1.287-5.147-.386-6.301S6.148 9 9.685 9h4.63c3.538 0 5.306 0 6.207 1.154s.472 2.87-.386 6.301c-.546 2.183-.818 3.274-1.632 3.91c-.814.635-1.939.635-4.189.635h-4.63c-2.25 0-3.375 0-4.189-.635c-.814-.636-1.087-1.727-1.632-3.91Z" />
                                        <path
                                            d="m19.5 9.5l-.71-2.605c-.274-1.005-.411-1.507-.692-1.886A2.5 2.5 0 0 0 17 4.172C16.56 4 16.04 4 15 4M4.5 9.5l.71-2.605c.274-1.005.411-1.507.692-1.886A2.5 2.5 0 0 1 7 4.172C7.44 4 7.96 4 9 4" />
                                        <path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Z" />
                                    </g>
                                </svg>
                                <span>
                                    <template x-if="cart_count > 0">
                                        <span class="absolute -top-2 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                                    </template>
                                </span>
                            </template>
                        </div>
                    </template>

                    <template x-if="isLogin && user.role === 'admin'">
                        <div class="flex items-center gap-4">
                            <a href="/dashboard"
                                class="px-4 py-2 bg-gray-700 rounded-lg text-sm text-gray-100 transition">
                                Dashboard
                            </a>

                        </div>
                    </template>

                    <template x-if="isLogin">
                        <a href="#" @click.prevent="logout()"
                            class="  text-red-500 hover:text-red-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                            </svg>

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

    <main class="">
        <div class="">
            {{ $slot }}
        </div>
    </main>


    <footer class="bg-gray-800 text-gray-300 py-6 text-center">
        <p>&copy; 2026 Toko Sederhana. All rights reserved.</p>
    </footer>



    @stack('scripts')
    <script>
        function logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            window.location.href = '/';
        }
    </script>

</body>

</html>
