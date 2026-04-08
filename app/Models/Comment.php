<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'isi',
        'user_id',
        'post_id'
    ];

    // Komentar milik satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Komentar milik satu post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}