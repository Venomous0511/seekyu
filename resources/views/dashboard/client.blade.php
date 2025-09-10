@extends('layouts.app')
@section('title', 'SeekYu - Client Dashboard')
@section('content')
<section class="min-h-screen flex flex-col">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Client Dashboard</h1>
        <div class="text-sm flex items-center gap-4">
            <div>
                Logged in as:
                <span class="font-semibold">{{ Auth::user()->name }}</span>
                ({{ Auth::user()->role_id }})
            </div>

            <!-- Logout Button -->
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

        <!-- Example dashboard cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Total Hired Guards</h3>
                <p class="text-3xl font-bold">15</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Active Contracts</h3>
                <p class="text-3xl font-bold">4</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Pending Requests</h3>
                <p class="text-3xl font-bold">2</p>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        &copy; 2024 SeekYu. All rights reserved.
    </footer>
</section>
@endsection