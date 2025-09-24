@extends('layouts.app')

@section('title', 'SeekYu - Home')

<!-- Navbar -->
<header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1">
            <a href="/" class="text-2xl font-bold text-white hover:text-indigo-400">Seekyu</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-x-6">
            <button command="show-modal" commandfor="dialog"
                class="text-sm font-semibold text-white hover:text-indigo-400 cursor-pointer">
                Log in →
            </button>
        </div>
    </nav>
</header>

@section('content')
    <!-- Home Section -->
    <section class="h-screen flex items-center justify-center relative home-section">
        <div class="absolute inset-0 bg-black/80 z-0"></div>

        <div class="max-w-2xl text-center relative z-10">
            <h1 class="text-5xl font-bold text-white sm:text-6xl">
                Apply as a Security Guard or Hire One
            </h1>
            <p class="mt-6 text-lg text-gray-300">
                Welcome to SeekYu — your trusted platform to apply as security personnel or to hire one.
            </p>
            <div class="mt-10 flex justify-center gap-x-6">
                <button command="show-modal" commandfor="dialog"
                    class="rounded-md bg-indigo-500 px-4 py-2 text-white font-semibold hover:bg-indigo-400 cursor-pointer">
                    Get started
                </button>
                <button onclick="showHomeSection('learnmore')"
                    class="text-white font-semibold hover:text-indigo-400 cursor-pointer">
                    Learn more →
                </button>
            </div>
        </div>
    </section>

    <!-- Learn More -->
    <section id="learnmore" class="hidden min-h-screen flex items-center justify-center bg-black/80 px-6 home-section">
        <div class="bg-gray-950/80 p-10 rounded-xl text-center max-w-3xl">
            <h2 class="text-3xl font-bold text-white">Why Choose Seekyu?</h2>
            <p class="mt-4 text-gray-300">
                Seekyu connects qualified security guards with companies and clients in need.
                Whether you're applying for a job or hiring trusted personnel, our platform ensures efficiency and
                reliability.
            </p>
        </div>
    </section>

    <!-- Role login Selection -->
    <el-dialog>
        <dialog id="dialog" aria-labelledby="dialog-title"
            class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
            <el-dialog-backdrop
                class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

            <div tabindex="0"
                class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                <el-dialog-panel
                    class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                    <div id="roleSelection" class="p-8 mx-auto">
                        <!-- Close Button -->
                        <div class="flex justify-end mb-4">
                            <button command="close" commandfor="dialog"
                                class="text-gray-400 hover:text-rose-500 focus:outline-none cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Title -->
                        <h2 class="text-3xl font-bold text-center text-white">Welcome to Seekyu</h2>
                        <p class="text-center text-gray-400 mt-2">Choose a login type to continue.</p>

                        <!-- Two main merged buttons -->
                        <div class="mt-6 space-y-6">
                            <div>
                                <h3 class="text-sm text-gray-300 mb-2">This login handles:</h3>
                                <p class="text-sm text-gray-400 mb-3">Head Security Guard, Security Guard, Client</p>
                                <a href="/login/sg"
                                    class="block w-full text-center bg-gradient-to-r from-teal-600 to-blue-600 text-white p-4 rounded-md text-md font-semibold shadow cursor-pointer transform transition-transform hover:scale-105">
                                    Head SG / Security Guard / Client
                                </a>
                            </div>

                            <div>
                                <h3 class="text-sm text-gray-300 mb-2">This login handles:</h3>
                                <p class="text-sm text-gray-400 mb-3">Super Admin, Admin, HR</p>
                                <a href="/login/admin"
                                    class="block w-full text-center bg-gradient-to-r from-purple-700 to-indigo-600 text-white p-4 rounded-md text-md font-semibold shadow cursor-pointer transform transition-transform hover:scale-105">
                                    Super Admin / Admin / HR
                                </a>
                            </div>
                        </div>

                        <!-- Small helper text -->
                        <p class="mt-6 text-xs text-gray-400 text-center">
                            No dropdowns — the form will accept IDs for any of the listed roles.
                            Use standard role prefixes (e.g., <code>sg.123</code> for a security guard).
                        </p>

                        <!-- Applicant section -->
                        <div class="mt-6 text-center space-y-3">
                            <a
                                class="block text-sm text-green-400 transition-colors duration-300 hover:text-green-300 underline cursor-pointer">
                                New here? Start your application
                            </a>
                            <a
                                class="block w-full bg-green-600 transition-colors duration-300 hover:bg-green-500 text-white p-2 rounded-md text-sm font-medium cursor-pointer">
                                Applicant Login
                            </a>
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
@endsection

<!-- Footer (optional) -->
<!--
<footer class="text-center text-white py-6 absolute inset-x-0 bottom-0">
    © {{ date('Y') }} SeekYu. All rights reserved.
</footer>
-->
