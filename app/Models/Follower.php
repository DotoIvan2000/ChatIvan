<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'followers';
    protected $fillable = [
        'follower_id',
        'followee_id',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id', 'id');
    }

    public function followee()
    {
        return $this->belongsTo(User::class, 'followee_id', 'id');
    }
}
