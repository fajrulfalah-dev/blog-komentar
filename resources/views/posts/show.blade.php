<x-app-layout>
    <x-slot name="title">{{ $post->judul }}</x-slot>

    {{-- Artikel --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">

        {{-- Gambar Header --}}
        @if($post->gambar)
            <img src="{{ asset('storage/' . $post->gambar) }}"
                 class="w-full h-64 object-cover">
        @endif

        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $post->judul }}</h1>

            <div class="flex items-center gap-3 text-sm text-gray-400 mb-6">
                <span>👤 {{ $post->user->name }}</span>
                <span>•</span>
                <span>🕐 {{ $post->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span>💬 {{ $post->comments->count() }} komentar</span>
            </div>

            <hr class="mb-6">

            <div class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                {{ $post->isi }}
            </div>
        </div>
    </div>

    {{-- Section Komentar --}}
    <div class="bg-white rounded-2xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            💬 Komentar ({{ $post->comments->count() }})
        </h2>

        {{-- Form Komentar --}}
        @auth
            <form action="/comments" method="POST" class="mb-8">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="isi" rows="3" placeholder="Tulis komentar kamu..."
                    class="w-full border border-gray-200 rounded-xl p-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 resize-none">{{ old('isi') }}</textarea>
                @error('isi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="mt-3 bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-indigo-700">
                    Kirim Komentar
                </button>
            </form>
        @endauth

        @guest
            <div class="bg-indigo-50 rounded-xl p-4 mb-8 text-center">
                <p class="text-gray-600 text-sm">
                    <a href="/login" class="text-indigo-600 font-medium hover:underline">Login</a>
                    dulu untuk bisa berkomentar 😊
                </p>
            </div>
        @endguest

        {{-- Daftar Komentar --}}
        @forelse($post->comments as $comment)
            <div class="flex gap-4 py-4 border-b last:border-0">
                {{-- Avatar --}}
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-indigo-600 font-bold text-sm">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </span>
                </div>

                {{-- Isi Komentar --}}
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-gray-800 text-sm">
                                {{ $comment->user->name }}
                            </span>
                            <span class="text-gray-400 text-xs ml-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>

                        @auth
                            @if($comment->user_id === auth()->id())
                                <form action="/comments/{{ $comment->id }}" method="POST"
                                      onsubmit="return confirm('Hapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 text-xs hover:underline">Hapus</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                    <p class="text-gray-600 text-sm mt-1">{{ $comment->isi }}</p>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-400">
                <p class="text-3xl mb-2">💬</p>
                <p class="text-sm">Belum ada komentar. Jadilah yang pertama!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        <a href="/" class="text-indigo-600 text-sm hover:underline">← Kembali ke semua post</a>
    </div>
</x-app-layout>