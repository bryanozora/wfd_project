<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class genre extends Model
{
    protected $table = 'genre';

    public function album(): HasManyThrough
    {
        return $this->hasManyThrough(
            album::class,
            genre_album::class,
            'genre_id',
            'id',
            'id',
            'album_id'
        );
    }

    public function song(): HasManyThrough
    {
        return $this->hasManyThrough(
            song::class,
            genre_song::class,
            'genre_id',
            'id',
            'id',
            'song_id'
        );
    }

    public function genre_album(): HasMany
    {
        return $this->hasMany(genre_album::class, 'genre_id');
    }

    public function genre_song(): HasMany
    {
        return $this->hasMany(genre_song::class, 'genre_id');
    }
}
