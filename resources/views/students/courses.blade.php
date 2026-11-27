<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Courses — EduCore SaaS</title>
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
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue">Curriculum Registry</p>
                <h1 class="text-2xl font-extrabold text-charcoal mt-0.5">Active Courses</h1>
                <p class="text-xs text-slateblue mt-0.5">Edit course names or remove courses from enrolled records.</p>
            </div>
            <a href="{{ route('students.index') }}" class="px-4 py-2.5 bg-charcoal text-white rounded-2xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">
                &larr; Back to Dashboard
            </a>
        </div>

        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-xs font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
            <div class="p-6 border-b border-coolgrey/20">
                <h2 class="text-base font-bold text-charcoal">Registered Courses ({{ $courses->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                            <th class="py-3.5 px-4">Course</th>
                            <th class="py-3.5 px-4">Students</th>
                            <th class="py-3.5 px-4">Average GPA</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-coolgrey/10 text-xs">
                        @forelse ($courses as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-4">
                                    <form action="{{ route('courses.rename') }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="old_course" value="{{ $item->course }}">
                                        <input type="text" name="new_course" value="{{ $item->course }}" required class="px-3 py-1.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs font-bold text-charcoal">
                                        <button type="submit" class="px-3 py-1.5 bg-charcoal text-white rounded-xl text-[11px] font-bold hover:bg-charcoal/90 transition">
                                            Save
                                        </button>
                                    </form>
                                </td>
                                <td class="py-4 px-4 font-bold text-charcoal">{{ $item->student_count }}</td>
                                <td class="py-4 px-4 font-semibold text-slateblue">{{ number_format((float) $item->avg_gpa, 2) }}</td>
                                <td class="py-4 px-4 text-right">
                                    <form action="{{ route('courses.delete') }}" method="POST" class="inline" onsubmit="return confirm('Remove this course from student records?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="course" value="{{ $item->course }}">
                                        <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-xl text-[11px] font-bold hover:bg-rose-100 transition">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slateblue">No active courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>