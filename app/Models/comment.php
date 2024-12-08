<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class comment extends Model
{
    protected $table = 'comment';

    public function album(): BelongsTo
    {
        return $this->belongsTo(album::class, 'album_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
