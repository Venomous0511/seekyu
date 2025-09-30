@extends('layouts.login')

@section('title', 'SeekYu - Edit Account')

@section('content')
    <div id="edit-account" class="p-6 bg-white rounded shadow-md w-full max-w-4xl mx-auto mt-10">
        <form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="{{ route('superadmin.accounts.update', $user->id) }}"
            method="POST">
            @csrf
            @method('PUT')

            <!-- Full Name -->
            <div>
                <label class="block text-md text-slate-600 mb-2">Full Name</label>
                <input class="w-full px-3 py-2 border rounded bg-slate-50" type="text" name="name"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-md text-slate-600 mb-2">Email</label>
                <input class="w-full px-3 py-2 border rounded bg-slate-50" type="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Role -->
            <div class="mt-3">
                <label class="block text-md text-slate-600 mb-2">Role</label>
                <select id="roleSelect" class="w-full px-3 py-2 border rounded bg-slate-50" name="role" required>
                    <option value="" disabled>--Select Role--</option>
                    <option value="Super Admin" {{ $user->role === 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Human Resource" {{ $user->role === 'Human Resource' ? 'selected' : '' }}>
                        Human Resource
                    </option>
                </select>
            </div>

            <!-- Password (Optional Update) -->
            <div class="mt-3">
                <label class="block text-md text-slate-600 mb-2">New Password (optional)</label>
                <input class="w-full px-3 py-2 border rounded bg-slate-50" type="password" name="password"
                    placeholder="Leave blank to keep current">
            </div>

            <!-- Confirm Password (Optional Update) -->
            <div class="mt-3">
                <label class="block text-md text-slate-600 mb-2">Confirm New Password</label>
                <input class="w-full px-3 py-2 border rounded bg-slate-50" type="password" name="password_confirmation"
                    placeholder="Leave blank to keep current">
            </div>

            <!-- Buttons -->
            <div class="md:col-span-2 flex justify-end mt-4">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200 cursor-pointer">
                    Update Account
                </button>

                <a href="{{ route('dashboard.super-admin') }}"
                    class="ml-4 px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition duration-200 cursor-pointer">
                    Cancel
                </a>
            </div>
        </form>

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
    </div>
@endsection
