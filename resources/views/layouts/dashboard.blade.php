<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'SeekYu'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! ToastMagic::styles() !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <div class="sidebar bg-gray-800 text-white w-64 min-h-screen flex flex-col">
        <!-- Logo -->
        <div class="p-5 border-b border-gray-700 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-shield-alt text-blue-400 text-2xl mr-3"></i>
                <span class="text-xl font-semibold">SeekYu</span>
            </div>

            <button id="sidebar-toggle" class="text-gray-400 hover:text-white lg:hidden" title="Close sidebar menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="px-4 space-y-1">
                <div class="text-gray-400 text-xs uppercase tracking-wider font-medium px-4 mb-3">Main Menu</div>

                @includeWhen(Auth::user(), 'layouts.partials.' . strtolower(Auth::user()->role) . '-sidebar')
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
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        @yield('dashboard-content')
    </main>

    {!! ToastMagic::scripts() !!}
</body>

</html>
