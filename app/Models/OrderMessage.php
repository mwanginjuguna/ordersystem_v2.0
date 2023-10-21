<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_id', 'message', 'seen', 'approved', 'send_to_writer', 'send_to_client'
    ];
}
