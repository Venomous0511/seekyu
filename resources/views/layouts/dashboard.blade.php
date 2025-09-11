<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'SeekYu'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex bg-gray-900 text-white min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-800 overflow-y-auto">
        <!-- Page Content -->
        @yield('dashboard-content')
    </main>
</body>

</html>