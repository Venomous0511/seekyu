<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Reliable security services for homes, businesses, and events. In partnership with Seekyu for modern recruitment and HRIS." />

    <title>@yield('title', config('app.name', 'SeekYu'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
    {!! ToastMagic::styles() !!}
</head>

<body class="bg-gray-100 min-h-screen flex">
    <header class="sidebar bg-gray-800 text-white w-72 min-h-screen flex flex-col">
        <!-- Logo -->
        <div class="p-5 border-b border-gray-700 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('images/MJL logo.png') }}" alt="SeekYu Logo" class="h-14 w-auto">
                <div class="ml-3">
                    <p class="text-xl font-semibold">SeekYu</p>
                    <span class="text-xs text-slate-400">Security Management Suite</span>
                </div>
            </div>

            <button id="sidebar-toggle" class="text-gray-400 hover:text-white lg:hidden" title="Close sidebar menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-4">
            <div class="px-4 space-y-1">
                <div class="text-gray-400 text-xs uppercase tracking-wider font-medium px-4 mb-3">Main Menu</div>

                @auth

                    @php
                        $role = trim(strtolower(Auth::user()->role));
                        $partial = 'layouts.partials.' . str_replace(' ', '-', $role) . '-sidebar';
                    @endphp

                    @includeIf($partial)
                @endauth
            </div>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-700">
            <form action="/logout" method="post">
                @csrf
                <button
                    class="w-full flex items-center justify-center px-4 py-3 text-gray-200 hover:bg-red-700 hover:text-white rounded-lg bg-red-600 cursor-pointer">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </header>

    <main class="flex-1 flex flex-col overflow-hidden">
        @yield('content')
    </main>
    {!! ToastMagic::scripts() !!}
</body>

</html>
