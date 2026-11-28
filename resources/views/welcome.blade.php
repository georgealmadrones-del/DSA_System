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
                        nordic: '#2C6B8E',
                        pine: '#718082',
                        sage: '#A3B2B1',
                        glacier: '#ADC6D6',
                        frost: '#E8ECF1',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-frost text-pine font-sans antialiased selection:bg-glacier/40 overflow-x-hidden">
    <!-- Top Bar (Snow confined above the bottom divider line) -->
    <header class="relative overflow-hidden w-full bg-[#DCE5EE]/95 backdrop-blur-md border-b border-glacier h-20 flex items-center justify-between px-6 md:px-10 sticky top-0 z-50 shadow-sm">
        <canvas id="headerSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="relative z-10 flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-nordic flex items-center justify-center text-white shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </div>
            </div>
            <span class="font-extrabold text-base tracking-tight text-nordic">EduCore SaaS</span>
        </div>

        <nav class="relative z-10 hidden md:flex items-center space-x-8 text-xs font-semibold text-pine">
            <a href="#features" class="hover:text-nordic transition">Features</a>
            <a href="#pricing" class="hover:text-nordic transition">Pricing</a>
            <a href="#faq" class="hover:text-nordic transition">FAQ</a>
        </nav>

        <div class="relative z-10 flex items-center space-x-3 md:space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-nordic hover:bg-white/80 rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-nordic text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#235673] transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-5xl mx-auto px-6 pt-20 pb-12 text-center space-y-8">
        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 bg-white/90 border border-glacier rounded-full shadow-sm text-xs font-semibold text-nordic">
            <span class="w-2 h-2 rounded-full bg-nordic"></span>
            <span>Winter Term &bull; Student management, thoughtfully simplified</span>
        </div>

        <div class="space-y-3">
            <h1 class="text-4xl md:text-6xl font-extrabold text-nordic tracking-tight leading-tight">
                <span class="relative inline-block">
                    <!-- Blue Elf Christmas Hat -->
                    <svg class="w-9 h-9 md:w-11 md:h-11 text-nordic absolute -top-6 -left-5 -rotate-12 pointer-events-none drop-shadow-sm" viewBox="0 0 48 48" fill="none">
                        <path d="M9 31C11 17 20 8 34 7C29 13 28 21 31 31H9Z" fill="#2C6B8E"/>
                        <path d="M34 7C39 8 42 12 43 16" stroke="#2C6B8E" stroke-width="3.5" stroke-linecap="round"/>
                        <circle cx="43.5" cy="16.5" r="3.5" fill="#FFFFFF" stroke="#ADC6D6" stroke-width="1.5"/>
                        <rect x="7" y="30" width="26" height="6.5" rx="3.25" fill="#FFFFFF" stroke="#ADC6D6" stroke-width="1.5"/>
                    </svg>
                    Simplify student records.
                </span>
                <br>
                <span class="text-pine">Elevate every outcome.</span>
            </h1>

            <p class="text-xs md:text-sm font-bold text-nordic tracking-widest uppercase pt-1 bg-glacier/35 border border-glacier inline-block px-3.5 py-1 rounded-full">
                CREATED BY GROUP 1
            </p>
        </div>

        <p class="text-sm md:text-base text-pine max-w-2xl mx-auto leading-relaxed">
            One workspace to organize student records, track academic performance, and keep department data clean.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-nordic text-white text-xs font-bold rounded-2xl shadow-md hover:bg-[#235673] transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-white/90 text-nordic border border-glacier text-xs font-bold rounded-2xl shadow-sm hover:bg-white transition">
                Explore live demo
            </a>
        </div>
    </section>

    <!-- Interactive Live Database Mockup Showcase -->
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-b from-white to-[#F4F7FA] border border-glacier p-6 md:p-8 rounded-3xl shadow-lg relative overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-glacier/70">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-glacier"></div>
                    <div class="w-3 h-3 rounded-full bg-sage"></div>
                    <div class="w-3 h-3 rounded-full bg-nordic"></div>
                    <span class="text-xs font-mono text-pine ml-2">educore.app/workspace/dashboard (Live DB Connected)</span>
                </div>
                <div class="flex items-center space-x-2 bg-frost p-1 rounded-xl border border-glacier/60">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-nordic shadow-sm transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-pine hover:text-nordic transition">Directory Table</button>
                </div>
            </div>

            <!-- Tab 1: Live Database Analytics -->
            <div id="content-dashboard" class="pt-6 space-y-6 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-glacier/70 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-pine">Total Enrolled (Live DB)</p>
                        <p class="text-3xl font-extrabold text-nordic mt-1">{{ $totalStudents }}</p>
                        <span class="text-[10px] text-nordic bg-frost px-2 py-0.5 rounded font-bold mt-2 inline-block">Synced Database</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-glacier/70 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-pine">Average Cohort GPA</p>
                        <p class="text-3xl font-extrabold text-nordic mt-1">{{ number_format((float) $averageGpa, 2) }}</p>
                        <span class="text-[10px] text-nordic bg-frost px-2 py-0.5 rounded font-bold mt-2 inline-block">Calculated Mean</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-glacier/70 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-pine">Active Departments</p>
                        <p class="text-3xl font-extrabold text-nordic mt-1">{{ $activeCoursesCount }}</p>
                        <span class="text-[10px] text-pine bg-frost px-2 py-0.5 rounded font-bold mt-2 inline-block">Unique Courses</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-glacier/70 shadow-sm flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold text-nordic">Workspace Telemetry Active</p>
                        <p class="text-[11px] text-pine">Displaying live summary figures from your EduCore workspace database.</p>
                    </div>
                    <span class="px-3 py-1 bg-frost border border-glacier text-nordic text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                </div>
            </div>

            <!-- Tab 2: Live Database Directory Table -->
            <div id="content-directory" class="pt-6 hidden space-y-4 transition-all duration-300">
                <div class="bg-white rounded-2xl border border-glacier/70 shadow-sm overflow-hidden">
                    <div class="p-4 bg-frost border-b border-glacier/60 flex justify-between items-center text-xs font-bold text-nordic uppercase">
                        <span>Student ID &amp; Name</span>
                        <span>Course</span>
                        <span>GPA</span>
                        <span>Status</span>
                    </div>
                    <div class="divide-y divide-glacier/30 text-xs">
                        @forelse ($students as $student)
                            <div class="p-4 flex justify-between items-center hover:bg-frost/50">
                                <span class="font-bold text-nordic">{{ $student->student_id }} {{ $student->name }}</span>
                                <span class="text-pine font-medium">{{ $student->course ?? 'BSIT' }}</span>
                                <span class="font-extrabold text-nordic">{{ number_format((float) $student->gpa, 2) }}</span>
                                <span class="px-2.5 py-0.5 bg-frost border border-glacier text-nordic rounded-full font-bold">Active</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-pine">No records found in database.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-glacier/70">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-nordic">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-nordic">Less admin. More clarity.</h2>
            <p class="text-xs text-pine max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/90 p-6 rounded-3xl border border-glacier shadow-sm hover:shadow-md transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-frost border border-glacier text-nordic flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-nordic">Instant CRUD Management</h3>
                <p class="text-xs text-pine leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-white/90 p-6 rounded-3xl border border-glacier shadow-sm hover:shadow-md transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-frost border border-glacier text-nordic flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-nordic">Interactive Grading Statistics</h3>
                <p class="text-xs text-pine leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-white/90 p-6 rounded-3xl border border-glacier shadow-sm hover:shadow-md transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-frost border border-glacier text-nordic flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-nordic">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-pine leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-nordic">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-nordic">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-white border border-glacier p-1.5 rounded-2xl mt-4">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-bold bg-nordic text-white shadow-sm transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-pine hover:text-nordic transition">
                    Annual Billing
                    <span class="text-[10px] text-nordic font-bold bg-frost px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-white/95 p-8 rounded-3xl border border-glacier shadow-sm space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-nordic uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-nordic price-starter">&#8369;0</span>
                        <span class="text-xs text-pine billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-pine">Good for individual departments and small student rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-frost hover:bg-glacier/40 text-nordic border border-glacier rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-white p-8 rounded-3xl border-2 border-nordic shadow-md space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-nordic text-white text-[9px] font-bold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-nordic uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-nordic price-pro">&#8369;500</span>
                        <span class="text-xs text-pine billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-pine">For multi-course academic teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-nordic hover:bg-[#235673] text-white rounded-xl text-xs font-bold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-nordic">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-nordic">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-white/95 rounded-2xl border border-glacier shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-nordic hover:bg-frost/50 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-pine leading-relaxed border-t border-glacier/50">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-white/95 rounded-2xl border border-glacier shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-nordic hover:bg-frost/50 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-bold transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-pine leading-relaxed border-t border-glacier/50">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="bg-nordic text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-lg border border-[#235673]">
            <div class="space-y-2 text-center md:text-left">
                <p class="text-[10px] font-bold uppercase tracking-widest text-glacier">Winter Term Ready</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-frost/90 max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-nordic text-xs font-bold rounded-2xl shadow-sm hover:bg-frost transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto px-6 py-8 border-t border-glacier flex flex-col md:flex-row items-center justify-between text-xs text-pine gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-nordic flex items-center justify-center text-white text-[9px] font-bold">EA</div>
            <span class="font-bold text-nordic">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1.</p>
        <div class="flex items-center space-x-6">
            <a href="#" class="hover:text-nordic transition">Privacy</a>
            <a href="#" class="hover:text-nordic transition">Terms</a>
            <a href="#" class="hover:text-nordic transition">Contact</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-nordic shadow-sm transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-pine hover:text-nordic transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-nordic shadow-sm transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-pine hover:text-nordic transition';
            }
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold bg-nordic text-white shadow-sm transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-pine hover:text-nordic transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold bg-nordic text-white shadow-sm transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-pine hover:text-nordic transition';
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

        // Snow strictly inside the top header bar
        (function initHeaderSnow() {
            const canvas = document.getElementById('headerSnow');
            const header = canvas ? canvas.parentElement : null;
            if (!canvas || !header) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const flakes = Array.from({ length: 28 }, () => ({
                x: Math.random() * 1400,
                y: Math.random() * 80,
                r: 1.2 + Math.random() * 2.2,
                vy: 0.35 + Math.random() * 0.65,
                vx: -0.25 + Math.random() * 0.5,
                alpha: 0.45 + Math.random() * 0.5,
            }));

            function resize() {
                width = canvas.width = header.clientWidth;
                height = canvas.height = header.clientHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const f of flakes) {
                    f.x += f.vx;
                    f.y += f.vy;
                    if (f.y > height) {
                        f.y = -4;
                        f.x = Math.random() * width;
                    }
                    if (f.x < 0) f.x = width;
                    if (f.x > width) f.x = 0;

                    ctx.beginPath();
                    ctx.arc(f.x, f.y, f.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255, 255, 255, ${f.alpha})`;
                    ctx.fill();
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>