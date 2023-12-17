<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'team_messages';

    protected $fillable = [
        'team_id',
        'sender_id',
        'message',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
