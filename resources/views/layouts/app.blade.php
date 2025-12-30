<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard PMB') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-blue-900 text-white fixed inset-y-0 left-0">
        <div class="p-6 font-bold text-xl border-b border-blue-800">
            SI AKAD
        </div>

        <nav class="mt-4 space-y-1 px-4">

            {{-- ================= ADMIN ================= --}}
            @if(auth()->user()->role === 'admin')

                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 rounded-lg
                   {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-800' }}">
                    📊 Dashboard
                </a>

                <a href="{{ route('admin.pendaftar.index') }}"
                   class="block px-4 py-2 rounded-lg
                   {{ request()->routeIs('admin.pendaftar.*') ? 'bg-blue-700' : 'hover:bg-blue-800' }}">
                    👨‍🎓 Data Pendaftar
                </a>

                <a href="{{ route('admin.dosen.index') }}"
                   class="block px-4 py-2 rounded-lg
                   {{ request()->routeIs('admin.dosen.*') ? 'bg-blue-700' : 'hover:bg-blue-800' }}">
                    👨‍🏫 Data Dosen
                </a>

                <a href="{{ route('admin.prodi.index') }}"
                   class="block px-4 py-2 rounded-lg
                   {{ request()->routeIs('admin.prodi.*') ? 'bg-blue-700' : 'hover:bg-blue-800' }}">
                    🎓 Program Studi
                </a>

            {{-- ================= PENDAFTAR ================= --}}
            @else

                <a href="{{ route('pendaftar.dashboard') }}"
                   class="block px-4 py-2 rounded-lg
                   {{ request()->routeIs('pendaftar.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-800' }}">
                    🏠 Dashboard
                </a>

                <a href="{{ route('pendaftar.create') }}"
                   class="block px-4 py-2 rounded-lg
                   {{ request()->routeIs('pendaftar.create') ? 'bg-blue-700' : 'hover:bg-blue-800' }}">
                    📝 Form Pendaftaran
                </a>

            @endif

        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 ml-64 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
