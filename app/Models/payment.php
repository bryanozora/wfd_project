<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class payment extends Model
{
    protected $table = 'payment';

    public function transaction(): BelongsTo 
    {
        return $this->belongsTo(transaction::class, 'transaction_id');
    }
}
