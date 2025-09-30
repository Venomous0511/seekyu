<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Reliable security services for homes, businesses, and events. In partnership with Seekyu for modern recruitment and HRIS." />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
</head>

<body class="font-sans text-slate-800 bg-white selection:bg-brand-accent/30 selection:text-brand-dark">
    <!-- =============== Header =============== -->
    <header class="sticky top-0 z-40 bg-brand-dark/90 backdrop-blur text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <!-- Brand -->
                <a href="/" class="flex items-center gap-3">
                    <img src="images/MJL logo.png" alt="MJL Security Agency logo" class="h-10 w-auto" />
                    <span class="text-lg sm:text-xl font-extrabold tracking-tight">MJL Security Agency</span>
                </a>
                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a class="hover:text-brand-accent/90" href="#services">Services</a>
                    <a class="hover:text-brand-accent/90" href="#why">Why MJL</a>
                    <a class="hover:text-brand-accent/90" href="#about">About</a>
                    <a class="hover:text-brand-accent/90" href="#contact">Contact</a>
                    <button
                        class="px-4 py-2 rounded-full bg-brand-accent text-black font-medium hover:bg-yellow-300 transition"
                        data-login-btn>Login</button>
                </nav>
                <!-- Mobile button -->
                <button class="md:hidden inline-flex items-center justify-center p-2 rounded-lg hover:bg-white/10"
                    aria-label="Open menu" data-mobile-nav-btn>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Nav Panel -->
        <div id="mobileNav" class="md:hidden hidden border-t border-white/10 bg-brand-dark">
            <div class="px-4 pb-4 pt-2 space-y-1 text-sm">
                <a class="block py-2 hover:text-brand-accent/90" href="#services"
                    onclick="toggleMobileNav(false)">Services</a>
                <a class="block py-2 hover:text-brand-accent/90" href="#why" onclick="toggleMobileNav(false)">Why
                    MJL</a>
                <a class="block py-2 hover:text-brand-accent/90" href="#about"
                    onclick="toggleMobileNav(false)">About</a>
                <a class="block py-2 hover:text-brand-accent/90" href="#contact"
                    onclick="toggleMobileNav(false)">Contact</a>
                <button
                    class="w-full mt-2 px-4 py-2 rounded-md bg-brand-accent text-black font-medium hover:bg-yellow-300"
                    data-login-btn>Login</button>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- =============== Footer =============== -->
    <footer class="bg-brand-dark text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm">© <span>2025</span> MJL Security Agency. In partnership with <button
                        class="text-brand-accent hover:underline" onclick="openLogin()">Seekyu</button>.</p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="#services" class="hover:text-brand-accent">Services</a>
                    <a href="#about" class="hover:text-brand-accent">About</a>
                    <a href="#contact" class="hover:text-brand-accent">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- =============== Login Modal =============== -->
    <div id="loginModal" class="fixed inset-0 z-50 modal-hidden" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-black/70" data-close-modal></div>
        <div class="relative mx-auto max-w-xl w-[92%] sm:w-full mt-24">
            <div class="bg-slate-900 text-white rounded-2xl shadow-soft ring-1 ring-white/10 p-6 sm:p-8">
                <div class="flex items-start justify-between gap-6">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold">Welcome to Seekyu</h2>
                        <p class="text-slate-300 mt-1">Choose a login type to continue.</p>
                    </div>
                    <button class="text-slate-400 hover:text-white" data-close-modal
                        aria-label="Close login modal">✕</button>
                </div>

                <div class="mt-6 w-full grid gap-4 sm:grid-cols-2">
                    <!-- Group A -->
                    <form action="/login/guards" method="get">
                        @csrf
                        <button type="submit"
                            class="lift text-left p-4 rounded-xl bg-gradient-to-br from-teal-600 to-blue-600 shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-white w-full">
                            <p class="text-xs text-white/80">Client, Security Guard, Head Guard, HR</p>
                            <p class="mt-1 font-semibold">Client / Security / Head / HR</p>
                        </button>
                    </form>
                    <!-- Group B -->
                    <form action="/login/admins" method="get">
                        @csrf
                        <button type="submit"
                            class="lift text-left p-4 rounded-xl bg-gradient-to-br from-purple-700 to-indigo-600 shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-white w-full">
                            <p class="text-xs text-white/80">Admin, Super Admin</p>
                            <p class="mt-1 font-semibold">Admin / Super Admin</p>
                        </button>
                    </form>
                </div>

                <div class="mt-6 grid gap-3">
                    <form action="/application" method="get">
                        @csrf
                        <button
                            class="text-sm text-emerald-400 hover:text-emerald-300 underline justify-self-start">New
                            here? Start your application
                        </button>
                    </form>

                    <button class="w-full bg-emerald-600 hover:bg-emerald-500 text-white p-2 rounded-lg text-sm"
                        onclick="selectGroup('applicantLogin')">Applicant Login</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
