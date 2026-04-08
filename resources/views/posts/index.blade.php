<x-app-layout>
    <x-slot name="title">BlogKu — Semua Post</x-slot>

    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di BlogKu ✍️</h1>
        <p class="text-gray-500 mt-2">Tempat berbagi cerita dan ilmu</p>
    </div>

    {{-- Daftar Post --}}
    @forelse($posts as $post)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition mb-6 overflow-hidden">
            <div class="flex gap-4">

                {{-- Gambar --}}
                @if($post->gambar)
                    <img src="{{ asset('storage/' . $post->gambar) }}"
                         class="w-48 h-40 object-cover flex-shrink-0">
                @else
                    <div class="w-48 h-40 bg-indigo-50 flex items-center justify-center flex-shrink-0">
                        <span class="text-4xl">📝</span>
                    </div>
                @endif

                {{-- Konten --}}
                <div class="p-5 flex flex-col justify-between flex-1">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 hover:text-indigo-600">
                            <a href="/posts/{{ $post->id }}">{{ $post->judul }}</a>
                        </h2>
                        <p class="text-gray-500 text-sm mt-2 line-clamp-2">
                            {{ Str::limit($post->isi, 120) }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <span>👤 {{ $post->user->name }}</span>
                            <span>•</span>
                            <span>🕐 {{ $post->created_at->diffForHumans() }}</span>
                            <span>•</span>
                            <span>💬 {{ $post->comments->count() }} komentar</span>
                        </div>

                        <div class="flex gap-2">
                            <a href="/posts/{{ $post->id }}"
                               class="text-indigo-600 text-sm font-medium hover:underline">
                                Baca →
                            </a>
                            @auth
                                @if($post->user_id === auth()->id())
                                    <a href="/posts/{{ $post->id }}/edit"
                                       class="text-yellow-500 text-sm hover:underline">Edit</a>
                                    <form action="/posts/{{ $post->id }}" method="POST"
                                          onsubmit="return confirm('Hapus post ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 text-sm hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-20 text-gray-400">
            <p class="text-5xl mb-4">📭</p>
            <p class="text-lg">Belum ada post.</p>
            @auth
                <a href="/posts/create"
                   class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Buat Post Pertama!
                </a>
            @endauth
        </div>
    @endforelse
</x-app-layout>