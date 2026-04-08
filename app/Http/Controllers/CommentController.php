<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Simpan komentar baru
    public function store(Request $request)
    {
        $request->validate([
            'isi'     => 'required|min:3',
            'post_id' => 'required|exists:posts,id'
        ]);

        Comment::create([
            'isi'     => $request->isi,
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);

        return redirect('/posts/' . $request->post_id)
                ->with('sukses', 'Komentar berhasil ditambahkan!');
    }

    // Hapus komentar
    public function destroy($id)
    {
        $comment = Comment::find($id);

        // Hanya pemilik yang bisa hapus
        if($comment->user_id !== Auth::id()) {
            return back()->with('error', 'Kamu tidak punya akses!');
        }

        $postId = $comment->post_id;
        $comment->delete();

        return redirect('/posts/' . $postId)
                ->with('sukses', 'Komentar berhasil dihapus!');
    }
}