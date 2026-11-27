<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore SaaS — Student Records & Workspace Portal</title>
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
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased min-h-screen flex flex-col selection:bg-slateblue/20">
    @php
        $statStudents = $totalStudents ?? 0;
        $statGpa = number_format((float) ($averageGpa ?? 0), 2);
        $statCourses = $activeCoursesCount ?? 0;
        $previewStudents = isset($students) ? collect($students)->take(5) : collect();
    @endphp

    <!-- Top Navigation Bar -->
    <header class="bg-[#FFFEEB]/90 backdrop-blur-md border-b border-coolgrey/30 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 md:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-charcoal flex items-center justify-center text-white shadow-md">
                    <div class="grid grid-cols-2 gap-0.5">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    </div>
                </div>
                <span class="font-extrabold text-sm tracking-tight text-charcoal">EduCore SaaS</span>
            </div>

            <nav class="hidden md:flex items-center space-x-6 text-xs font-bold text-slateblue">
                <a href="#dashboard-preview" class="hover:text-charcoal transition">Dashboard</a>
                <a href="#directory-preview" class="hover:text-charcoal transition">Directory</a>
                <button type="button" onclick="openBillingModal('Growth')" class="hover:text-charcoal transition">Billing</button>
                <a href="#questions-section" class="hover:text-charcoal transition">Q&amp;A</a>
            </nav>

            <div class="flex items-center space-x-2.5">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-white border border-coolgrey/40 text-charcoal rounded-xl text-xs font-bold hover:bg-gray-50 transition shadow-sm">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">
                    Get Started
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 md:px-8 py-8 space-y-8">
        <!-- Hero / Overview Banner -->
        <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <p id="welcome-live-clock" class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue mb-1">LIVE WORKSPACE OVERVIEW</p>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-charcoal">Multi-Tenant Student Records &amp; Academic Analytics</h1>
                <p class="text-xs text-slateblue mt-1.5 max-w-2xl">
                    Manage student enrollments, configurable GPA scales, prefix-locked student IDs, and audit trails in one workspace.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <button type="button" onclick="openBillingModal('Pro')" class="px-4 py-2.5 bg-gray-100 text-charcoal rounded-2xl text-xs font-bold hover:bg-gray-200 transition">
                    Billing Plans
                </button>
                <a href="{{ route('students.index') }}" class="px-5 py-2.5 bg-charcoal text-white rounded-2xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">
                    Open Workspace
                </a>
            </div>
        </div>

        <!-- Static Dashboard Stat Cards (Matching Admin Dashboard Style) -->
        <section id="dashboard-preview" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slateblue uppercase tracking-wider">Total Students</span>
                        <span class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue font-bold text-xs">#</span>
                    </div>
                    <div class="flex items-baseline space-x-2 mt-3">
                        <span class="text-3xl font-extrabold text-charcoal">{{ $statStudents }}</span>
                        <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                    </div>
                    <p class="text-[11px] text-slateblue mt-1">workspace records</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slateblue uppercase tracking-wider">Average GPA</span>
                        <span class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue font-bold text-xs">GPA</span>
                    </div>
                    <div class="flex items-baseline space-x-2 mt-3">
                        <span class="text-3xl font-extrabold text-charcoal">{{ $statGpa }}</span>
                        <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                    </div>
                    <p class="text-[11px] text-slateblue mt-1">calculated mean</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slateblue uppercase tracking-wider">Active Courses</span>
                        <span class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue font-bold text-xs">CRS</span>
                    </div>
                    <div class="flex items-baseline space-x-2 mt-3">
                        <span class="text-3xl font-extrabold text-charcoal">{{ $statCourses }}</span>
                        <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                    </div>
                    <p class="text-[11px] text-slateblue mt-1">registered courses</p>
                </div>
            </div>
        </section>

        <!-- Static Directory Table (Matching Admin Dashboard Style) -->
        <section id="directory-preview" class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
            <div class="p-6 border-b border-coolgrey/20 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-charcoal">Student Directory Snapshot</h2>
                    <p class="text-xs text-slateblue mt-0.5">Static overview matching the workspace table structure.</p>
                </div>
                <a href="{{ route('students.directory') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-charcoal rounded-xl text-xs font-bold transition">
                    Full Directory
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                            <th class="py-3.5 px-4">Student ID</th>
                            <th class="py-3.5 px-4">Full Name</th>
                            <th class="py-3.5 px-4">Course</th>
                            <th class="py-3.5 px-4">GPA</th>
                            <th class="py-3.5 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-coolgrey/10 text-xs">
                        @forelse ($previewStudents as $student)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-4 font-mono font-semibold text-charcoal">{{ $student->student_id }}</td>
                                <td class="py-4 px-4 font-bold text-charcoal">{{ $student->name }}</td>
                                <td class="py-4 px-4 text-slateblue font-medium">{{ $student->course }}</td>
                                <td class="py-4 px-4 font-bold text-charcoal">{{ number_format((float) $student->gpa, 2) }}</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center text-xs text-emerald-700 font-medium bg-emerald-50 px-2.5 py-0.5 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Active
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slateblue">Sign in to view or add student records in your workspace.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Real-Time / Filterable Q&A Section -->
        <section id="questions-section" class="bg-white rounded-3xl border border-coolgrey/20 shadow-md p-6 md:p-8 space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Live Knowledge Base</p>
                    <h2 class="text-base font-bold text-charcoal mt-0.5">Frequently Asked Questions</h2>
                </div>
                <input type="text" id="faqFilterInput" oninput="filterFaqItems()" placeholder="Filter questions in real time..." class="px-3.5 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner focus:outline-none focus:ring-2 focus:ring-slateblue/50 w-full sm:w-72">
            </div>

            <div id="faqList" class="space-y-3">
                <div class="faq-item p-4 rounded-2xl bg-gray-50 border border-coolgrey/20" data-faq="how does multi tenant workspace isolation work">
                    <button type="button" onclick="toggleFaqAnswer(this)" class="w-full text-left flex items-center justify-between text-xs font-bold text-charcoal">
                        <span>How does workspace isolation work for student records?</span>
                        <span class="text-slateblue ml-2">+</span>
                    </button>
                    <p class="faq-answer mt-2 text-xs text-slateblue">
                        Each workspace scopes student rows, settings, and audit logs to its own workspace owner so records stay separated across accounts.
                    </p>
                </div>

                <div class="faq-item p-4 rounded-2xl bg-gray-50 border border-coolgrey/20" data-faq="how do gpa scale limits and prefixes work">
                    <button type="button" onclick="toggleFaqAnswer(this)" class="w-full text-left flex items-center justify-between text-xs font-bold text-charcoal">
                        <span>How do GPA scale limits and student ID prefixes work?</span>
                        <span class="text-slateblue ml-2">+</span>
                    </button>
                    <p class="faq-answer mt-2 text-xs text-slateblue">
                        Admins configure the GPA scale (`3.00`, `4.00`, or `5.00`) and default prefix in Settings. New records auto-increment using the active prefix, and non-numeric symbols (except `.`) are stripped from GPA inputs.
                    </p>
                </div>

                <div class="faq-item p-4 rounded-2xl bg-gray-50 border border-coolgrey/20" data-faq="can i export student data to csv and track audit logs">
                    <button type="button" onclick="toggleFaqAnswer(this)" class="w-full text-left flex items-center justify-between text-xs font-bold text-charcoal">
                        <span>Can I export student records to CSV and view audit logs?</span>
                        <span class="text-slateblue ml-2">+</span>
                    </button>
                    <p class="faq-answer mt-2 text-xs text-slateblue">
                        Yes. You can export your workspace student records as a CSV from Settings and review create, update, delete, and settings events in the Audit Logs.
                    </p>
                </div>

                <div class="faq-item p-4 rounded-2xl bg-gray-50 border border-coolgrey/20" data-faq="how do billing plans and upgrades work">
                    <button type="button" onclick="toggleFaqAnswer(this)" class="w-full text-left flex items-center justify-between text-xs font-bold text-charcoal">
                        <span>How do billing plans work without leaving the page?</span>
                        <span class="text-slateblue ml-2">+</span>
                    </button>
                    <p class="faq-answer mt-2 text-xs text-slateblue">
                        Click Billing or Billing Plans anywhere on this page to compare Starter, Growth, and Campus plans and select a tier directly in the Billing modal without being forced to `/register`.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <!-- Interactive Billing Modal (Does NOT redirect to /register) -->
    <div id="billingModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 shadow-2xl border border-coolgrey/20 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Workspace Billing</p>
                    <h3 class="text-lg font-extrabold text-charcoal">Select a Plan</h3>
                </div>
                <button type="button" onclick="closeBillingModal()" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                <div class="p-4 rounded-2xl border border-coolgrey/30 bg-gray-50 space-y-2">
                    <p class="font-extrabold text-charcoal">Starter</p>
                    <p class="text-xl font-extrabold text-charcoal">Free</p>
                    <p class="text-[11px] text-slateblue">Up to 250 student records, CSV export, and audit logs.</p>
                    <button type="button" onclick="selectBillingPlan('Starter (Free)')" class="w-full py-2 bg-white border border-coolgrey/40 rounded-xl font-bold text-charcoal hover:bg-gray-100 transition">
                        Select Starter
                    </button>
                </div>

                <div class="p-4 rounded-2xl border-2 border-charcoal bg-white space-y-2 shadow-sm">
                    <p class="font-extrabold text-charcoal">Growth</p>
                    <p class="text-xl font-extrabold text-charcoal">$19<span class="text-xs font-medium text-slateblue">/mo</span></p>
                    <p class="text-[11px] text-slateblue">Unlimited records, custom GPA scales, and full telemetry.</p>
                    <button type="button" onclick="selectBillingPlan('Growth ($19/mo)')" class="w-full py-2 bg-charcoal text-white rounded-xl font-bold hover:bg-charcoal/90 transition">
                        Select Growth
                    </button>
                </div>

                <div class="p-4 rounded-2xl border border-coolgrey/30 bg-gray-50 space-y-2">
                    <p class="font-extrabold text-charcoal">Campus</p>
                    <p class="text-xl font-extrabold text-charcoal">$49<span class="text-xs font-medium text-slateblue">/mo</span></p>
                    <p class="text-[11px] text-slateblue">Multi-department workspaces, priority support, and exports.</p>
                    <button type="button" onclick="selectBillingPlan('Campus ($49/mo)')" class="w-full py-2 bg-white border border-coolgrey/40 rounded-xl font-bold text-charcoal hover:bg-gray-100 transition">
                        Select Campus
                    </button>
                </div>
            </div>

            <div id="billingConfirmation" class="hidden p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-800"></div>

            <div class="flex justify-end">
                <button type="button" onclick="closeBillingModal()" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-bold">Close</button>
            </div>
        </div>
    </div>

    <script>
        function openBillingModal(planName) {
            document.getElementById('billingModal').classList.remove('hidden');
        }

        function closeBillingModal() {
            document.getElementById('billingModal').classList.add('hidden');
        }

        function selectBillingPlan(label) {
            const box = document.getElementById('billingConfirmation');
            if (box) {
                box.textContent = `Selected plan: ${label}. Billing quote ready for your workspace.`;
                box.classList.remove('hidden');
            }
        }

        function toggleFaqAnswer(button) {
            const item = button.closest('.faq-item');
            const answer = item ? item.querySelector('.faq-answer') : null;
            if (answer) {
                answer.classList.toggle('hidden');
            }
        }

        function filterFaqItems() {
            const term = String(document.getElementById('faqFilterInput')?.value || '').trim().toLowerCase();
            const items = document.querySelectorAll('.faq-item');
            items.forEach((item) => {
                const text = String((item.getAttribute('data-faq') || '') + ' ' + item.textContent).toLowerCase();
                item.classList.toggle('hidden', term !== '' && !text.includes(term));
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const clockEl = document.getElementById('welcome-live-clock');
            if (clockEl) {
                const updateClock = () => {
                    const now = new Date();
                    clockEl.textContent = now.toLocaleString('en-US', {
                        weekday: 'short',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    }).toUpperCase();
                };
                updateClock();
                setInterval(updateClock, 1000);
            }
        });
    </script>
</body>
</html>