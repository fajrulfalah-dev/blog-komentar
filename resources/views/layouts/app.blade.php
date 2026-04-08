<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Blog' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-indigo-600">✍️ BlogKu</a>

            <div class="flex items-center gap-4">
                @auth
                    <a href="/posts/create"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                        + Buat Post
                    </a>
                    <span class="text-gray-600 text-sm">{{ auth()->user()->name }}</span>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="text-sm text-red-500 hover:underline">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="/login" class="text-sm text-indigo-600 hover:underline">Login</a>
                    <a href="/register"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Flash Message --}}
    <div class="max-w-4xl mx-auto px-4 mt-4">
        @if(session('sukses'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                ✅ {{ session('sukses') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Konten --}}
    <main class="max-w-4xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="text-center text-gray-400 text-sm py-6 mt-8 border-t">
        © 2026 BlogKu — Dibuat dengan ❤️ dan Laravel
    </footer>

</body>
</html>