@extends('layouts.dashboard')

@section('title', 'SeekYu - Super Admin Dashboard')

<!-- Sidebar -->
<aside class="w-56 bg-black text-white flex flex-col p-5 shadow-lg">
    <div class="text-2xl font-bold mb-8">SeekYu</div>
    <nav>
        <ul class="space-y-3">
            <li>
                <a href="{{ route('dashboard.super-admin') }}"
                    class="w-full block py-2 px-3 rounded-md hover:bg-gray-700">
                    Account Management
                </a>
            </li>
            <li>
                <a href="#"
                    class="w-full block py-2 px-3 rounded-md hover:bg-gray-700">
                    Messaging
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full block text-left py-2 px-3 rounded-md hover:bg-gray-700 cursor-pointer">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>

<!-- <section class="min-h-screen flex flex-col">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Super Admin Dashboard</h1>
        <div class="text-sm flex items-center gap-4">
            <div>
                Logged in as:
                <span class="font-semibold">{{ Auth::user()->name }}</span>
                ({{ Auth::user()->role_id }})
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="flex-grow p-6 bg-gray-900 text-white">
        <h2 class="text-xl font-semibold mb-4">
            Welcome back, {{ Auth::user()->name }}!
        </h2>
        <p class="mb-6">
            Role: <span class="text-teal-400">{{ Auth::user()->role }}</span><br>
            Email: <span class="text-gray-300">{{ Auth::user()->email }}</span>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                <p class="text-3xl font-bold">1,234</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Active Admins</h3>
                <p class="text-3xl font-bold">12</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Pending Approvals</h3>
                <p class="text-3xl font-bold">5</p>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        &copy; 2024 SeekYu. All rights reserved.
    </footer>
</section> -->

@section('dashboard-content')
<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold">Super Admin Dashboard</h1>
        <p class="text-gray-400">Manage accounts, messaging, and notifications.</p>
    </div>

    <!-- Profile -->
    <div class="flex items-center gap-3">
        <div>
            <div class="font-semibold">{{ Auth::user()->name }}</div>
            <div class="text-gray-400 text-sm">({{ Auth::user()->role_id }})</div>
        </div>
    </div>
</div>

@include('dashboard.super_admin.accounts.index')
@endsection