<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore Student Records SaaS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        charcoal: '#4A4A4A',
                        coolgrey: '#CBCBCB',
                        ivory: '#FFFFE3',
                        slateblue: '#6D8196',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased selection:bg-slateblue/20 overflow-x-hidden">

    <!-- Top Navigation Bar -->
    <header class="w-full bg-white/80 backdrop-blur-md border-b border-coolgrey/20 h-20 flex items-center justify-between px-10 sticky top-0 z-50 shadow-sm">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-charcoal flex items-center justify-center text-white shadow-md">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </div>
            </div>
            <span class="font-extrabold text-base tracking-tight text-charcoal">EduCore SaaS</span>
        </div>

        <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-slateblue">
            <a href="#features" class="hover:text-charcoal transition">Features</a>
            <a href="#pricing" class="hover:text-charcoal transition">Pricing</a>
            <a href="#faq" class="hover:text-charcoal transition">FAQ</a>
        </nav>

        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-charcoal hover:bg-gray-100 rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-charcoal text-white text-xs font-bold rounded-xl shadow-md hover:bg-charcoal/90 transition transform hover:-translate-y-0.5">Get started →</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-5xl mx-auto px-6 pt-20 pb-12 text-center space-y-8">
        <!-- Top Pill Badge -->
        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 bg-white border border-coolgrey/30 rounded-full shadow-sm text-xs font-semibold text-charcoal animate-bounce">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span>Student management, thoughtfully simplified</span>
        </div>

        <!-- Main Headline with Group 6 Callout -->
        <div class="space-y-3">
            <h1 class="text-4xl md:text-6xl font-extrabold text-charcoal tracking-tight leading-tight">
                Simplify student records.<br>Elevate every outcome.
            </h1>
            <p class="text-xs md:text-sm font-bold text-slateblue tracking-widest uppercase pt-1 bg-slateblue/10 inline-block px-3 py-1 rounded-full">created by Group 6</p>
        </div>

        <p class="text-sm md:text-base text-slateblue max-w-2xl mx-auto leading-relaxed">
            One intuitive workspace to organize student data, track academic performance, and help your institution make smarter decisions.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-charcoal text-white text-xs font-bold rounded-2xl shadow-xl hover:bg-charcoal/90 transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>→</span>
            </a>
            <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-white text-charcoal border border-coolgrey/30 text-xs font-bold rounded-2xl shadow-sm hover:bg-gray-50 transition">
                Explore live demo
            </a>
        </div>
    </section>

    <!-- Interactive Live Database Mockup Showcase -->
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-b from-[#FFFEEB] to-white rounded-3xl border border-coolgrey/30 p-6 md:p-8 shadow-2xl relative overflow-hidden">
            
            <!-- Interactive Mockup Navigation Tabs -->
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-coolgrey/20">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                    <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                    <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    <span class="text-xs font-mono text-slateblue ml-2">educore.app/workspace/dashboard (Live DB Connected)</span>
                </div>
                <div class="flex items-center space-x-2 bg-gray-100 p-1 rounded-xl">
                    <button onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-charcoal shadow-sm transition">Dashboard View</button>
                    <button onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-slateblue hover:text-charcoal transition">Directory Table</button>
                </div>
            </div>

            <!-- Tab Content 1: Live Database Analytics -->
            <div id="content-dashboard" class="pt-6 space-y-6 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-coolgrey/20 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slateblue">Total Enrolled (Live DB)</p>
                        <p class="text-3xl font-extrabold text-charcoal mt-1">{{ $totalStudents }}</p>
                        <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-bold mt-2 inline-block">Synced from MySQL</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-coolgrey/20 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slateblue">Average Cohort GPA</p>
                        <p class="text-3xl font-extrabold text-charcoal mt-1">{{ number_format($averageGpa, 2) }}</p>
                        <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-bold mt-2 inline-block">Calculated Mean</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-coolgrey/20 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slateblue">Active Departments</p>
                        <p class="text-3xl font-extrabold text-charcoal mt-1">{{ $activeCoursesCount }}</p>
                        <span class="text-[10px] text-slateblue bg-gray-100 px-2 py-0.5 rounded font-bold mt-2 inline-block">Unique Courses</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-coolgrey/20 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-charcoal">Real-Time Audit Telemetry Active</p>
                        <p class="text-[11px] text-slateblue">Displaying live data directly from your EduCore MySQL database.</p>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-xl animate-pulse">Live DB Connected</span>
                </div>
            </div>

            <!-- Tab Content 2: Live Database Directory Table -->
            <div id="content-directory" class="pt-6 hidden space-y-4 transition-all duration-300">
                <div class="bg-white rounded-2xl border border-coolgrey/20 shadow-sm overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b border-coolgrey/20 flex justify-between items-center text-xs font-bold text-slateblue uppercase">
                        <span>Student ID & Name</span>
                        <span>Course</span>
                        <span>GPA</span>
                        <span>Status</span>
                    </div>
                    <div class="divide-y divide-gray-100 text-xs">
                        @forelse($students as $student)
                            <div class="p-4 flex justify-between items-center hover:bg-gray-50">
                                <span class="font-bold text-charcoal">{{ $student->student_id }} - {{ $student->name }}</span>
                                <span class="text-slateblue font-medium">{{ $student->course ?? 'BSIT' }}</span>
                                <span class="font-extrabold">{{ number_format($student->gpa, 2) }}</span>
                                <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 rounded-full font-bold">Active</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slateblue">No records found in database.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Features Section Grid (With Professional Vector SVGs) -->
    <section id="features" class="max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-coolgrey/20">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-charcoal">Less admin. More impact.</h2>
            <p class="text-xs text-slateblue max-w-xl mx-auto">Purpose-built tools that turn complex student record management into a calm, connected experience.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-slateblue/10 text-charcoal flex items-center justify-center">
                    <svg class="w-5 h-5 text-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-charcoal">Instant CRUD Management</h3>
                <p class="text-xs text-slateblue leading-relaxed">Add, update, and manage student records in moments with smart validation that keeps your data clean.</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-slateblue/10 text-charcoal flex items-center justify-center">
                    <svg class="w-5 h-5 text-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-charcoal">Interactive Grading Statistics</h3>
                <p class="text-xs text-slateblue leading-relaxed">Turn grades into clear, visual insights that reveal trends and support better academic outcomes.</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-slateblue/10 text-charcoal flex items-center justify-center">
                    <svg class="w-5 h-5 text-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-charcoal">Advanced Search & Sorting</h3>
                <p class="text-xs text-slateblue leading-relaxed">Find any record fast, combine multiple criteria, and sort your data exactly the way you need it.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section (₱500 / month) -->
    <section id="pricing" class="max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-charcoal">Simple plans for institutions of all sizes</h2>
            
            <div class="inline-flex items-center space-x-3 bg-gray-100 p-1.5 rounded-2xl mt-4">
                <button onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-charcoal shadow-sm transition">Monthly Billing</button>
                <button onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-slateblue hover:text-charcoal transition">Annual Billing <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-full ml-1">Save 20%</span></button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-white p-8 rounded-3xl border border-coolgrey/20 shadow-md space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-charcoal price-starter">₱0</span>
                        <span class="text-xs text-slateblue billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-slateblue">Perfect for individual college departments and small rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-gray-100 hover:bg-gray-200 text-charcoal rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-white p-8 rounded-3xl border-2 border-charcoal shadow-xl space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-charcoal text-white text-[9px] font-bold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-charcoal price-pro">₱500</span>
                        <span class="text-xs text-slateblue billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-slateblue">For entire academies and universities requiring multi-user access.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-charcoal hover:bg-charcoal/90 text-white rounded-xl text-xs font-bold transition text-center block shadow-md">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-charcoal">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-2xl border border-coolgrey/20 shadow-sm overflow-hidden">
                <button onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-charcoal hover:bg-gray-50 transition">
                    <span>How does the workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-0 text-xs text-slateblue leading-relaxed border-t border-gray-100">
                    EduCore securely stores your workspace name and preferences in active server sessions, allowing real-time branding updates across all your dashboard views instantly.
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-coolgrey/20 shadow-sm overflow-hidden">
                <button onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-charcoal hover:bg-gray-50 transition">
                    <span>Can I export student data into reports?</span>
                    <span id="icon-2" class="text-lg font-bold transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-0 text-xs text-slateblue leading-relaxed border-t border-gray-100">
                    Yes! You can export filtered student directories and complete audit log trails directly as formatted CSV files from the settings panel.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Call to Action Banner -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="bg-[#2A2A2A] text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl">
            <div class="space-y-2 text-center md:text-left">
                <p class="text-[10px] font-bold uppercase tracking-widest text-coolgrey">Ready when you are</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-coolgrey/80 max-w-md">Join education teams simplifying their student operations with EduCore.</p>
            </div>
            <a href="{{ route('register') }}" class="px-8 py-4 bg-ivory text-charcoal text-xs font-bold rounded-2xl shadow-lg hover:bg-white transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free →
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto px-6 py-8 border-t border-coolgrey/20 flex flex-col md:flex-row items-center justify-between text-xs text-slateblue gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-charcoal flex items-center justify-center text-white text-[9px] font-bold">EA</div>
            <span class="font-bold text-charcoal">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 6.</p>
        <div class="flex items-center space-x-6">
            <a href="#" class="hover:text-charcoal transition">Privacy</a>
            <a href="#" class="hover:text-charcoal transition">Terms</a>
            <a href="#" class="hover:text-charcoal transition">Contact</a>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        function switchTab(tab) {
            const dashContent = document.getElementById('content-dashboard');
            const dirContent = document.getElementById('content-directory');
            const dashBtn = document.getElementById('tab-dashboard');
            const dirBtn = document.getElementById('tab-directory');

            if(tab === 'dashboard') {
                dashContent.classList.remove('hidden');
                dirContent.classList.add('hidden');
                dashBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-charcoal shadow-sm transition";
                dirBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold text-slateblue hover:text-charcoal transition";
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold bg-white text-charcoal shadow-sm transition";
                dashBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold text-slateblue hover:text-charcoal transition";
            }
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if(plan === 'annual') {
                annualBtn.className = "px-4 py-2 rounded-xl text-xs font-bold bg-white text-charcoal shadow-sm transition";
                monthlyBtn.className = "px-4 py-2 rounded-xl text-xs font-bold text-slateblue hover:text-charcoal transition";
                priceStarter.innerText = "₱0";
                pricePro.innerText = "₱400";
                cycles.forEach(el => el.innerText = "/ month (billed annually)");
            } else {
                monthlyBtn.className = "px-4 py-2 rounded-xl text-xs font-bold bg-white text-charcoal shadow-sm transition";
                annualBtn.className = "px-4 py-2 rounded-xl text-xs font-bold text-slateblue hover:text-charcoal transition";
                priceStarter.innerText = "₱0";
                pricePro.innerText = "₱500";
                cycles.forEach(el => el.innerText = "/ month");
            }
        }

        function toggleFaq(id) {
            const content = document.getElementById(`faq-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            if(content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.innerText = "−";
            } else {
                content.classList.add('hidden');
                icon.innerText = "+";
            }
        }
    </script>
</body>
</html>