@extends('layouts.welcome')

@section('content')
    <!-- Hero -->
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <span
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-light text-brand-dark text-xs uppercase tracking-wider ring-1 ring-slate-200">
                Seekyu Recruitment
            </span>
            <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-brand-primary">Start Your Application</h1>
            <p class="mt-2 text-slate-600">Create your applicant account, pick your role, fill in details, and upload PDFs.
            </p>
        </div>
    </section>

    <!-- Application Form -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form id="applicationForm" class="space-y-8" novalidate>

            <!-- 1) Create Account -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft" id="accountSection">
                <h2 class="text-lg font-semibold">1) Create Account</h2>
                <p class="text-sm text-slate-600 mt-1">We’ll use this to let you log in and track your application.</p>

                <div class="mt-4 grid sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium" for="accountEmail">Account Email</label>
                        <input id="accountEmail" name="accountEmail" type="email" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="you@example.com" />
                        <label class="mt-2 inline-flex items-center gap-2 text-sm">
                            <input id="syncEmail" type="checkbox" class="rounded">
                            <span>Use this as my Personal Information email too</span>
                        </label>
                    </div>

                    <div>
                        <label class="text-sm font-medium" for="accountPassword">Password</label>
                        <div class="relative">
                            <input id="accountPassword" name="accountPassword" type="password" required minlength="8"
                                class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary pr-10"
                                placeholder="At least 8 characters" />
                            <button type="button" id="togglePass"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-500 text-xs hover:text-slate-700">Show</button>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Include upper & lower case, a number, and a symbol.</p>
                        <div class="mt-2 h-2 w-full rounded bg-slate-200 overflow-hidden">
                            <div id="pwBar" class="h-full w-0 bg-emerald-500 transition-all"></div>
                        </div>
                        <div id="pwLabel" class="text-xs mt-1 text-slate-600">Strength: —</div>
                    </div>

                    <div>
                        <label class="text-sm font-medium" for="accountPassword2">Confirm Password</label>
                        <input id="accountPassword2" name="accountPassword2" type="password" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Re-type password" />
                    </div>
                </div>
            </section>

            <!-- 2) Role Selection -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <h2 class="text-lg font-semibold">2) Choose Application Type</h2>
                <p class="text-sm text-slate-600 mt-1">Pick one. Fields below will adjust automatically.</p>
                <div class="mt-4 grid sm:grid-cols-2 gap-4">
                    <label
                        class="lift p-4 rounded-xl border border-slate-200 cursor-pointer flex items-start gap-3 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500">
                        <input type="radio" name="appType" value="guard" class="mt-1" checked />
                        <div>
                            <div class="font-medium">Security Guard</div>
                            <div class="text-sm text-slate-600">Requires licenses/certifications upload</div>
                        </div>
                    </label>
                    <label
                        class="lift p-4 rounded-xl border border-slate-200 cursor-pointer flex items-start gap-3 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500">
                        <input type="radio" name="appType" value="staff" class="mt-1" />
                        <div>
                            <div class="font-medium">Staff</div>
                            <div class="text-sm text-slate-600">Requires résumé and supporting docs</div>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 3) Personal Info -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <h2 class="text-lg font-semibold">3) Personal Information</h2>
                <div class="mt-4 grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium" for="firstName">First Name</label>
                        <input id="firstName" name="firstName" type="text" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Juan" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="middleName">Middle Name (optional)</label>
                        <input id="middleName" name="middleName" type="text"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Santos" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="lastName">Last Name</label>
                        <input id="lastName" name="lastName" type="text" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Dela Cruz" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="email">Email</label>
                        <input id="email" name="email" type="email" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="you@example.com" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" required pattern="^(09|\+639)\d{9}$"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="09xxxxxxxxx" />
                        <p class="text-xs text-slate-500 mt-1">Format: 09XXXXXXXXX or +639XXXXXXXXX</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium" for="address">Address</label>
                        <input id="address" name="address" type="text" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="Street, Barangay, City, Province" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="birthdate">Birthdate</label>
                        <input id="birthdate" name="birthdate" type="date" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="sex">Sex</label>
                        <select id="sex" name="sex" required
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary">
                            <option value="" disabled selected>Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Prefer not to say</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- 4) Role-Specific -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <h2 class="text-lg font-semibold">4) Role-Specific Details</h2>

                <!-- Guard fields -->
                <div id="guardFields" class="mt-4 grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium" for="licenseNo">Security Guard License No.</label>
                        <input id="licenseNo" name="licenseNo" type="text"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="e.g., 1234-567890" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="licenseExpiry">License Expiry</label>
                        <input id="licenseExpiry" name="licenseExpiry" type="date"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="certs">Certifications</label>
                        <select id="certs" name="certs"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary">
                            <option>SSG NC II</option>
                            <option>Basic Security Training</option>
                            <option>First Aid</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="experienceYears">Years of Experience</label>
                        <input id="experienceYears" name="experienceYears" type="number" min="0"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="0" />
                    </div>
                </div>

                <!-- Staff fields -->
                <div id="staffFields" class="hidden mt-4 grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium" for="desiredRole">Desired Position</label>
                        <input id="desiredRole" name="desiredRole" type="text"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="e.g., HR Assistant" />
                    </div>
                    <div>
                        <label class="text-sm font-medium" for="expectedSalary">Expected Monthly Salary (PHP)</label>
                        <input id="expectedSalary" name="expectedSalary" type="number" min="0"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="e.g., 20000" />
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium" for="portfolio">Portfolio/LinkedIn (optional)</label>
                        <input id="portfolio" name="portfolio" type="url"
                            class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                            placeholder="https://..." />
                    </div>
                </div>
            </section>

            <!-- 5) Work History (repeatable) -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold">5) Work History</h2>
                    <button type="button" id="addWork"
                        class="lift text-sm px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200">+ Add another
                        job</button>
                </div>
                <p class="text-sm text-slate-600 mt-1">Add your most recent job first. Each entry is required.</p>
                <div id="workList" class="mt-4 space-y-4"></div>

                <template id="workTemplate">
                    <div class="work-item p-4 border border-slate-200 rounded-xl">
                        <div class="flex items-center justify-between mb-3">
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-xs">Work
                                Entry</span>
                            <button type="button"
                                class="removeWork text-sm text-rose-600 hover:text-rose-700 hidden">Remove</button>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium">Company Name</label>
                                <input type="text"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="Company Inc." />
                            </div>
                            <div>
                                <label class="text-sm font-medium">Position / Title</label>
                                <input type="text"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="Security Guard / Staff" />
                            </div>
                            <div>
                                <label class="text-sm font-medium">Start (YYYY-MM)</label>
                                <input type="month"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary" />
                            </div>
                            <div>
                                <label class="text-sm font-medium">End (leave blank if current)</label>
                                <input type="month"
                                    class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-medium">Key Responsibilities / Achievements</label>
                                <textarea rows="3"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="Briefly describe your duties..."></textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </section>

            <!-- 6) Education (repeatable) -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold">6) Education</h2>
                    <button type="button" id="addEdu"
                        class="lift text-sm px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200">+ Add another
                        school</button>
                </div>
                <p class="text-sm text-slate-600 mt-1">Add your highest/most recent first. Each entry is required.</p>
                <div id="eduList" class="mt-4 space-y-4"></div>

                <template id="eduTemplate">
                    <div class="edu-item p-4 border border-slate-200 rounded-xl">
                        <div class="flex items-center justify-between mb-3">
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-xs">Education
                                Entry</span>
                            <button type="button"
                                class="removeEdu text-sm text-rose-600 hover:text-rose-700 hidden">Remove</button>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium">Highest Level / Program</label>
                                <input type="text"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="Senior High / Vocational / College / Course" />
                            </div>
                            <div>
                                <label class="text-sm font-medium">School / Training Center</label>
                                <input type="text"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="School name" />
                            </div>
                            <div>
                                <label class="text-sm font-medium">Graduation / Completion Year</label>
                                <input type="number" min="1950" max="2100"
                                    class="req mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="e.g., 2023" />
                            </div>
                            <div class="sm:col-span-1">
                                <label class="text-sm font-medium">Honors/Awards (optional)</label>
                                <input type="text"
                                    class="mt-1 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                                    placeholder="e.g., Dean’s Lister" />
                            </div>
                        </div>
                    </div>
                </template>
            </section>

            <!-- 7) Skills (Required) -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <h2 class="text-lg font-semibold">7) Skills</h2>
                <p class="text-sm text-slate-600 mt-1">List relevant skills (e.g., CCTV monitoring, first aid, MS Office).
                </p>
                <textarea id="skills" name="skills" rows="4" required
                    class="mt-4 w-full rounded-lg border-slate-300 focus:border-brand-primary focus:ring-brand-primary"
                    placeholder="Comma-separated or sentences are fine."></textarea>
            </section>

            <!-- 8) Upload Requirements -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <h2 class="text-lg font-semibold">8) Upload Requirements (PDF only)</h2>
                <p class="text-sm text-slate-600 mt-1">Max 5 MB per file. Only <strong>PDF</strong> is accepted right now.
                </p>

                <div class="mt-4 grid gap-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium" for="resumePdf">Résumé / CV (PDF) <span
                                    class="text-rose-600">*</span></label>
                            <input id="resumePdf" name="resumePdf" type="file" accept="application/pdf" required
                                class="mt-1 block w-full text-sm file:mr-3 file:py-2 file:px-3 file:border-0 file:rounded-lg file:bg-brand-light file:text-brand-dark hover:file:bg-slate-200" />
                            <p class="text-xs text-slate-500 mt-1">Required for Guard & Staff</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium" for="clearancePdf">NBI/Police Clearance (PDF) <span
                                    class="text-rose-600">*</span></label>
                            <input id="clearancePdf" name="clearancePdf" type="file" accept="application/pdf"
                                required
                                class="mt-1 block w-full text-sm file:mr-3 file:py-2 file:px-3 file:border-0 file:rounded-lg file:bg-brand-light file:text-brand-dark hover:file:bg-slate-200" />
                        </div>
                    </div>

                    <!-- Guard-only requirement -->
                    <div id="guardReq" class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium" for="licensePdf">Security Guard License (PDF) <span
                                    class="text-rose-600">*</span></label>
                            <input id="licensePdf" name="licensePdf" type="file" accept="application/pdf"
                                class="mt-1 block w-full text-sm file:mr-3 file:py-2 file:px-3 file:border-0 file:rounded-lg file:bg-brand-light file:text-brand-dark hover:file:bg-slate-200" />
                        </div>
                        <div>
                            <label class="text-sm font-medium" for="trainingPdf">Training Certificates (PDF)</label>
                            <input id="trainingPdf" name="trainingPdf" type="file" accept="application/pdf"
                                class="mt-1 block w-full text-sm file:mr-3 file:py-2 file:px-3 file:border-0 file:rounded-lg file:bg-brand-light file:text-brand-dark hover:file:bg-slate-200" />
                        </div>
                    </div>

                    <!-- Staff-only requirement -->
                    <div id="staffReq" class="hidden grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium" for="torPdf">Transcript of Records (PDF)</label>
                            <input id="torPdf" name="torPdf" type="file" accept="application/pdf"
                                class="mt-1 block w-full text-sm file:mr-3 file:py-2 file:px-3 file:border-0 file:rounded-lg file:bg-brand-light file:text-brand-dark hover:file:bg-slate-200" />
                        </div>
                        <div>
                            <label class="text-sm font-medium" for="otherPdf">Other Supporting Doc (PDF)</label>
                            <input id="otherPdf" name="otherPdf" type="file" accept="application/pdf"
                                class="mt-1 block w-full text-sm file:mr-3 file:py-2 file:px-3 file:border-0 file:rounded-lg file:bg-brand-light file:text-brand-dark hover:file:bg-slate-200" />
                        </div>
                    </div>
                </div>
            </section>

            <!-- 9) Consent -->
            <section class="bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
                <h2 class="text-lg font-semibold">9) Consent</h2>
                <label class="mt-3 flex items-start gap-3">
                    <input id="consent" type="checkbox" class="mt-1" />
                    <span class="text-sm text-slate-700">I confirm the information provided is true and I agree to MJL
                        Security Agency’s processing of my data for recruitment purposes.</span>
                </label>
            </section>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <a href="/" class="text-sm text-slate-600 hover:text-slate-800">← Back</a>
                <button type="submit"
                    class="px-6 py-3 rounded-lg bg-brand-primary text-white font-semibold hover:bg-slate-900">Submit
                    Application</button>
            </div>

            <!-- Inline alerts -->
            <div id="formAlert" class="hidden mt-4 p-4 rounded-lg border text-sm"></div>
        </form>

        <!-- Confirmation Card -->
        <div id="confirmationCard" class="hidden mt-8 bg-white p-6 rounded-2xl border border-slate-200 shadow-soft">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-emerald-700">Application submitted!</h3>
                    <p class="text-slate-600 mt-1">Your account has been created (demo). We’ll email you updates.</p>
                </div>
                <svg class="w-8 h-8 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="mt-4 text-sm text-slate-600" id="confirmationSummary"></div>
            <div class="mt-6 flex gap-3">
                <a class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-brand-accent text-black font-medium hover:bg-yellow-300"
                    href="homepage.html">Go to Home</a>
                <a class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-900 text-white font-medium hover:bg-black"
                    href="homepage.html">Applicant Login</a>
            </div>
        </div>

    </main>
@endsection

@push('scripts')
    @vite('resources/js/welcome.js')
@endpush
