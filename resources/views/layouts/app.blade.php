<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'SeekYu'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! ToastMagic::styles() !!}
</head>

<body class="antialiased">
    <!-- Main Content -->
    <main class="relative z-10">
        @yield('content')
    </main>

    {!! ToastMagic::scripts() !!}
</body>

</html>