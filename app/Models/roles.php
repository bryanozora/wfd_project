<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class roles extends Model
{
    protected $table = 'roles';

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
