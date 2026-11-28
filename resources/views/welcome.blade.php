<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
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
                        pinebase: '#0F1E1A',
                        pinedeep: '#162B25',
                        evergreen: '#1F3B32',
                        cedar: '#2B211B',
                        cranberry: '#C83E4D',
                        cranberrydeep: '#A82E3B',
                        brass: '#E5B567',
                        frostmist: '#E6F0EC',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-pinebase text-frostmist font-sans antialiased selection:bg-cranberry/30 selection:text-white overflow-x-hidden relative">
    <!-- Soft Pine & Warm Lantern Glow (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(229,181,103,0.11),_transparent_58%),radial-gradient(ellipse_at_bottom_left,_rgba(200,62,77,0.10),_transparent_62%)] z-0"></div>

    <!-- Floating Holiday Sparkles & Soft Snow-Motes (Skips #authActionZone) -->
    <canvas id="holidaySparkles" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Top Bar (30% Secondary Structure + 10% Cranberry & Brass Accent) -->
    <header class="sticky top-0 z-40 relative w-full bg-pinebase/90 backdrop-blur-md border-b border-evergreen h-20 flex items-center justify-between px-6 md:px-10 shadow-lg shadow-black/25">
        <!-- Hanging Holiday String Lights along Header Bottom Edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-3.5 w-full h-7 z-30 overflow-visible" viewBox="0 0 1440 28" preserveAspectRatio="none" fill="none">
            <path d="M0 2Q120 18 240 2T480 2T720 2T960 2T1200 2T1440 2" stroke="#E5B567" stroke-width="1.1" stroke-opacity="0.55"/>
            <circle cx="120" cy="11" r="3" fill="#C83E4D"/>
            <circle cx="120" cy="11" r="6.5" fill="#C83E4D" fill-opacity="0.28"/>
            <circle cx="240" cy="11" r="3" fill="#E5B567"/>
            <circle cx="240" cy="11" r="6.5" fill="#E5B567" fill-opacity="0.28"/>
            <circle cx="360" cy="11" r="3" fill="#E6F0EC"/>
            <circle cx="360" cy="11" r="6.5" fill="#E5B567" fill-opacity="0.22"/>
            <circle cx="480" cy="11" r="3" fill="#C83E4D"/>
            <circle cx="480" cy="11" r="6.5" fill="#C83E4D" fill-opacity="0.28"/>
            <circle cx="600" cy="11" r="3" fill="#E5B567"/>
            <circle cx="600" cy="11" r="6.5" fill="#E5B567" fill-opacity="0.28"/>
            <circle cx="720" cy="11" r="3" fill="#E6F0EC"/>
            <circle cx="720" cy="11" r="6.5" fill="#E5B567" fill-opacity="0.22"/>
            <circle cx="840" cy="11" r="3" fill="#C83E4D"/>
            <circle cx="840" cy="11" r="6.5" fill="#C83E4D" fill-opacity="0.28"/>
            <circle cx="960" cy="11" r="3" fill="#E5B567"/>
            <circle cx="960" cy="11" r="6.5" fill="#E5B567" fill-opacity="0.28"/>
            <circle cx="1080" cy="11" r="3" fill="#E6F0EC"/>
            <circle cx="1080" cy="11" r="6.5" fill="#E5B567" fill-opacity="0.22"/>
            <circle cx="1200" cy="11" r="3" fill="#C83E4D"/>
            <circle cx="1200" cy="11" r="6.5" fill="#C83E4D" fill-opacity="0.28"/>
        </svg>

        <a href="#" class="flex items-center space-x-3 group">
            <div class="w-9 h-9 rounded-xl bg-pinedeep border border-brass/45 flex items-center justify-center text-brass shadow-sm group-hover:border-brass transition">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-cranberry rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-brass rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-brass rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-cranberry rounded-full"></span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-base tracking-tight text-white leading-none">EduCore <span class="text-brass">SaaS</span></span>
                <span class="text-[10px] font-medium text-emerald-200/65 tracking-wide mt-0.5">Pine &amp; Lantern Edition</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-1 bg-pinedeep/85 p-1 rounded-2xl border border-evergreen text-xs font-semibold text-emerald-100/80">
            <a href="#features" class="px-3.5 py-1.5 rounded-xl hover:text-brass hover:bg-pinebase/70 transition">Features</a>
            <a href="#pricing" class="px-3.5 py-1.5 rounded-xl hover:text-brass hover:bg-pinebase/70 transition">Pricing</a>
            <a href="#faq" class="px-3.5 py-1.5 rounded-xl hover:text-brass hover:bg-pinebase/70 transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 md:space-x-3 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-frostmist hover:text-brass hover:bg-pinedeep rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-cranberry text-white text-xs font-extrabold rounded-xl shadow-md shadow-cranberry/25 hover:bg-cranberrydeep transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-14 text-center space-y-8">
        <!-- Brass Star & Pine Ornament Pill -->
        <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 bg-pinedeep/95 border border-brass/35 rounded-full shadow-md text-xs font-semibold text-frostmist">
            <svg class="w-4 h-4 text-brass shrink-0" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l2.6 6.2L21 9l-4.8 4.2L17.6 20 12 16.5 6.4 20l1.4-6.8L3 9l6.4-.8L12 2z"/>
            </svg>
            <span>Festive Release &bull; Student management, thoughtfully simplified</span>
            <span class="w-1.5 h-1.5 rounded-full bg-cranberry"></span>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-tight">
                Simplify student records.
                <br>
                <span class="text-brass">Elevate every outcome.</span>
            </h1>
            <div>
                <span class="text-xs md:text-sm font-bold text-brass tracking-widest uppercase bg-pinedeep/95 border border-evergreen inline-flex items-center space-x-2 px-4 py-1.5 rounded-full shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-cranberry"></span>
                    <span>CREATED BY GROUP 1</span>
                </span>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm md:text-base text-emerald-100/80 max-w-2xl mx-auto leading-relaxed">
                One workspace to organize student records, track academic performance, and keep department data clean.
            </p>
            <p class="text-[11px] text-brass/90 tracking-wider font-medium inline-flex items-center space-x-1.5">
                <span>&#10022;</span>
                <span>Season&apos;s greetings &mdash; warm wishes to your department and team.</span>
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-cranberry text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-cranberry/25 hover:bg-cranberrydeep transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#showcase" class="w-full sm:w-auto px-8 py-4 bg-pinedeep/95 text-frostmist border border-evergreen text-xs font-bold rounded-2xl shadow-sm hover:border-brass/50 hover:bg-evergreen/70 transition">
                Explore live demo
            </a>
        </div>

        <!-- Holiday Highlight Strip -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-[11px] font-medium text-emerald-100/75">
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-cranberry font-bold">&#9733;</span>
                <span>Prefix-Locked Student IDs</span>
            </span>
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-brass font-bold">&#9733;</span>
                <span>3.00 / 4.00 / 5.00 GPA Scales</span>
            </span>
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-cranberry font-bold">&#9733;</span>
                <span>Instant CSV Roster Export</span>
            </span>
        </div>
    </section>

    <!-- Live Database Showcase -->
    <section id="showcase" class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-b from-pinedeep/95 to-pinebase/95 border border-evergreen rounded-3xl shadow-2xl shadow-black/35 overflow-hidden">
            <div class="px-6 py-4 bg-pinebase/80 border-b border-evergreen flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-1.5 mr-1">
                        <span class="w-2.5 h-2.5 rounded-full bg-cranberry"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-brass"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80"></span>
                    </div>
                    <span class="text-xs font-mono text-emerald-100/80 bg-pinedeep px-3 py-1 rounded-lg border border-evergreen">educore.app/workspace/dashboard</span>
                    <span class="hidden sm:inline-flex items-center space-x-1.5 text-[10px] text-brass bg-pinedeep border border-brass/35 px-2.5 py-1 rounded-full font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-cranberry"></span>
                        <span>Live DB Connected</span>
                    </span>
                </div>

                <div class="flex items-center space-x-1.5 bg-pinebase p-1 rounded-xl border border-evergreen">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-cranberry text-white shadow-sm transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-emerald-100/75 hover:text-white transition">Directory Table</button>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Tab 1: Live Database Analytics -->
                <div id="content-dashboard" class="space-y-6 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="bg-pinebase/85 p-5 rounded-2xl border border-evergreen hover:border-brass/40 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-200/65">Total Enrolled (Live DB)</p>
                                <span class="text-[10px] font-mono text-emerald-200/60">ROSTER</span>
                            </div>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $totalStudents }}</p>
                            <div class="mt-3 pt-3 border-t border-evergreen/80 flex items-center justify-between text-[11px]">
                                <span class="text-emerald-200/60">Workspace database</span>
                                <span class="text-frostmist bg-pinedeep border border-evergreen px-2.5 py-0.5 rounded-md font-bold">Synced</span>
                            </div>
                        </div>

                        <div class="bg-pinebase/85 p-5 rounded-2xl border border-evergreen hover:border-brass/50 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-200/65">Average Cohort GPA</p>
                                <span class="text-[10px] font-mono text-brass">MEAN</span>
                            </div>
                            <p class="text-3xl font-extrabold text-brass mt-2 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                            <div class="mt-3 pt-3 border-t border-evergreen/80 flex items-center justify-between text-[11px]">
                                <span class="text-emerald-200/60">Calculated mean</span>
                                <span class="text-brass bg-pinedeep border border-brass/30 px-2.5 py-0.5 rounded-md font-bold">Active Scale</span>
                            </div>
                        </div>

                        <div class="bg-pinebase/85 p-5 rounded-2xl border border-evergreen hover:border-brass/40 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-200/65">Active Departments</p>
                                <span class="text-[10px] font-mono text-emerald-200/60">COURSES</span>
                            </div>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $activeCoursesCount }}</p>
                            <div class="mt-3 pt-3 border-t border-evergreen/80 flex items-center justify-between text-[11px]">
                                <span class="text-emerald-200/60">Unique courses</span>
                                <span class="text-frostmist bg-pinedeep border border-evergreen px-2.5 py-0.5 rounded-md font-bold">Verified</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-pinebase/85 p-5 rounded-2xl border border-evergreen shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brass"></span>
                                <p class="text-xs font-bold text-white">Workspace Telemetry Active</p>
                            </div>
                            <p class="text-[11px] text-emerald-200/65">Displaying live summary figures from your EduCore workspace database with integrity &amp; audit checks.</p>
                        </div>
                        <span class="px-3.5 py-1.5 bg-pinedeep border border-brass/45 text-brass text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                    </div>
                </div>

                <!-- Tab 2: Live Database Directory Table -->
                <div id="content-directory" class="hidden space-y-4 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs text-emerald-100/80">Live student records preview from your workspace database.</p>
                        <input
                            type="text"
                            id="previewSearchInput"
                            oninput="filterPreviewStudents()"
                            placeholder="Filter by ID, name, or course..."
                            class="w-full sm:w-72 px-3.5 py-2 bg-pinebase/90 border border-evergreen rounded-xl text-xs text-white placeholder-emerald-200/45 focus:outline-none focus:ring-2 focus:ring-brass/40 focus:border-brass transition"
                        >
                    </div>

                    <div class="bg-pinebase/85 rounded-2xl border border-evergreen shadow-sm overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3.5 bg-pinedeep border-b border-evergreen text-[10px] font-bold text-brass uppercase tracking-wider">
                            <span class="col-span-5">Student ID &amp; Name</span>
                            <span class="col-span-3">Course</span>
                            <span class="col-span-2">GPA</span>
                            <span class="col-span-2 text-right">Status</span>
                        </div>
                        <div id="previewStudentList" class="divide-y divide-evergreen/70 text-xs">
                            @forelse ($students as $student)
                                <div class="preview-student-row grid grid-cols-12 px-5 py-3.5 items-center hover:bg-pinedeep/60 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="col-span-5 flex items-center space-x-2.5 min-w-0 pr-2">
                                        <span class="font-mono text-[11px] font-bold text-brass bg-pinedeep border border-evergreen px-2 py-0.5 rounded-md shrink-0">{{ $student->student_id }}</span>
                                        <span class="font-bold text-white truncate">{{ $student->name }}</span>
                                    </div>
                                    <span class="col-span-3 text-emerald-100/75 font-medium truncate pr-2">{{ $student->course ?? 'BSIT' }}</span>
                                    <span class="col-span-2 font-extrabold text-brass tabular-nums">{{ number_format((float) $student->gpa, 2) }}</span>
                                    <div class="col-span-2 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-pinedeep border border-brass/30 text-frostmist rounded-full font-bold text-[11px]">Active</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-emerald-200/60">No records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-evergreen">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-brass">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Less admin. More clarity.</h2>
            <p class="text-xs text-emerald-100/75 max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-pinedeep/90 p-6 rounded-3xl border border-evergreen shadow-lg hover:border-brass/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-pinebase border border-evergreen text-brass flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-cranberry font-bold">&#9733; 01</span>
                </div>
                <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                <p class="text-xs text-emerald-100/75 leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-pinedeep/90 p-6 rounded-3xl border border-evergreen shadow-lg hover:border-brass/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-pinebase border border-evergreen text-brass flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-brass font-bold">&#9733; 02</span>
                </div>
                <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                <p class="text-xs text-emerald-100/75 leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-pinedeep/90 p-6 rounded-3xl border border-evergreen shadow-lg hover:border-brass/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-pinebase border border-evergreen text-brass flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-cranberry font-bold">&#9733; 03</span>
                </div>
                <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-emerald-100/75 leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-brass">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-pinedeep border border-evergreen p-1.5 rounded-2xl mt-4">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-cranberry text-white shadow-sm transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-emerald-100/80 hover:text-white transition">
                    Annual Billing
                    <span class="text-[10px] text-brass font-bold bg-pinebase px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-pinedeep/90 p-8 rounded-3xl border border-evergreen shadow-lg space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Department Workspace</h3>
                        <span class="text-[10px] text-emerald-100/75 bg-pinebase border border-evergreen px-2.5 py-0.5 rounded-full">Starter</span>
                    </div>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-white price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs text-emerald-200/60 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-emerald-100/75">Good for individual departments and small student rosters.</p>
                    <ul class="space-y-2 pt-2 border-t border-evergreen/80 text-xs text-frostmist">
                        <li class="flex items-center space-x-2"><span class="text-brass">&#10022;</span><span>Student directory &amp; GPA tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-brass">&#10022;</span><span>Custom ID prefix &amp; scale settings</span></li>
                        <li class="flex items-center space-x-2"><span class="text-brass">&#10022;</span><span>CSV roster export</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-pinebase hover:bg-evergreen text-white border border-evergreen rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-pinedeep p-8 rounded-3xl border-2 border-cranberry shadow-xl shadow-black/35 space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-cranberry text-white text-[9px] font-extrabold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Full Institution SaaS</h3>
                        <span class="text-[10px] text-brass bg-pinebase border border-brass/35 px-2.5 py-0.5 rounded-full font-bold">Complete</span>
                    </div>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-brass price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs text-emerald-200/60 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-emerald-100/75">For multi-course academic teams managing larger student directories.</p>
                    <ul class="space-y-2 pt-2 border-t border-evergreen/80 text-xs text-frostmist">
                        <li class="flex items-center space-x-2"><span class="text-cranberry font-bold">&#10022;</span><span>Everything in Department Workspace</span></li>
                        <li class="flex items-center space-x-2"><span class="text-cranberry font-bold">&#10022;</span><span>Automated workspace audit telemetry</span></li>
                        <li class="flex items-center space-x-2"><span class="text-cranberry font-bold">&#10022;</span><span>Multi-course breakdown &amp; bulk actions</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-cranberry hover:bg-cranberrydeep text-white rounded-xl text-xs font-extrabold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-brass">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-pinedeep/90 rounded-2xl border border-evergreen shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-evergreen/50 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold text-brass transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-emerald-100/75 leading-relaxed border-t border-evergreen">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-pinedeep/90 rounded-2xl border border-evergreen shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-evergreen/50 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-bold text-brass transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-emerald-100/75 leading-relaxed border-t border-evergreen">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>

            <div class="bg-pinedeep/90 rounded-2xl border border-evergreen shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-evergreen/50 transition">
                    <span>Which GPA scales and Student ID prefixes are supported?</span>
                    <span id="icon-3" class="text-lg font-bold text-brass transition-transform">+</span>
                </button>
                <div id="faq-3" class="hidden p-5 pt-3 text-xs text-emerald-100/75 leading-relaxed border-t border-evergreen">
                    You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings while keeping IDs clean and validated.
                </div>
            </div>

            <div class="bg-pinedeep/90 rounded-2xl border border-evergreen shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(4)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-evergreen/50 transition">
                    <span>Are workspace edits and course changes logged?</span>
                    <span id="icon-4" class="text-lg font-bold text-brass transition-transform">+</span>
                </button>
                <div id="faq-4" class="hidden p-5 pt-3 text-xs text-emerald-100/75 leading-relaxed border-t border-evergreen">
                    Yes. When workspace change logging is enabled, student edits, course updates, authentication events, and setting changes appear in Actions.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-gradient-to-r from-pinedeep via-evergreen to-pinedeep text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl border border-brass/30 relative overflow-hidden">
            <div class="pointer-events-none absolute -right-14 -top-14 w-56 h-56 rounded-full bg-cranberry/20 blur-2xl"></div>
            <div class="space-y-2 text-center md:text-left relative z-10">
                <p class="text-[10px] font-bold uppercase tracking-widest text-brass">Holiday Term Ready &bull; Season&apos;s Greetings</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-emerald-100/75 max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="relative z-10 px-8 py-4 bg-cranberry text-white text-xs font-extrabold rounded-2xl shadow-md hover:bg-cranberrydeep transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-evergreen flex flex-col md:flex-row items-center justify-between text-xs text-emerald-200/60 gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-pinedeep border border-brass/35 flex items-center justify-center text-brass text-[9px] font-bold">EA</div>
            <span class="font-bold text-white">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1 &bull; <span class="text-brass">Happy holidays</span></p>
        <div class="flex items-center space-x-6">
            <a href="#features" class="hover:text-brass transition">Features</a>
            <a href="#pricing" class="hover:text-brass transition">Pricing</a>
            <a href="#faq" class="hover:text-brass transition">FAQ</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-cranberry text-white shadow-sm transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-emerald-100/75 hover:text-white transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-cranberry text-white shadow-sm transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-emerald-100/75 hover:text-white transition';
            }
        }

        function filterPreviewStudents() {
            const query = String(document.getElementById('previewSearchInput')?.value || '').trim().toLowerCase();
            const rows = document.querySelectorAll('.preview-student-row');
            rows.forEach((row) => {
                const haystack = String(row.getAttribute('data-filter') || '');
                row.classList.toggle('hidden', query !== '' && !haystack.includes(query));
            });
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-cranberry text-white shadow-sm transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-emerald-100/80 hover:text-white transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-cranberry text-white shadow-sm transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-emerald-100/80 hover:text-white transition';
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
                icon.innerText = '-';
            } else {
                content.classList.add('hidden');
                icon.innerText = '+';
            }
        }

        // Soft 4-point star sparkles & warm snow-motes skipping #authActionZone
        (function initHolidaySparkles() {
            const canvas = document.getElementById('holidaySparkles');
            const excludedEl = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const particles = Array.from({ length: 44 }, (_, idx) => ({
                x: Math.random() * 1600,
                y: Math.random() * 1000,
                size: 3.5 + Math.random() * 5.5,
                vy: 0.35 + Math.random() * 0.6,
                vx: -0.25 + Math.random() * 0.5,
                angle: Math.random() * Math.PI * 2,
                spin: (-0.01 + Math.random() * 0.02),
                alpha: 0.4 + Math.random() * 0.45,
                isStar: idx % 3 === 0,
                isWarm: idx % 2 === 0,
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

            function drawParticle(p) {
                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate(p.angle);
                const color = p.isWarm ? `rgba(229, 181, 103, ${p.alpha})` : `rgba(230, 240, 236, ${p.alpha * 0.85})`;

                if (p.isStar) {
                    const outer = p.size * 1.3;
                    const inner = p.size * 0.38;
                    ctx.fillStyle = color;
                    ctx.beginPath();
                    for (let i = 0; i < 8; i++) {
                        const rad = i % 2 === 0 ? outer : inner;
                        const a = (i * Math.PI) / 4;
                        if (i === 0) ctx.moveTo(Math.cos(a) * rad, Math.sin(a) * rad);
                        else ctx.lineTo(Math.cos(a) * rad, Math.sin(a) * rad);
                    }
                    ctx.closePath();
                    ctx.fill();
                } else {
                    ctx.fillStyle = color;
                    ctx.beginPath();
                    ctx.arc(0, 0, p.size * 0.55, 0, Math.PI * 2);
                    ctx.fill();
                }
                ctx.restore();
            }

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const p of particles) {
                    p.x += p.vx;
                    p.y += p.vy;
                    p.angle += p.spin;
                    if (p.y - p.size > height) {
                        p.y = -p.size * 2;
                        p.x = Math.random() * width;
                    }
                    if (p.x + p.size < 0) p.x = width + p.size;
                    if (p.x - p.size > width) p.x = -p.size;
                    if (!isInsideExcludedZone(p.x, p.y, p.size + 10)) {
                        drawParticle(p);
                    }
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>