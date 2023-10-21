<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'chat_id',
        'recipient_id',
        'recipient_department',
        'message',
        'is_read'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $to;

    /**
     * Get the sender of the message.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the chat of the message.
     * @return BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Get receiver
     * @return User|null
     */
    public function recipient(): User | null
    {
        // update look into the current message instance, return the value assigned to the 'to' column, and return that value.
        // use the returned value (from `to` column, to resolve the user
        // dd($this->to);
        return User::find($this->to);
    }
}
