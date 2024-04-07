<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    //create belongs to relationship with users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //create belongs to relationship with comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
