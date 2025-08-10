<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AvatarImage extends Model
{
    protected $fillable = [
        'user_id',
        'img_src',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
