<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class genre_album extends Model
{
    protected $table = 'genre_album';

    public function genre(): BelongsTo
    {
        return $this->belongsTo(genre::class, 'genre_id');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(album::class, 'album_id');
    }
}
