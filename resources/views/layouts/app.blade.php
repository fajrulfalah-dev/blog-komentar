<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BlogKu')</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-800 antialiased bg-slate-50 relative flex flex-col min-h-screen w-full overflow-x-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-[30rem] h-[30rem] bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse -z-10"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[30rem] h-[30rem] bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -z-10"></div>

    {{-- Navbar Glassmorphism --}}
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-slate-200/50 shadow-sm transition-all">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-black tracking-tight text-slate-800 hover:opacity-80 transition-opacity">
                Blog<span class="text-blue-600">Ku</span> ✍️
            </a>

            <div class="flex items-center gap-5">
                @auth
                    <a href="/posts/create"
                       class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold shadow-md shadow-blue-200 hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all active:scale-95 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Post
                    </a>
                    
                    <span class="text-slate-600 font-medium text-sm hidden sm:block border-l border-slate-300 pl-5">
                        Halo, {{ auth()->user()->name }}
                    </span>
                    
                    <form action="/logout" method="POST" class="m-0 p-0">
                        @csrf
                        <button class="text-sm font-medium text-slate-500 hover:text-red-500 transition-colors">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="/login" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Login</a>
                    <a href="/register"
                       class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold shadow-md shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all active:scale-95 text-sm">
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Flash Message (Desain Toast Modern) --}}
    <div class="max-w-4xl mx-auto w-full px-4 mt-6 relative z-10">
        @if(session('sukses'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-5 py-4 rounded-2xl shadow-sm flex items-center gap-3 mb-4">
                <span class="bg-emerald-100 text-emerald-600 p-1.5 rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
                <p class="font-medium text-sm">{{ session('sukses') }}</p>
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-50 border border-red-100 text-red-800 px-5 py-4 rounded-2xl shadow-sm flex items-center gap-3 mb-4">
                <span class="bg-red-100 text-red-600 p-1.5 rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </span>
                <p class="font-medium text-sm">{{ session('error') }}</p>
            </div>
        @endif
    </div>

    {{-- Konten Utama (flex-grow agar memenuhi ruang kosong) --}}
    <main class="max-w-4xl mx-auto w-full px-4 py-8 flex-grow relative z-10">
        {{ $slot }}
    </main>

    {{-- Footer Bersih --}}
    <footer class="text-center text-slate-500 text-sm py-8 mt-auto border-t border-slate-200/60 bg-white/30 backdrop-blur-sm relative z-10">
        <p class="font-medium">© 2026 BlogKu — Dibuat dengan <span class="text-red-500"></span> dan Laravel</p>
    </footer>

</body>
</html>