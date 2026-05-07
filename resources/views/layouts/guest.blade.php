<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="navbar()" x-init="initTheme()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = { darkMode: 'class' };
        </script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            function navbar() {
                return {
                    open: false,
                    scrolled: false,
                    darkMode: false,
                    scrollY: 0,

                    initTheme() {
                        this.darkMode = localStorage.getItem('theme') === 'dark';
                        if (this.darkMode) document.documentElement.classList.add('dark');

                        window.addEventListener('scroll', () => {
                            this.scrolled = window.scrollY > 10;
                        });
                    },

                    toggleDarkMode() {
                        this.darkMode = !this.darkMode;
                        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                        document.documentElement.classList.toggle('dark', this.darkMode);
                    },

                    toggleMenu() {
                        this.open = !this.open;
                        if (this.open) {
                            this.scrollY = window.scrollY;
                            document.body.style.position = 'fixed';
                            document.body.style.top = `-${this.scrollY}px`;
                        } else {
                            document.body.style.position = '';
                            document.body.style.top = '';
                            window.scrollTo(0, this.scrollY);
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Navbar -->
        <nav 
            :class="scrolled 
                ? 'shadow-lg bg-white dark:bg-gray-900 backdrop-blur-sm' 
                : 'bg-white dark:bg-gray-900 shadow-none'"
            class="fixed w-full top-0 z-20 transition-all duration-300"
        >
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">MyBlogsite!</h1>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center space-x-8 font-medium">
                    <ul class="flex space-x-6">
                        <li><a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition">About</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Services</a></li>
                        <li><a href="{{ route('publicblog.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Blogs</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Contact</a></li>
                    </ul>

                    <div class="flex items-center space-x-3 ml-10">
                        <a href="{{ route('login') }}" class="px-4 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition font-semibold">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-1.5 bg-gray-800 dark:bg-indigo-400 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-indigo-500 transition font-semibold">Register</a>
                    </div>
                </div>

                <!-- Theme Toggle -->
                <div class="flex items-center space-x-4">
                    <button @click="toggleDarkMode()" class="relative w-9 h-9 flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-800 transition-all duration-500">
                        <svg x-show="!darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-yellow-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m8.66-8.66h1M4.34 12.34H3m15.36 6.36l.7.7M5.64 5.64l.7.7m12.02 0l-.7.7M6.34 17.66l-.7.7M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                        <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-indigo-400"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z"/></svg>
                    </button>
                    <button @click="toggleMenu()" class="md:hidden focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </nav>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-24 pb-12 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
