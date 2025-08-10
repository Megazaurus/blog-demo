<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class NoticeBoard extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}