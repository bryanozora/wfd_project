<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class album extends Model
{
    protected $table = 'album';
    
    public function genre(): HasManyThrough
    {
        return $this->hasManyThrough(
            genre::class,
            genre_album::class,
            'album_id',
            'id',
            'id',
            'genre_id'
        );
    }

    public function song(): HasMany
    {
        return $this->hasMany(song::class, 'album_id');
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(transaction::class, 'album_id');
    }

    public function genre_album(): HasMany
    {
        return $this->hasMany(genre_album::class, 'album_id');
    }
    
    public function comment(): HasMany
    {
        return $this->hasMany(comment::class, 'album_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class, 'artist_id');
    }
}
