<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Halaman utama — tampilkan semua post
    public function index()
    {
        $posts = Post::with('user', 'comments')
                     ->latest()
                     ->get();
        return view('posts.index', ['posts' => $posts]);
    }

    // Detail post + komentar
    public function show($id)
    {
        $post = Post::with('user', 'comments.user')->find($id);
        return view('posts.show', ['post' => $post]);
    }

    // Form buat post
    public function create()
    {
        return view('posts.create');
    }

    // Simpan post baru
    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|min:3|max:100',
            'isi'    => 'required|min:10',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $namaGambar = null;
        if($request->hasFile('gambar')) {
            $namaGambar = $request->file('gambar')
                                  ->store('gambar', 'public');
        }

        Post::create([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'gambar'  => $namaGambar,
            'user_id' => Auth::id()
        ]);

        return redirect('/')->with('sukses', 'Post berhasil dibuat!');
    }

    // Form edit post
    public function edit($id)
    {
        $post = Post::find($id);

        // Pastikan hanya pemilik yang bisa edit
        if($post->user_id !== Auth::id()) {
            return redirect('/')->with('error', 'Kamu tidak punya akses!');
        }

        return view('posts.edit', ['post' => $post]);
    }

    // Simpan perubahan post
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'  => 'required|min:3|max:100',
            'isi'    => 'required|min:10',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $post = Post::find($id);

        if($post->user_id !== Auth::id()) {
            return redirect('/')->with('error', 'Kamu tidak punya akses!');
        }

        $namaGambar = $post->gambar;
        if($request->hasFile('gambar')) {
            if($post->gambar) {
                Storage::disk('public')->delete($post->gambar);
            }
            $namaGambar = $request->file('gambar')
                                  ->store('gambar', 'public');
        }

        $post->update([
            'judul'  => $request->judul,
            'isi'    => $request->isi,
            'gambar' => $namaGambar
        ]);

        return redirect('/')->with('sukses', 'Post berhasil diupdate!');
    }

    // Hapus post
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post->user_id !== Auth::id()) {
            return redirect('/')->with('error', 'Kamu tidak punya akses!');
        }

        if($post->gambar) {
            Storage::disk('public')->delete($post->gambar);
        }

        $post->delete();
        return redirect('/')->with('sukses', 'Post berhasil dihapus!');
    }
}