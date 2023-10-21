<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'name', 'type', 'location', 'uploaded_by', 'show_client', 'show_writer'];

    public function order() {
        $this->belongsTo(Order::class);
    }
}
