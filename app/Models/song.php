<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class song extends Model
{
    protected $table = 'song';

    public function album(): BelongsTo
    {
        return $this->belongsTo(album::class, 'album_id');
    }

    public function genre(): HasManyThrough
    {
        return $this->hasManyThrough(
            genre::class,
            genre_song::class,
            'song_id',
            'id',
            'id',
            'genre_id'
        );
    }

    public function genre_song(): HasMany
    {
        return $this->hasMany(genre_song::class, 'song_id');
    }
}
