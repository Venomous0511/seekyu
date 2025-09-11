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
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold">@yield('header-title', 'Super Admin Dashboard')</h1>
                <p class="text-gray-400">@yield('header-subtitle', 'Manage accounts, messaging, and notifications.')</p>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-4">

                <!-- Notifications -->
                <div class="relative">
                    <button id="notifToggle"
                        class="bg-gray-700 px-3 py-2 rounded-md flex items-center gap-2">
                        Notifications
                        <span id="notifCount"
                            class="bg-red-500 text-xs rounded-full px-2 py-0.5">3</span>
                    </button>
                    <div id="notifList"
                        class="absolute right-0 mt-2 w-72 bg-gray-900 border border-gray-700 rounded-lg shadow-lg hidden">
                        <ul class="divide-y divide-gray-700 text-sm">
                            <li class="p-3"><strong>New Application:</strong> Carlos submitted. <span class="text-gray-500 text-xs">2m</span></li>
                            <li class="p-3"><strong>Incident Report:</strong> Unauthorized access. <span class="text-gray-500 text-xs">3h</span></li>
                            <li class="p-3"><strong>Leave Request:</strong> Maria requested leave. <span class="text-gray-500 text-xs">1d</span></li>
                        </ul>
                        <div class="text-center p-2 border-t border-gray-700">
                            <a href="{{ url('Notif-Admin') }}" class="text-blue-400 hover:underline">View all</a>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="flex items-center gap-3">
                    <div>
                        <div class="font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-gray-400 text-sm">({{ Auth::user()->role_id }})</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        @yield('dashboard-content')
    </main>
</body>

</html>