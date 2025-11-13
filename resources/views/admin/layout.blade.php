<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg flex-shrink-0">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Admin Panel</h2>
            </div>

            <nav class="px-4 py-6 space-y-3">
                @php
                  $links = [
                  ['route'=>'home', 'icon'=>'🏠','label'=>'Home'], // Home link added
                  ['route'=>'admin.dashboard', 'icon'=>'📊','label'=>'Dashboard'],
                  ['route'=>'admin.blogs.index','icon'=>'📝','label'=>'Manage Blogs'],
                  ['route'=>'admin.users.index','icon'=>'👥','label'=>'Manage Users'],
                  ['route'=>'admin.messages.index','icon'=>'✉️','label'=>'Messages'],
                   ['route'=>'services.index','icon'=>'🛠️','label'=>'Manage Services'],
                  ];
                @endphp

                @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs($link['route'].'*') 
                            ? 'bg-indigo-100 dark:bg-indigo-600 text-indigo-700 dark:text-white font-semibold' 
                            : 'hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    {{ $link['icon'] }} <span>{{ $link['label'] }}</span>
                </a>
                @endforeach
            </nav>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="bg-white dark:bg-gray-800 shadow flex justify-between items-center px-6 py-4 sticky top-0 z-10">
                <h1 class="text-lg font-semibold">@yield('title')</h1>

                <div class="flex items-center space-x-4">
                    <!-- Dark Mode -->
                    <button x-data @click="darkMode = !darkMode" class="p-2 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 010 2A6 6 0 104 10a1 1 0 01-2 0A8 8 0 1010 2z" />
                        </svg>
                        <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                        </svg>
                    </button>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="p-6 bg-gray-50 dark:bg-gray-900 flex-1 overflow-auto">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>
