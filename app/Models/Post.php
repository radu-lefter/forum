<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    //create belongs to relationship with users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //create belongs to relationship with comments
    public function comments(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
