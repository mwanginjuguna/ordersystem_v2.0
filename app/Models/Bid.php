<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'bid_message', 'assigned'];

    /**
     * Writer
     */
    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
