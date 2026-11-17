<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - EduCore SaaS</title>
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
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased min-h-screen flex items-center justify-center p-6 selection:bg-slateblue/20">

    <div class="max-w-md w-full bg-white rounded-3xl border border-coolgrey/20 shadow-2xl p-8 space-y-6">
        <div class="text-center space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-charcoal mx-auto flex items-center justify-center text-white shadow-md">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </div>
            </div>
            <h2 class="text-xl font-extrabold text-charcoal">Welcome Back</h2>
            <p class="text-xs text-slateblue">Log in to your academic workspace.</p>
        </div>

        <!-- Validation Error Message Display -->
        @if ($errors->any())
            <div class="p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('auth.login.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Email Address</label>
                <input type="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="login-password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner pr-10">
                    <button type="button" onclick="togglePassword('login-password', 'login-eye-icon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slateblue hover:text-charcoal transition">
                        <svg id="login-eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
            <button type="submit" class="w-full py-3 bg-charcoal text-white rounded-xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">Log In to Dashboard</button>
        </form>

        <p class="text-center text-xs text-slateblue">
            Don't have an institution workspace? <a href="{{ route('register') }}" class="font-bold text-charcoal hover:underline">Register</a>
        </p>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === "password") {
                field.type = "text";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                field.type = "password";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</body>
</html>