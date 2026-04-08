<x-app-layout>
    <x-slot name="title">Buat Post Baru</x-slot>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">✍️ Buat Post Baru</h1>

        <div class="bg-white rounded-2xl shadow-sm p-8">
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        placeholder="Judul post kamu..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Isi Post</label>
                    <textarea name="isi" rows="8" placeholder="Tulis isi post kamu di sini..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 resize-none">{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Cover (opsional)
                    </label>
                    <input type="file" name="gambar" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-8 py-3 rounded-xl hover:bg-indigo-700 font-medium">
                        Publikasikan Post
                    </button>
                    <a href="/"
                        class="px-8 py-3 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>