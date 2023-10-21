<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_id', 'paypal_transaction_id', 'transaction_status',
        'paypal_payer_id', 'paypal_facilitator_access_token_id', 'transaction_debug_id',
        'transaction_message', 'transaction_name', 'payer_country_code', 'user_name',
    ];
}
