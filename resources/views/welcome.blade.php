<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore Student Records SaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        alpine: '#1D3547',
                        slateice: '#5C7688',
                        birch: '#8FA4B2',
                        iceborder: '#C4D5E0',
                        snowmist: '#EBF1F5',
                        holly: '#2D5A4C',
                        tinsel: '#C9A96E',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-snowmist text-slateice font-sans antialiased selection:bg-iceborder/60 overflow-x-hidden">
    <!-- Full-Page Snowflake Layer (Skips Log in & Get started action zone) -->
    <canvas id="pageSnowflakes" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Subtle Snowdrift Base along Viewport Bottom -->
    <div class="pointer-events-none fixed inset-x-0 bottom-0 h-14 z-20 overflow-hidden">
        <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
            <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#FFFFFF" fill-opacity="0.72"/>
            <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#FFFFFF" fill-opacity="0.92"/>
        </svg>
    </div>

    <!-- Top Bar -->
    <header class="relative w-full bg-[#E1EAF0]/90 backdrop-blur-md border-b border-iceborder h-20 flex items-center justify-between px-6 md:px-10 sticky top-0 z-40 shadow-sm">
        <!-- Subtle Festive Garland & Mini Ornaments along Header Bottom Edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 z-30 overflow-visible" viewBox="0 0 1440 24" preserveAspectRatio="none" fill="none">
            <path d="M0 2Q180 16 360 2T720 2T1080 2T1440 2" stroke="#8FA4B2" stroke-width="1.2" stroke-dasharray="3 3"/>
            <!-- Mini frosted ornaments -->
            <circle cx="180" cy="11" r="3.2" fill="#2D5A4C" stroke="#FFFFFF" stroke-width="1"/>
            <circle cx="360" cy="11" r="3.2" fill="#C9A96E" stroke="#FFFFFF" stroke-width="1"/>
            <circle cx="540" cy="11" r="3.2" fill="#1D3547" stroke="#FFFFFF" stroke-width="1"/>
            <circle cx="720" cy="11" r="3.2" fill="#C9A96E" stroke="#FFFFFF" stroke-width="1"/>
            <circle cx="900" cy="11" r="3.2" fill="#2D5A4C" stroke="#FFFFFF" stroke-width="1"/>
        </svg>

        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-alpine flex items-center justify-center text-white shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </div>
            </div>
            <span class="font-extrabold text-base tracking-tight text-alpine">EduCore SaaS</span>
        </div>

        <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-slateice">
            <a href="#features" class="hover:text-alpine transition">Features</a>
            <a href="#pricing" class="hover:text-alpine transition">Pricing</a>
            <a href="#faq" class="hover:text-alpine transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean without snowflakes -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-3 md:space-x-4 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-alpine hover:bg-white/90 rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-alpine text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#152734] transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-12 text-center space-y-8">
        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 bg-white/85 border border-iceborder rounded-full shadow-sm text-xs font-semibold text-alpine">
            <span class="text-tinsel text-sm leading-none">&#10022;</span>
            <span>Winter Term &bull; Student management, thoughtfully simplified</span>
            <span class="w-1.5 h-1.5 rounded-full bg-holly"></span>
        </div>

        <div class="space-y-3">
            <h1 class="text-4xl md:text-6xl font-extrabold text-alpine tracking-tight leading-tight">
                <span class="relative inline-block">
                    <!-- Winter Holiday Hat -->
                    <svg class="w-10 h-10 md:w-12 md:h-12 text-alpine absolute -top-7 -left-6 -rotate-12 pointer-events-none drop-shadow-sm" viewBox="0 0 48 48" fill="none">
                        <path d="M9 32C11 17 20 7 35 6C29 13 28 21 31 32H9Z" fill="#1D3547"/>
                        <path d="M25 14.5C28 15 30 16.5 31 18.5" stroke="#C9A96E" stroke-width="2" stroke-linecap="round"/>
                        <path d="M35 6C40 7 43 11 44 15.5" stroke="#1D3547" stroke-width="3.5" stroke-linecap="round"/>
                        <circle cx="44.5" cy="16" r="3.8" fill="#FFFFFF" stroke="#C4D5E0" stroke-width="1.5"/>
                        <rect x="6.5" y="31" width="27" height="7" rx="3.5" fill="#FFFFFF" stroke="#C4D5E0" stroke-width="1.5"/>
                    </svg>
                    Simplify student records.
                </span>
                <br>
                <span class="text-slateice">Elevate every outcome.</span>
            </h1>

            <p class="text-xs md:text-sm font-bold text-alpine tracking-widest uppercase pt-1 bg-white/80 border border-iceborder inline-block px-3.5 py-1 rounded-full">
                CREATED BY GROUP 1
            </p>
        </div>

        <p class="text-sm md:text-base text-slateice max-w-2xl mx-auto leading-relaxed">
            One workspace to organize student records, track academic performance, and keep department data clean.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-alpine text-white text-xs font-bold rounded-2xl shadow-md hover:bg-[#152734] transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-white/85 text-alpine border border-iceborder text-xs font-bold rounded-2xl shadow-sm hover:bg-white transition">
                Explore live demo
            </a>
        </div>
    </section>

    <!-- Interactive Live Database Mockup Showcase -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-b from-white/95 to-[#F3F7FA]/95 border border-iceborder p-6 md:p-8 rounded-3xl shadow-lg relative overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-iceborder/80">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-iceborder"></div>
                    <div class="w-3 h-3 rounded-full bg-holly/70"></div>
                    <div class="w-3 h-3 rounded-full bg-tinsel"></div>
                    <span class="text-xs font-mono text-slateice ml-2">educore.app/workspace/dashboard (Live DB Connected)</span>
                </div>
                <div class="flex items-center space-x-2 bg-snowmist p-1 rounded-xl border border-iceborder/70">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-alpine shadow-sm transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-slateice hover:text-alpine transition">Directory Table</button>
                </div>
            </div>

            <!-- Tab 1: Live Database Analytics -->
            <div id="content-dashboard" class="pt-6 space-y-6 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-iceborder/80 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slateice">Total Enrolled (Live DB)</p>
                        <p class="text-3xl font-extrabold text-alpine mt-1">{{ $totalStudents }}</p>
                        <span class="text-[10px] text-alpine bg-snowmist px-2 py-0.5 rounded font-bold mt-2 inline-block">Synced Database</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-iceborder/80 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slateice">Average Cohort GPA</p>
                        <p class="text-3xl font-extrabold text-alpine mt-1">{{ number_format((float) $averageGpa, 2) }}</p>
                        <span class="text-[10px] text-alpine bg-snowmist px-2 py-0.5 rounded font-bold mt-2 inline-block">Calculated Mean</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-iceborder/80 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slateice">Active Departments</p>
                        <p class="text-3xl font-extrabold text-alpine mt-1">{{ $activeCoursesCount }}</p>
                        <span class="text-[10px] text-slateice bg-snowmist px-2 py-0.5 rounded font-bold mt-2 inline-block">Unique Courses</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-iceborder/80 shadow-sm flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold text-alpine">Workspace Telemetry Active</p>
                        <p class="text-[11px] text-slateice">Displaying live summary figures from your EduCore workspace database.</p>
                    </div>
                    <span class="px-3 py-1 bg-snowmist border border-iceborder text-alpine text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                </div>
            </div>

            <!-- Tab 2: Live Database Directory Table -->
            <div id="content-directory" class="pt-6 hidden space-y-4 transition-all duration-300">
                <div class="bg-white rounded-2xl border border-iceborder/80 shadow-sm overflow-hidden">
                    <div class="p-4 bg-snowmist border-b border-iceborder/70 flex justify-between items-center text-xs font-bold text-alpine uppercase">
                        <span>Student ID &amp; Name</span>
                        <span>Course</span>
                        <span>GPA</span>
                        <span>Status</span>
                    </div>
                    <div class="divide-y divide-iceborder/40 text-xs">
                        @forelse ($students as $student)
                            <div class="p-4 flex justify-between items-center hover:bg-snowmist/50">
                                <span class="font-bold text-alpine">{{ $student->student_id }} {{ $student->name }}</span>
                                <span class="text-slateice font-medium">{{ $student->course ?? 'BSIT' }}</span>
                                <span class="font-extrabold text-alpine">{{ number_format((float) $student->gpa, 2) }}</span>
                                <span class="px-2.5 py-0.5 bg-snowmist border border-iceborder text-alpine rounded-full font-bold">Active</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slateice">No records found in database.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-iceborder/80">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-alpine">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-alpine">Less admin. More clarity.</h2>
            <p class="text-xs text-slateice max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/90 p-6 rounded-3xl border border-iceborder shadow-sm hover:shadow-md transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-snowmist border border-iceborder text-alpine flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-alpine">Instant CRUD Management</h3>
                <p class="text-xs text-slateice leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-white/90 p-6 rounded-3xl border border-iceborder shadow-sm hover:shadow-md transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-snowmist border border-iceborder text-alpine flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-alpine">Interactive Grading Statistics</h3>
                <p class="text-xs text-slateice leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-white/90 p-6 rounded-3xl border border-iceborder shadow-sm hover:shadow-md transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-snowmist border border-iceborder text-alpine flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-alpine">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-slateice leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-alpine">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-alpine">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-white/90 border border-iceborder p-1.5 rounded-2xl mt-4">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-bold bg-alpine text-white shadow-sm transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-slateice hover:text-alpine transition">
                    Annual Billing
                    <span class="text-[10px] text-alpine font-bold bg-snowmist px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-white/95 p-8 rounded-3xl border border-iceborder shadow-sm space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-alpine uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-alpine price-starter">&#8369;0</span>
                        <span class="text-xs text-slateice billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-slateice">Good for individual departments and small student rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-snowmist hover:bg-iceborder/50 text-alpine border border-iceborder rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-white p-8 rounded-3xl border-2 border-alpine shadow-md space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-alpine text-white text-[9px] font-bold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-alpine uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-alpine price-pro">&#8369;500</span>
                        <span class="text-xs text-slateice billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-slateice">For multi-course academic teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-alpine hover:bg-[#152734] text-white rounded-xl text-xs font-bold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-alpine">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-alpine">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-white/95 rounded-2xl border border-iceborder shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-alpine hover:bg-snowmist/50 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-slateice leading-relaxed border-t border-iceborder/60">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-white/95 rounded-2xl border border-iceborder shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-alpine hover:bg-snowmist/50 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-bold transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-slateice leading-relaxed border-t border-iceborder/60">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-alpine text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-lg border border-[#152734]">
            <div class="space-y-2 text-center md:text-left">
                <p class="text-[10px] font-bold uppercase tracking-widest text-tinsel">Winter Term Ready</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-snowmist/90 max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-alpine text-xs font-bold rounded-2xl shadow-sm hover:bg-snowmist transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-iceborder flex flex-col md:flex-row items-center justify-between text-xs text-slateice gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-alpine flex items-center justify-center text-white text-[9px] font-bold">EA</div>
            <span class="font-bold text-alpine">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1.</p>
        <div class="flex items-center space-x-6">
            <a href="#" class="hover:text-alpine transition">Privacy</a>
            <a href="#" class="hover:text-alpine transition">Terms</a>
            <a href="#" class="hover:text-alpine transition">Contact</a>
        </div>
    </footer>

    <script>
        function switchTab(tab) {
            const dashContent = document.getElementById('content-dashboard');
            const dirContent = document.getElementById('content-directory');
            const dashBtn = document.getElementById('tab-dashboard');
            const dirBtn = document.getElementById('tab-directory');

            if (tab === 'dashboard') {
                dashContent.classList.remove('hidden');
                dirContent.classList.add('hidden');
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-alpine shadow-sm transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-slateice hover:text-alpine transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-alpine shadow-sm transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-slateice hover:text-alpine transition';
            }
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold bg-alpine text-white shadow-sm transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-slateice hover:text-alpine transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold bg-alpine text-white shadow-sm transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-slateice hover:text-alpine transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1500';
                cycles.forEach(el => el.innerText = '/ month');
            }
        }

        function toggleFaq(id) {
            const content = document.getElementById(`faq-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            if (!content || !icon) return;
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.innerText = '−';
            } else {
                content.classList.add('hidden');
                icon.innerText = '+';
            }
        }

        // Full-page crystalline snowflakes that skip #authActionZone (Log in & Get started)
        (function initPageSnowflakes() {
            const canvas = document.getElementById('pageSnowflakes');
            const excludedEl = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;

            const flakes = Array.from({ length: 48 }, () => ({
                x: Math.random() * 1600,
                y: Math.random() * 1000,
                size: 5 + Math.random() * 6.5,
                vy: 0.45 + Math.random() * 0.75,
                vx: -0.35 + Math.random() * 0.7,
                angle: Math.random() * Math.PI * 2,
                spin: (-0.012 + Math.random() * 0.024),
                alpha: 0.55 + Math.random() * 0.35,
            }));

            function resize() {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function isInsideExcludedZone(x, y, pad = 12) {
                if (!excludedEl) return false;
                const rect = excludedEl.getBoundingClientRect();
                return (
                    x >= rect.left - pad &&
                    x <= rect.right + pad &&
                    y >= rect.top - pad &&
                    y <= rect.bottom + pad
                );
            }

            function drawSnowflake(f) {
                ctx.save();
                ctx.translate(f.x, f.y);
                ctx.rotate(f.angle);
                ctx.strokeStyle = `rgba(116, 154, 179, ${f.alpha})`;
                ctx.fillStyle = `rgba(255, 255, 255, ${f.alpha})`;
                ctx.lineWidth = Math.max(1, f.size * 0.14);
                ctx.lineCap = 'round';

                const r = f.size;
                const branch = r * 0.36;

                for (let i = 0; i < 6; i++) {
                    ctx.save();
                    ctx.rotate((i * Math.PI) / 3);

                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.lineTo(0, -r);
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.moveTo(0, -r * 0.58);
                    ctx.lineTo(-branch * 0.75, -r * 0.82);
                    ctx.moveTo(0, -r * 0.58);
                    ctx.lineTo(branch * 0.75, -r * 0.82);
                    ctx.stroke();

                    ctx.restore();
                }

                ctx.beginPath();
                ctx.arc(0, 0, Math.max(1.2, r * 0.18), 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();
            }

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const f of flakes) {
                    f.x += f.vx;
                    f.y += f.vy;
                    f.angle += f.spin;

                    if (f.y - f.size > height) {
                        f.y = -f.size * 2;
                        f.x = Math.random() * width;
                    }
                    if (f.x + f.size < 0) f.x = width + f.size;
                    if (f.x - f.size > width) f.x = -f.size;

                    if (!isInsideExcludedZone(f.x, f.y, f.size + 10)) {
                        drawSnowflake(f);
                    }
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>