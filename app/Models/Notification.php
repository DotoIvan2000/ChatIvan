<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notifications";
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_read',
        'path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
