<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [PostController::class, 'index']);

// PENTING: /posts/create harus di atas /posts/{id}
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    });

    // Post — create WAJIB di atas {id}!
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    // Komentar
    Route::post('/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
});

// Ini di BAWAH middleware group tapi TETAP setelah /posts/create
Route::get('/posts/{id}', [PostController::class, 'show']);

require __DIR__.'/auth.php';