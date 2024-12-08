<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class transaction extends Model
{
    protected $table = 'transaction';

    public function payment(): HasMany
    {
        return $this->hasMany(payment::class, 'transaction_id');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(album::class, 'album_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
