@extends('layouts.login')

@section('title', 'SeekYu - Guards Login')

@section('content')
    <section class="flex justify-center items-center min-h-screen">
        <div id="loginFormContainer" class="max-w-lg w-full mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white" id="formTitle">HR, Head SG, SG, Client Login</h2>
                <a href="/" class="text-gray-400 hover:text-rose-500">
                    Back
                </a>
            </div>

            <p class="text-gray-400 mb-2" id="roleDescription">Enter your credentials to access your account</p>
            <!-- Info showing which roles this form handles -->
            <p id="multiRoleInfo" class="text-sm text-gray-500 mb-6"></p>

            <!-- Login Form -->
            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-300 mb-1">User ID</label>
                    <input type="text" name="role_id" placeholder="Enter ID (e.g. hr.001, hsg.001, sg.001, c.001)"
                        class="w-full rounded-md p-2 bg-gray-700 text-white focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full rounded-md p-2 bg-gray-700 text-white focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>

                <div class="flex items-center justify-between">
                    <!-- <div class="flex items-center">
                                                                <input type="checkbox" id="rememberMe" class="h-4 w-4 text-indigo-500 rounded">
                                                                <label for="rememberMe" class="ml-2 block text-sm text-gray-300">Remember me</label>
                                                            </div> -->
                    <a href="#" class="text-sm text-indigo-400 hover:text-indigo-300">Forgot password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-400 text-white font-semibold py-2 rounded-md transition duration-300 cursor-pointer">Login</button>

                @if ($errors->any())
                    <div class="mt-4 p-4 bg-red-600 text-white rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </section>
