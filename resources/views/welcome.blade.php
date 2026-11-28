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
                        canvas: '#F8FAFC',
                        surface: '#FFFFFF',
                        ink: '#1E293B',
                        muted: '#64748B',
                        line: '#E2E8F0',
                        amberacc: '#D97706',
                        amberdeep: '#B45309',
                    }
                }
            }
        }
    </script>
    <style>
        .bg-dot-grid {
            background-image: radial-gradient(rgba(30, 41, 59, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-canvas text-ink font-sans antialiased selection:bg-amberacc/20 selection:text-amberdeep overflow-x-hidden relative">
    <!-- Subtle Dot Grid & Ambient Glow (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-dot-grid [mask-image:radial-gradient(ellipse_at_top,black_45%,transparent_85%)] z-0"></div>
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(circle_at_top_center,_rgba(217,119,6,0.09),_transparent_58%),radial-gradient(circle_at_bottom_right,_rgba(30,41,59,0.06),_transparent_60%)] z-0"></div>

    <!-- Top Bar -->
    <header class="sticky top-0 z-40 w-full bg-surface/85 backdrop-blur-xl border-b border-line/90 h-20 flex items-center justify-between px-6 md:px-10">
        <a href="#" class="flex items-center space-x-3 group">
            <div class="w-9 h-9 rounded-xl bg-ink flex items-center justify-center text-amberacc shadow-sm group-hover:scale-[1.03] transition">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-amberacc rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-amberacc rounded-full"></span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-base tracking-tight text-ink leading-none">EduCore <span class="text-amberacc">SaaS</span></span>
                <span class="text-[10px] font-medium text-muted tracking-wide mt-0.5">Academic Records Cloud</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-1 bg-canvas/90 p-1 rounded-2xl border border-line/80 text-xs font-semibold text-muted">
            <a href="#features" class="px-3.5 py-1.5 rounded-xl hover:text-ink hover:bg-surface transition">Features</a>
            <a href="#pricing" class="px-3.5 py-1.5 rounded-xl hover:text-ink hover:bg-surface transition">Pricing</a>
            <a href="#faq" class="px-3.5 py-1.5 rounded-xl hover:text-ink hover:bg-surface transition">FAQ</a>
        </nav>

        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 md:space-x-3 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-ink hover:text-amberdeep hover:bg-canvas rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-amberacc text-white text-xs font-extrabold rounded-xl shadow-sm shadow-amberacc/20 hover:bg-amberdeep transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-14 text-center space-y-8">
        <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 bg-surface/95 border border-line rounded-full shadow-2xs text-xs font-semibold text-ink">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amberacc opacity-60"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amberacc"></span>
            </span>
            <span>Student record operations, thoughtfully structured</span>
            <span class="text-[10px] font-mono text-muted border-l border-line pl-2.5">v2.4</span>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-ink tracking-tight leading-[1.08]">
                Simplify student records.
                <br>
                <span class="bg-gradient-to-r from-amberacc via-amberdeep to-ink bg-clip-text text-transparent">Elevate every outcome.</span>
            </h1>
            <div>
                <span class="text-[11px] font-bold text-ink tracking-widest uppercase bg-surface border border-line inline-flex items-center space-x-2 px-4 py-1.5 rounded-full shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-amberacc"></span>
                    <span>CREATED BY GROUP 1</span>
                </span>
            </div>
        </div>

        <p class="text-sm md:text-base text-muted max-w-2xl mx-auto leading-relaxed">
            One workspace to organize student rosters, enforce ID &amp; GPA rules, inspect course performance, and keep department records audit-ready.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-amberacc text-white text-xs font-extrabold rounded-2xl shadow-md shadow-amberacc/20 hover:bg-amberdeep transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#showcase" class="w-full sm:w-auto px-8 py-4 bg-surface text-ink border border-line text-xs font-bold rounded-2xl shadow-2xs hover:border-slate-300 hover:bg-canvas transition flex items-center justify-center space-x-2">
                <span>Explore live workspace</span>
            </a>
        </div>

        <!-- Subtle Capability Strip -->
        <div class="pt-4 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-[11px] font-medium text-muted">
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-amberacc font-bold">&#10003;</span>
                <span>Prefix-locked Student IDs</span>
            </span>
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-amberacc font-bold">&#10003;</span>
                <span>3.00 / 4.00 / 5.00 GPA Scales</span>
            </span>
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-amberacc font-bold">&#10003;</span>
                <span>Instant CSV Roster Export</span>
            </span>
        </div>
    </section>

    <!-- Live Database Showcase (30% Secondary Structure) -->
    <section id="showcase" class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-surface border border-line rounded-3xl shadow-lg shadow-ink/5 overflow-hidden">
            <!-- Window Header -->
            <div class="px-6 py-4 bg-canvas/80 border-b border-line flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-1.5 mr-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-400/90"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400/90"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/90"></span>
                    </div>
                    <span class="text-[11px] font-mono text-muted bg-surface px-3 py-1 rounded-lg border border-line">educore.app/workspace/dashboard</span>
                    <span class="hidden sm:inline-flex items-center space-x-1.5 text-[10px] font-bold text-amberdeep bg-amber-50 border border-amber-200/80 px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-amberacc"></span>
                        <span>Live DB Connected</span>
                    </span>
                </div>

                <div class="flex items-center space-x-1.5 bg-surface p-1 rounded-xl border border-line">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-ink text-white shadow-2xs transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-muted hover:text-ink transition">Directory Table</button>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Tab 1: Dashboard Analytics -->
                <div id="content-dashboard" class="space-y-6 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="bg-canvas/80 p-5 rounded-2xl border border-line hover:border-slate-300 transition">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-muted">Total Enrolled</p>
                                <span class="text-[10px] font-mono text-muted">ROSTER</span>
                            </div>
                            <p class="text-3xl font-extrabold text-ink mt-2 tabular-nums">{{ $totalStudents }}</p>
                            <div class="mt-3 pt-3 border-t border-line/70 flex items-center justify-between text-[11px]">
                                <span class="text-muted">Database records</span>
                                <span class="font-bold text-ink bg-surface border border-line px-2 py-0.5 rounded-md">Synced</span>
                            </div>
                        </div>

                        <div class="bg-canvas/80 p-5 rounded-2xl border border-line hover:border-amber-300/80 transition">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-muted">Average Cohort GPA</p>
                                <span class="text-[10px] font-mono text-amberdeep">MEAN</span>
                            </div>
                            <p class="text-3xl font-extrabold text-amberacc mt-2 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                            <div class="mt-3 pt-3 border-t border-line/70 flex items-center justify-between text-[11px]">
                                <span class="text-muted">Calculated mean</span>
                                <span class="font-bold text-amberdeep bg-amber-50 border border-amber-200/80 px-2 py-0.5 rounded-md">Active Scale</span>
                            </div>
                        </div>

                        <div class="bg-canvas/80 p-5 rounded-2xl border border-line hover:border-slate-300 transition">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-muted">Active Departments</p>
                                <span class="text-[10px] font-mono text-muted">COURSES</span>
                            </div>
                            <p class="text-3xl font-extrabold text-ink mt-2 tabular-nums">{{ $activeCoursesCount }}</p>
                            <div class="mt-3 pt-3 border-t border-line/70 flex items-center justify-between text-[11px]">
                                <span class="text-muted">Unique programs</span>
                                <span class="font-bold text-ink bg-surface border border-line px-2 py-0.5 rounded-md">Verified</span>
                            </div>
                        </div>
                    </div>

                    <!-- Cohort Standing Bar -->
                    <div class="bg-canvas/80 p-5 rounded-2xl border border-line flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-amberacc"></span>
                                <p class="text-xs font-bold text-ink">Workspace Telemetry &amp; Integrity Status</p>
                            </div>
                            <p class="text-[11px] text-muted">Live metrics reflect current records stored in your EduCore workspace with automatic prefix and range checks.</p>
                        </div>
                        <div class="flex items-center space-x-2 shrink-0">
                            <span class="px-3 py-1.5 bg-surface border border-line text-ink text-[11px] font-bold rounded-xl">Audit Ready</span>
                            <span class="px-3 py-1.5 bg-ink text-white text-[11px] font-bold rounded-xl">Live DB</span>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Directory Table -->
                <div id="content-directory" class="hidden space-y-4 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs font-semibold text-muted">Preview of live student entries from your workspace database.</p>
                        <input
                            type="text"
                            id="previewSearchInput"
                            oninput="filterPreviewStudents()"
                            placeholder="Filter preview by ID, name, or course..."
                            class="w-full sm:w-72 px-3.5 py-2 bg-canvas border border-line rounded-xl text-xs text-ink placeholder-muted focus:outline-none focus:ring-2 focus:ring-amberacc/30 focus:border-amberacc transition"
                        >
                    </div>

                    <div class="bg-canvas/60 rounded-2xl border border-line overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3.5 bg-ink text-[10px] font-bold text-slate-200 uppercase tracking-wider">
                            <span class="col-span-5">Student ID &amp; Name</span>
                            <span class="col-span-3">Course</span>
                            <span class="col-span-2">GPA</span>
                            <span class="col-span-2 text-right">Status</span>
                        </div>
                        <div id="previewStudentList" class="divide-y divide-line text-xs bg-surface">
                            @forelse ($students as $student)
                                <div class="preview-student-row grid grid-cols-12 px-5 py-3.5 items-center hover:bg-canvas/80 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="col-span-5 flex items-center space-x-2.5 min-w-0 pr-2">
                                        <span class="font-mono text-[11px] font-bold text-amberdeep bg-amber-50 border border-amber-200/70 px-2 py-0.5 rounded-md shrink-0">{{ $student->student_id }}</span>
                                        <span class="font-bold text-ink truncate">{{ $student->name }}</span>
                                    </div>
                                    <span class="col-span-3 text-muted font-medium truncate pr-2">{{ $student->course ?? 'BSIT' }}</span>
                                    <span class="col-span-2 font-extrabold text-ink tabular-nums">{{ number_format((float) $student->gpa, 2) }}</span>
                                    <div class="col-span-2 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-canvas border border-line text-ink text-[11px] rounded-full font-semibold">Active</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-muted">No records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-20 space-y-12 border-t border-line">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-amberacc">Everything you need</span>
            <h2 class="text-2xl md:text-4xl font-extrabold text-ink tracking-tight">Less admin. More clarity.</h2>
            <p class="text-xs md:text-sm text-muted max-w-xl mx-auto">Purpose-built tools for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface p-7 rounded-3xl border border-line shadow-2xs hover:border-amberacc/40 hover:shadow-md transition space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 border border-amber-200/70 text-amberacc flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-muted">01</span>
                </div>
                <h3 class="text-sm font-bold text-ink">Instant CRUD Management</h3>
                <p class="text-xs text-muted leading-relaxed">Create, inspect, update, and remove student records cleanly with automatic prefix sequencing and GPA validation.</p>
            </div>

            <div class="bg-surface p-7 rounded-3xl border border-line shadow-2xs hover:border-amberacc/40 hover:shadow-md transition space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-canvas border border-line text-ink flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-muted">02</span>
                </div>
                <h3 class="text-sm font-bold text-ink">Grading Statistics &amp; Courses</h3>
                <p class="text-xs text-muted leading-relaxed">Monitor cohort GPA averages across 3.00, 4.00, or 5.00 scales and manage active department courses in one place.</p>
            </div>

            <div class="bg-surface p-7 rounded-3xl border border-line shadow-2xs hover:border-amberacc/40 hover:shadow-md transition space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 border border-amber-200/70 text-amberacc flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-muted">03</span>
                </div>
                <h3 class="text-sm font-bold text-ink">Search, Audit Logs &amp; CSV Export</h3>
                <p class="text-xs text-muted leading-relaxed">Filter records quickly, track workspace changes in audit logs, and export clean CSV rosters whenever needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-20 space-y-12 border-t border-line">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-amberacc">Transparent Pricing</span>
            <h2 class="text-2xl md:text-4xl font-extrabold text-ink tracking-tight">Simple plans for academic teams</h2>
            <p class="text-xs md:text-sm text-muted max-w-lg mx-auto">Start free for a single department or scale up for multi-course institutional rosters.</p>
            <div class="inline-flex items-center space-x-1.5 bg-surface border border-line p-1.5 rounded-2xl mt-4 shadow-2xs">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-ink text-white shadow-2xs transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-muted hover:text-ink transition">
                    Annual Billing
                    <span class="text-[10px] text-amberdeep font-bold bg-amber-50 border border-amber-200/80 px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-surface p-8 rounded-3xl border border-line shadow-2xs space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-extrabold text-ink uppercase tracking-wider">Department Workspace</h3>
                        <span class="text-[10px] font-semibold text-muted bg-canvas border border-line px-2.5 py-0.5 rounded-full">Starter</span>
                    </div>
                    <div class="flex items-baseline space-x-1.5">
                        <span class="text-4xl font-extrabold text-ink price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs text-muted billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-muted">Ideal for individual departments and faculty managing core student records.</p>
                    <ul class="space-y-2.5 pt-2 border-t border-line/70 text-xs text-ink/90">
                        <li class="flex items-center space-x-2"><span class="text-amberacc font-bold">&#10003;</span><span>Student directory &amp; GPA tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-amberacc font-bold">&#10003;</span><span>Custom ID prefix &amp; scale settings</span></li>
                        <li class="flex items-center space-x-2"><span class="text-amberacc font-bold">&#10003;</span><span>CSV roster export</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3.5 bg-canvas hover:bg-slate-100 text-ink border border-line rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-surface p-8 rounded-3xl border-2 border-amberacc shadow-md shadow-amberacc/10 space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-amberacc text-white text-[9px] font-extrabold px-3.5 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-extrabold text-ink uppercase tracking-wider">Full Institution SaaS</h3>
                        <span class="text-[10px] font-bold text-amberdeep bg-amber-50 border border-amber-200/80 px-2.5 py-0.5 rounded-full">Complete</span>
                    </div>
                    <div class="flex items-baseline space-x-1.5">
                        <span class="text-4xl font-extrabold text-amberacc price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs text-muted billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-muted">Built for multi-course academic teams needing full audit history and scale controls.</p>
                    <ul class="space-y-2.5 pt-2 border-t border-line/70 text-xs text-ink/90">
                        <li class="flex items-center space-x-2"><span class="text-amberacc font-bold">&#10003;</span><span>Everything in Department Workspace</span></li>
                        <li class="flex items-center space-x-2"><span class="text-amberacc font-bold">&#10003;</span><span>Automated workspace audit telemetry</span></li>
                        <li class="flex items-center space-x-2"><span class="text-amberacc font-bold">&#10003;</span><span>Multi-course breakdown &amp; bulk actions</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3.5 bg-amberacc hover:bg-amberdeep text-white rounded-xl text-xs font-extrabold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-20 space-y-10 border-t border-line">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-amberacc">Got Questions?</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-ink tracking-tight">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-3.5">
            <div class="bg-surface rounded-2xl border border-line shadow-2xs overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-ink hover:bg-canvas/70 transition">
                    <span>How does workspace session persistence work across pages?</span>
                    <span id="icon-1" class="w-6 h-6 rounded-lg bg-canvas border border-line text-amberacc font-bold flex items-center justify-center text-sm shrink-0">+</span>
                </button>
                <div id="faq-1" class="hidden px-5 pb-5 pt-3 text-xs text-muted leading-relaxed border-t border-line/80">
                    EduCore keeps your active workspace session, workspace name, profile photo, and selected GPA scale synced across dashboard, directory, actions, and settings views.
                </div>
            </div>

            <div class="bg-surface rounded-2xl border border-line shadow-2xs overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-ink hover:bg-canvas/70 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="w-6 h-6 rounded-lg bg-canvas border border-line text-amberacc font-bold flex items-center justify-center text-sm shrink-0">+</span>
                </button>
                <div id="faq-2" class="hidden px-5 pb-5 pt-3 text-xs text-muted leading-relaxed border-t border-line/80">
                    Yes. You can export your current student roster as a CSV file directly from Workspace Settings whenever you need a spreadsheet backup or report.
                </div>
            </div>

            <div class="bg-surface rounded-2xl border border-line shadow-2xs overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-ink hover:bg-canvas/70 transition">
                    <span>Which GPA scales and Student ID formats are supported?</span>
                    <span id="icon-3" class="w-6 h-6 rounded-lg bg-canvas border border-line text-amberacc font-bold flex items-center justify-center text-sm shrink-0">+</span>
                </button>
                <div id="faq-3" class="hidden px-5 pb-5 pt-3 text-xs text-muted leading-relaxed border-t border-line/80">
                    You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings while keeping IDs clean and validated.
                </div>
            </div>

            <div class="bg-surface rounded-2xl border border-line shadow-2xs overflow-hidden">
                <button type="button" onclick="toggleFaq(4)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-ink hover:bg-canvas/70 transition">
                    <span>Are record edits and workspace changes tracked?</span>
                    <span id="icon-4" class="w-6 h-6 rounded-lg bg-canvas border border-line text-amberacc font-bold flex items-center justify-center text-sm shrink-0">+</span>
                </button>
                <div id="faq-4" class="hidden px-5 pb-5 pt-3 text-xs text-muted leading-relaxed border-t border-line/80">
                    Yes. When audit logging is enabled, student updates, course changes, authentication events, and workspace setting adjustments are recorded for review.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-ink text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-md relative overflow-hidden">
            <div class="pointer-events-none absolute -right-16 -top-16 w-64 h-64 rounded-full bg-amberacc/15 blur-2xl"></div>
            <div class="space-y-2 text-center md:text-left relative z-10">
                <p class="text-[10px] font-bold uppercase tracking-widest text-amberacc">Ready when you are</p>
                <h3 class="text-xl md:text-2xl font-extrabold tracking-tight">Give your team time back.</h3>
                <p class="text-xs text-slate-300 max-w-md">Set up your workspace and keep student records organized in one calm, reliable place.</p>
            </div>
            <a href="{{ route('register') }}" class="relative z-10 px-8 py-4 bg-amberacc text-white text-xs font-extrabold rounded-2xl shadow-sm hover:bg-amberdeep transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-line flex flex-col md:flex-row items-center justify-between text-xs text-muted gap-4">
        <div class="flex items-center space-x-2.5">
            <div class="w-7 h-7 rounded-lg bg-ink text-amberacc flex items-center justify-center text-[10px] font-extrabold">EA</div>
            <span class="font-bold text-ink">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1</p>
        <div class="flex items-center space-x-6">
            <a href="#features" class="hover:text-ink transition">Features</a>
            <a href="#pricing" class="hover:text-ink transition">Pricing</a>
            <a href="#faq" class="hover:text-ink transition">FAQ</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-ink text-white shadow-2xs transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-muted hover:text-ink transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-ink text-white shadow-2xs transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-muted hover:text-ink transition';
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
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-ink text-white shadow-2xs transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-muted hover:text-ink transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-ink text-white shadow-2xs transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-muted hover:text-ink transition';
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
    </script>
</body>
</html>