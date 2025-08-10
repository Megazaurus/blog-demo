<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class UserProfile extends Model
{

    protected $fillable = [
        'user_id',
        'surname',
        'phone',
        'education',
        'birthday',
        'sex',
        'gender',
        'status',
    ];
    protected $appends = ['age'];

    public function getAgeAttribute(): ?int
    {
        return $this->birthday ? Carbon::parse($this->birthday)->age : null;
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
