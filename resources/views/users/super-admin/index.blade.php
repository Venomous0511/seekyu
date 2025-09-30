@extends('layouts.default')

@section('title', 'SeekYu - Super Admin Dashboard')


@section('content')
    {{-- DASHBOARD SECTION --}}
    <section class="dashboard-section p-10 m-6 bg-white rounded-lg shadow-md" id="dashboard">
        <h1 class="text-3xl font-bold mb-2">Super Admin Management Dashboard</h1>
        <p class="mb-6">Welcome to your security management portal. Monitor and manage all security operations from here.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Active Guards -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-blue-300 p-3 rounded-full">
                        <i class="fa-solid fa-user-shield text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold">{{ $activeGuards ?? 1234 }}</p>
                        <h2 class="text-lg font-semibold">Active Guards</h2>
                    </div>
                </div>
            </div>

            <!-- Active Clients -->
            <div class="bg-green-100 p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-green-300 p-3 rounded-full">
                        <i class="fa-solid fa-users text-green-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold">{{ $activeClients ?? 1234 }}</p>
                        <h2 class="text-lg font-semibold">Active Clients</h2>
                    </div>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-yellow-300 p-3 rounded-full">
                        <i class="fa-solid fa-clipboard-list text-yellow-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold">{{ $pendingRequests ?? 1234 }}</p>
                        <h2 class="text-lg font-semibold">Pending Requests</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-6">Recent Activities</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white text-left">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b text-center">Assigned By</th>
                            <th class="py-2 px-4 border-b text-center">Date</th>
                            <th class="py-2 px-4 border-b text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivities ?? [] as $activity)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $activity['name'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $activity['assigned_by'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $activity['date'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $activity['action'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-2 px-4 border-b">John Doe</td>
                                <td class="py-2 px-4 border-b text-center">HR</td>
                                <td class="py-2 px-4 border-b text-center">2023-10-01</td>
                                <td class="py-2 px-4 border-b text-center">New Registered</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b">Client XYZ</td>
                                <td class="py-2 px-4 border-b text-center">Admin</td>
                                <td class="py-2 px-4 border-b text-center">2023-10-02</td>
                                <td class="py-2 px-4 border-b text-center">New Account</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ACCOUNT MANAGEMENT SECTION --}}
    <section class="dashboard-section p-10 m-6 bg-white rounded-lg shadow-md hidden" id="account-management-section">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Account Management</h2>
            <div class="space-x-2 grid grid-cols-1 md:grid-cols-2 text-center">
                <a href="#create-account" class="bg-green-300 px-4 py-2 rounded hover:bg-green-400">Create Account</a>
                <a href="#view-accounts" class="bg-gray-200 px-4 py-2 rounded hover:bg-blue-300">View Accounts</a>
                {{-- <a href="#removed-accounts" class="bg-gray-200 px-4 py-2 rounded hover:bg-red-300">Removed Accounts</a> --}}
            </div>
        </div>

        {{-- Create Account Form --}}
        <div id="create-account">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="{{ route('superadmin.accounts.store') }}"
                method="POST">
                @csrf

                <div>
                    <label class="block text-md text-slate-600 mb-2">Full Name</label>
                    <input class="w-full px-3 py-2 border rounded bg-slate-50" type="text" name="name"
                        placeholder="Enter full name" value="{{ old('name') }}" required>
                </div>

                <div>
                    <label class="block text-md text-slate-600 mb-2">Email</label>
                    <input class="w-full px-3 py-2 border rounded bg-slate-50" type="email" name="email"
                        placeholder="Enter email" value="{{ old('email') }}" required>
                </div>

                <div class="mt-3">
                    <label class="block text-md text-slate-600 mb-2">Role</label>
                    <select id="roleSelect" class="w-full px-3 py-2 border rounded bg-slate-50" name="role" required>
                        <option value="" disabled selected>--Select Role--</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="Human Resource">Human Resource</option>
                        <option value="Head Security Guard">Head Security Guard</option>
                        <option value="Security Guard">Security Guard</option>
                        <option value="Client">Client</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label class="block text-md text-slate-600 mb-2">Password</label>
                    <input class="w-full px-3 py-2 border rounded bg-slate-50" type="password" name="password"
                        placeholder="Enter password" required>
                </div>

                <div class="mt-3">
                    <label class="block text-md text-slate-600 mb-2">Confirm Password</label>
                    <input class="w-full px-3 py-2 border rounded bg-slate-50" type="password" name="password_confirmation"
                        placeholder="Confirm password" required>
                </div>

                <div class="md:col-span-2 text-right mt-4">
                    <button type="submit" class="bg-gray-300 text-black px-6 py-2 rounded hover:bg-green-400">
                        Create Account
                    </button>
                    <button type="reset" class="bg-gray-300 text-black px-6 py-2 rounded hover:bg-red-400">
                        Reset
                    </button>
                </div>

                @if ($errors->any())
                    <div class="mt-4 p-4 bg-red-600 text-white rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-600 text-white rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>

        {{-- View Accounts --}}
        <div class="hidden" id="view-accounts">
            <div class="flex items-center gap-3 mb-4">
                <input class="w-full px-3 py-4 border rounded bg-slate-50" type="text" name="search"
                    placeholder="Search by name, username, or role..." id="search">
                <button class="text-sm bg-gray-200 text-black px-4 py-2 rounded text-center hover:bg-purple-400">
                    <i class="fa-solid fa-rotate"></i> Refresh
                </button>
            </div>

            <table class="min-w-full bg-white text-left border rounded">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4 text-center">Role ID</th>
                        <th class="py-2 px-4 text-center">Role</th>
                        <th class="py-2 px-4 text-center">Status</th>
                        <th class="py-2 px-4 text-center">Date</th>
                        <th class="py-2 px-4 text-center">Operations</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $user->role_id }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ ucfirst($user->role) }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <span
                                    class="px-2 py-1 rounded text-xs 
                                        {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">{{ $user->created_at->format('m-d-Y') }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('superadmin.accounts.edit', $user->id) }}"
                                    class="text-blue-600 hover:underline mx-1">Edit</a>
                                <form method="POST" action="{{-- route('admin.accounts.destroy', $user->id) --}}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline mx-1"
                                        onclick="return confirm('Are you sure?')">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Removed Accounts --}}
        {{-- <div class="hidden" id="removed-accounts">
            <div class="flex items-center gap-3 mb-4">
                <input class="w-full px-3 py-2 border rounded bg-slate-50" type="text" name="search"
                    placeholder="Search removed accounts..." id="search">
            </div>

            <table class="min-w-full bg-white text-left border rounded">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4">Login ID</th>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4 text-center">Username</th>
                        <th class="py-2 px-4 text-center">Role</th>
                        <th class="py-2 px-4 text-center">Date Removed</th>
                        <th class="py-2 px-4 text-center">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($removedUsers ?? [] as $user)
                        <tr>
                            <td class="py-2 px-4">{{ $user->id }}</td>
                            <td class="py-2 px-4">{{ $user->name }}</td>
                            <td class="py-2 px-4 text-center">{{ $user->username }}</td>
                            <td class="py-2 px-4 text-center">{{ ucfirst($user->role) }}</td>
                            <td class="py-2 px-4 text-center">{{ $user->deleted_at->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 text-center">
                                <form method="POST" action="" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:underline mx-1">Restore</button>
                                </form>
                                <form method="POST" action="" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline mx-1"
                                        onclick="return confirm('Permanently delete this account?')">Delete
                                        Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">No removed accounts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> --}}
    </section>

    {{-- Messages Section --}}
    <section class="dashboard-section p-10 m-6 bg-white rounded-lg shadow-md hidden" id="messages">
        <h2 class="text-2xl font-bold mb-6">Messages</h2>
        <p class="text-gray-600">Message functionality coming soon...</p>
    </section>

    {{-- Notifications Section --}}
    <section class="dashboard-section p-10 m-6 bg-white rounded-lg shadow-md hidden" id="notifications">
        <h2 class="text-2xl font-bold mb-6">Notifications</h2>
        <p class="text-gray-600">Notifications panel coming soon...</p>
    </section>

    {{-- Users Record Section --}}
    <section class="dashboard-section p-10 m-6 bg-white rounded-lg shadow-md hidden" id="users-record">
        <h2 class="text-2xl font-bold mb-6">Users Record</h2>
        <p class="text-gray-600">User records and analytics coming soon...</p>
    </section>

    {{-- System Settings Section --}}
    <section class="dashboard-section p-10 m-6 bg-white rounded-lg shadow-md hidden" id="system-settings">
        <h2 class="text-2xl font-bold mb-6">System Settings</h2>
        <p class="text-gray-600">System configuration panel coming soon...</p>
    </section>
@endsection

@push('scripts')
    @vite(['resources/js/dashboards.js'])
@endpush
