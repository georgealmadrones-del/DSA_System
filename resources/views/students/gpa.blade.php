<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPA Analytics — EduCore SaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        charcoal: '#4A4A4A',
                        coolgrey: '#CBCBCB',
                        ivory: '#FFFFE3',
                        slateblue: '#2B6CB0',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased min-h-screen p-4 md:p-8">
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md gap-4">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Academic Analytics</p>
                <h1 class="text-2xl font-extrabold text-charcoal mt-0.5">Average GPA & Student Records</h1>
                <p class="text-xs text-slateblue mt-0.5">
                    Calculated mean across {{ $students->count() }} records on a {{ number_format((float) ($settings['gpa_scale'] ?? 3.00), 2) }} scale.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('students.index') }}" class="px-4 py-2.5 bg-gray-100 text-charcoal rounded-2xl text-xs font-bold hover:bg-gray-200 transition">
                    &larr; Dashboard
                </a>
                <a href="{{ route('students.directory') }}" class="px-4 py-2.5 bg-charcoal text-white rounded-2xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">
                    Student Directory
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slateblue">Calculated Mean GPA</p>
                <p class="text-3xl font-extrabold text-charcoal mt-2">{{ number_format((float) $averageGpa, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slateblue">Active GPA Scale</p>
                <p class="text-3xl font-extrabold text-charcoal mt-2">{{ number_format((float) ($settings['gpa_scale'] ?? 3.00), 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slateblue">Evaluated Students</p>
                <p class="text-3xl font-extrabold text-charcoal mt-2">{{ $students->count() }}</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
            <div class="p-6 border-b border-coolgrey/20">
                <h2 class="text-base font-bold text-charcoal">Student GPA Breakdown</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                            <th class="py-3.5 px-4">Student ID</th>
                            <th class="py-3.5 px-4">Full Name</th>
                            <th class="py-3.5 px-4">Course</th>
                            <th class="py-3.5 px-4 text-right">GPA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-coolgrey/10 text-xs">
                        @forelse ($students as $student)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-4 font-mono font-semibold text-charcoal">{{ $student->student_id }}</td>
                                <td class="py-4 px-4 font-bold text-charcoal">{{ $student->name }}</td>
                                <td class="py-4 px-4 text-slateblue font-medium">{{ $student->course }}</td>
                                <td class="py-4 px-4 font-extrabold text-charcoal text-right">{{ number_format((float) $student->gpa, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slateblue">No student GPA records available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>