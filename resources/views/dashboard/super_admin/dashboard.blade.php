@extends('layouts.dashboard')

@section('title', 'SeekYu - Super Admin Dashboard')

@section('header-title', 'Super Admin Dashboard')
@section('header-subtitle', 'Manage accounts, messaging, and notifications.')

<!-- Sidebar -->
<aside class="w-56 bg-black text-white flex flex-col p-5 shadow-lg">
    <div class="text-2xl font-bold mb-8">SeekYu</div>
    <nav>
        <ul class="space-y-3">
            <li>
                <a href="{{ route('dashboard.super-admin') }}" class="w-full block py-2 px-3 rounded-md hover:bg-gray-700">
                    Account Management
                </a>
            </li>
            <li>
                <a href="#" class="w-full block py-2 px-3 rounded-md hover:bg-gray-700">
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

@section('dashboard-content')

<!-- Account Management Section -->
@include('dashboard.super_admin.accounts.index')

<!-- Toast Container -->
<div id="toastContainer" class="fixed top-6 right-6 flex flex-col-reverse gap-2 z-50"></div>
@endsection