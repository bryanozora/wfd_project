<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class genre_song extends Model
{
    protected $table = 'genre_song';

    public function genre(): BelongsTo
    {
        return $this->belongsTo(genre::class, 'genre_id');
    }

    public function song(): BelongsTo
    {
        return $this->belongsTo(song::class, 'song_id');
    }
}
