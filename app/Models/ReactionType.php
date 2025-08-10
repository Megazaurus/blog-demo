<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ReactionType extends Model
{
    protected $fillable = [
        'name',
        'emoji',
        'description',
    ];

    public function userReactions(): HasMany
    {
        return $this->hasMany(UserReaction::class);
    }
}
