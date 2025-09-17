<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">

            <div class="px-4 space-y-1">
                <div class="text-gray-400 text-xs uppercase tracking-wider font-medium px-4 mb-3">Main Menu</div>

                <!-- Sidebar Always Visible to All -->
                <button onclick="showSection('dashboard')" class="sidebar-item active w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-home mr-3 text-lg text-blue-400"></i>
                    <span>Dashboard</span>
                </button>

                @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin' || Auth::user()->role === 'hr' || Auth::user()->role === 'client')
                <button onclick="showSection('messaging-mgmt')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i>
                    <span>Send Message</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                </button>
                @endif

                <!-- Super Admin Sidebar -->
                @if(Auth::user()->role === 'super_admin')
                <button onclick="showSection('accounts')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-user-cog mr-3 text-lg text-purple-400"></i>
                    <span>Account Management</span>
                </button>
                @endif

                <!-- Admin & HR Sidebar -->
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'hr')
                <button onclick="showSection('recruitment')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-user-cog mr-3 text-lg text-purple-400"></i> -->
                    <span>Recruitment Management</span>
                </button>

                <button onclick="showSection('client')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Client Management</span>
                </button>

                <button onclick="showSection('security-guard')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Security Guard Management</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>KPI Evaluation</span>
                </button>
                @endif

                <!-- Head Security Guard Sidebar -->
                @if(Auth::user()->role === 'head_security_guard' || Auth::user()->role === 'security_guard')
                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Incident Report</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>KPI Performance</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Shift Schedule</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Request for Leave</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Deployment Request</span>
                </button>
                @endif

                @if(Auth::user()->role === 'client')
                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Incident Report</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>KPI Evaluation</span>
                </button>

                <button onclick="showSection('kpi')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Deployment Request</span>
                </button>
                @endif
            </div>


            <div class="px-4 space-y-1 mt-8">
                @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin' || Auth::user()->role === 'hr')
                <div class="text-gray-400 text-xs uppercase tracking-wider font-medium px-4 mb-3">Reports & Analytics</div>
                @endif

                <!-- Super Admin Sidebar -->
                @if(Auth::user()->role === 'super_admin')
                <button onclick="showSection('notification')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-exclamation-circle mr-3 text-lg text-yellow-400"></i>
                    <span>Notifications</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">1</span>
                </button>

                <button onclick="showSection('user-activity')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i>
                    <span>View User Activity</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                </button>
                @endif

                <!-- Admin & HR Sidebar -->
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'hr')
                <button onclick="showSection('leave-requests')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Leave Requests</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">1</span>
                </button>

                <button onclick="showSection('incident')" class="sidebar-item w-full text-left flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 rounded-lg group">
                    <!-- <i class="fas fa-comment mr-3 text-lg text-indigo-400"></i> -->
                    <span>Incident Reports</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                </button>
                @endif
            </div>

        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-700">
            <form action="/logout" method="post">
                @csrf
                <button class="w-full flex items-center justify-center px-4 py-3 text-gray-200 hover:bg-red-700 hover:text-white rounded-lg bg-red-600 cursor-pointer">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Page Content -->
        @yield('dashboard-content')
    </main>

    {!! ToastMagic::scripts() !!}
</body>

</html>