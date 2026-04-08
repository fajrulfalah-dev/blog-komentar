<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'user_id'
    ];

    // Post milik satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Post punya banyak komentar
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}