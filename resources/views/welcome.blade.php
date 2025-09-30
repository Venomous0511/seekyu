@extends('layouts.welcome')

@section('content')
    <!-- =============== Hero =============== -->
    <section class="relative overflow-hidden">
        <!-- Background image -->
        <div class="absolute inset-0 -z-10">
            <img src="images/about-4.jpg" alt="Security team on duty" class="w-full h-full object-cover">
            <!-- Dark gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-28 text-white text-center relative">
            <span
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/15 text-xs uppercase tracking-wider">
                Duly licensed · Nationwide deployment
            </span>
            <h1 class="mt-6 text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight">
                Reliable Security Services for Homes, Businesses & Events
            </h1>
            <p class="mt-4 text-lg sm:text-xl text-white/85 max-w-3xl mx-auto">
                Trusted personnel, modern systems. In partnership with <span class="font-semibold">Seekyu</span> for
                streamlined recruitment and HRIS.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="#contact"
                    class="lift inline-flex justify-center items-center px-6 py-3 rounded-md bg-brand-accent text-black font-semibold hover:bg-yellow-300">
                    Request Service
                </a>
                <form action="/application" method="get">
                    @csrf
                    <button
                        class="lift inline-flex justify-center items-center px-6 py-3 rounded-md bg-white/10 text-white ring-1 ring-white/20 hover:bg-white/15">
                        Apply as Guard/Staff
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- =============== Services =============== -->
    <section id="services" class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-center">Our Services</h2>
            <p class="mt-2 text-center text-slate-600 max-w-3xl mx-auto">Tailored protection plans backed by trained
                personnel and 24/7 support.</p>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- card -->
                <div class="lift p-6 rounded-2xl border border-slate-200 bg-white">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6l7 4-7 4-7-4 7-4zm0 8l7 4-7 4-7-4 7-4z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Corporate & Office Security</h3>
                    <p class="mt-1 text-sm text-slate-600">Access control, CCTV coordination, visitor management, and
                        post orders.</p>
                </div>
                <div class="lift p-6 rounded-2xl border border-slate-200 bg-white">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Residential Security</h3>
                    <p class="mt-1 text-sm text-slate-600">Village roving, gate screening, and emergency response
                        coordination.</p>
                </div>
                <div class="lift p-6 rounded-2xl border border-slate-200 bg-white">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h8m-9 4h10M5 8h14M3 20h18a2 2 0 002-2V6a2 2 0 00-2-2H3a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Event Security</h3>
                    <p class="mt-1 text-sm text-slate-600">Crowd control, VIP lanes, ingress/egress planning, and bag
                        checks.</p>
                </div>
                <div class="lift p-6 rounded-2xl border border-slate-200 bg-white">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2 21a10 10 0 0120 0" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">VIP Protection</h3>
                    <p class="mt-1 text-sm text-slate-600">Close-in security teams and route planning with discreet
                        coordination.</p>
                </div>
                <div class="lift p-6 rounded-2xl border border-slate-200 bg-white">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C8.67 6.165 8 7.388 8 8.75V14.2c0 .53-.211 1.039-.586 1.414L6 17h5" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">24/7 Monitoring</h3>
                    <p class="mt-1 text-sm text-slate-600">Rapid escalation with centralized comms and incident
                        reporting.</p>
                </div>
                <div class="lift p-6 rounded-2xl border border-slate-200 bg-white">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v-6a2 2 0 012-2h7m-7 0l2-2m-2 2l2 2" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Risk Assessment</h3>
                    <p class="mt-1 text-sm text-slate-600">Site audits, gap analysis, and custom security plans per
                        client.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== Why Choose Us =============== -->
    <section id="why" class="py-16 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-center">Why Choose MJL</h2>
            <p class="mt-2 text-center text-slate-600 max-w-3xl mx-auto">Professional teams, transparent KPIs, and
                modern HRIS via Seekyu.</p>
            <div class="mt-10 grid gap-6 md:grid-cols-4">
                <div class="lift p-6 rounded-2xl bg-white border border-slate-200 text-center">
                    <span
                        class="text-sm font-medium inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200">Licensed
                        & Accredited</span>
                    <p class="mt-3 text-sm text-slate-600">Duly licensed under Philippine laws with vetted personnel.
                    </p>
                </div>
                <div class="lift p-6 rounded-2xl bg-white border border-slate-200 text-center">
                    <span
                        class="text-sm font-medium inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200">Trained
                        Personnel</span>
                    <p class="mt-3 text-sm text-slate-600">Regular drills, post orders, and client-specific SOPs.</p>
                </div>
                <div class="lift p-6 rounded-2xl bg-white border border-slate-200 text-center">
                    <span
                        class="text-sm font-medium inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 text-amber-800 ring-1 ring-amber-200">24/7
                        Support</span>
                    <p class="mt-3 text-sm text-slate-600">Always-on monitoring and escalation pathways.</p>
                </div>
                <div class="lift p-6 rounded-2xl bg-white border border-slate-200 text-center">
                    <span
                        class="text-sm font-medium inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-50 text-sky-800 ring-1 ring-sky-200">Custom
                        Plans</span>
                    <p class="mt-3 text-sm text-slate-600">Tailored deployments and data-backed recommendations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== About =============== -->
    <section id="about" class="py-16 sm:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-10 items-start">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold">About Us</h2>
                <div class="mt-4 space-y-4 text-justify leading-relaxed">
                    <p>MJL Security Agency Inc. was founded by seasoned security professionals to deliver professional
                        and high-quality protection services across the Philippines. We partner with law enforcement and
                        leverage technology to keep communities safe.</p>
                    <p>Our operations are run by competent managers and trained guards with strong credentials.
                        Recruitment follows strict standards to ensure only dedicated, knowledgeable, and well-trained
                        personnel represent the agency.</p>
                    <p>In partnership with <span class="font-semibold">Seekyu</span>, we modernize recruitment and
                        HRIS—digitizing applications, deploying gamified assessment, and tracking KPIs for fair,
                        transparent evaluation.</p>
                </div>
            </div>

            <!-- ABOUT GALLERY -->
            <div class="relative group" id="aboutGallery">
                <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-soft ring-1 ring-slate-200 relative">
                    <!-- Slides -->
                    <div class="absolute inset-0 transition-opacity duration-500" data-slide="0" aria-hidden="false">
                        <img src="images/about-1.jpg" alt="MJL guards briefing before deployment"
                            class="w-full h-full object-cover" loading="eager" />
                    </div>
                    <div class="absolute inset-0 opacity-0 pointer-events-none transition-opacity duration-500"
                        data-slide="1" aria-hidden="true">
                        <img src="images/about-2.jpg" alt="Checkpoint post with CCTV coordination"
                            class="w-full h-full object-cover" loading="lazy" />
                    </div>
                    <div class="absolute inset-0 opacity-0 pointer-events-none transition-opacity duration-500"
                        data-slide="2" aria-hidden="true">
                        <img src="images/about-3.jpg" alt="Event security team on site"
                            class="w-full h-full object-cover" loading="lazy" />
                    </div>

                    <!-- Prev/Next controls -->
                    <button type="button"
                        class="absolute left-3 top-1/2 -translate-y-1/2 px-3 py-2 rounded-full bg-white/80 backdrop-blur ring-1 ring-slate-200 hover:bg-white hidden sm:inline-flex group-hover:inline-flex"
                        aria-label="Previous image" data-prev>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button"
                        class="absolute right-3 top-1/2 -translate-y-1/2 px-3 py-2 rounded-full bg-white/80 backdrop-blur ring-1 ring-slate-200 hover:bg-white hidden sm:inline-flex group-hover:inline-flex"
                        aria-label="Next image" data-next>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-3 left-0 right-0 flex items-center justify-center gap-2">
                        <button class="w-2.5 h-2.5 rounded-full bg-white/90 ring-1 ring-slate-300"
                            aria-label="Go to slide 1" data-dot="0"></button>
                        <button class="w-2.5 h-2.5 rounded-full bg-white/50 hover:bg-white/80 ring-1 ring-slate-300"
                            aria-label="Go to slide 2" data-dot="1"></button>
                        <button class="w-2.5 h-2.5 rounded-full bg-white/50 hover:bg-white/80 ring-1 ring-slate-300"
                            aria-label="Go to slide 3" data-dot="2"></button>
                    </div>
                </div>

                <!-- Small stats card -->
                <div
                    class="hidden sm:flex absolute -bottom-6 -right-6 bg-white rounded-xl border border-slate-200 p-4 shadow-soft w-64">
                    <div>
                        <p class="text-sm font-semibold">76+ Guards Deployed</p>
                        <p class="text-xs text-slate-600">Serving companies nationwide with pride and integrity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== Contact =============== -->
    <section id="contact" class="py-16 sm:py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 items-start">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold">Contact Us</h2>
                    <p class="mt-2 text-slate-600">Tell us what you need and we’ll craft a security plan for you.</p>
                    <ul class="mt-6 space-y-3 text-sm">
                        <!-- Email -->
                        <li class="flex items-center gap-3">
                            <span class="inline-flex w-8 h-8 items-center justify-center rounded-full bg-brand-light">
                                <!-- Mail icon -->
                                <svg class="w-5 h-5 text-brand-primary" fill="none" stroke="currentColor"
                                    stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            contact@mjlsecurity.ph
                        </li>

                        <!-- Mobile -->
                        <li class="flex items-center gap-3">
                            <span class="inline-flex w-8 h-8 items-center justify-center rounded-full bg-brand-light">
                                <!-- Mobile phone icon -->
                                <svg class="w-5 h-5 text-brand-primary" fill="none" stroke="currentColor"
                                    stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 4h10a1 1 0 011 1v14a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1zM12 18h.01" />
                                </svg>
                            </span>
                            09059793642
                        </li>

                        <!-- Address -->
                        <li class="flex items-center gap-3">
                            <span class="inline-flex w-8 h-8 items-center justify-center rounded-full bg-brand-light">
                                <!-- Map pin icon -->
                                <svg class="w-5 h-5 text-brand-primary" fill="none" stroke="currentColor"
                                    stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 22s8-4.5 8-11c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 6.5 8 11 8 11z" />
                                </svg>
                            </span>
                            San Jose del Monte, Bulacan
                        </li>

                </div>
                <form class="lift bg-white p-6 rounded-2xl border border-slate-200 shadow-soft space-y-4"
                    onsubmit="event.preventDefault(); alert('Thanks! We\'ll get back to you shortly.'); this.reset();">
                    <div>
                        <label class="text-sm font-medium" for="name">Your Name</label>
                        <input id="name" name="name" type="text" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Juan Dela Cruz" />
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium" for="email">Email</label>
                            <input id="email" name="email" type="email" required
                                class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                placeholder="you@example.com" />
                        </div>
                        <div>
                            <label class="text-sm font-medium" for="phone">Phone</label>
                            <input id="phone" name="phone" type="tel" required
                                class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                placeholder="09xx xxx xxxx" />
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Tell us about your security needs..."></textarea>
                    </div>
                    <button type="submit"
                        class="w-full px-5 py-3 rounded-lg bg-brand-primary text-white font-semibold hover:bg-slate-900">Send
                        Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @vite('resources/js/welcome.js')
@endpush
