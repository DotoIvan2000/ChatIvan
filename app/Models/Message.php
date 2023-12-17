<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function scopeTotalMessages($query, $user_id_1, $user_id_2)
    {
        return $query->where(function ($query) use ($user_id_1, $user_id_2) {
            $query->where('sender_id', $user_id_1)
                ->where('receiver_id', $user_id_2);
        })->orWhere(function ($query) use ($user_id_1, $user_id_2) {
            $query->where('sender_id', $user_id_2)
                ->where('receiver_id', $user_id_1);
        });
    }
}
