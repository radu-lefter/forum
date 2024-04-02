<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    //create belongs to relationship with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //create belongs to relationship with post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
