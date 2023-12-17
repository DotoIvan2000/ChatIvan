<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'types';

    protected $fillable = [
        'name',
        'str',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Type::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Type::class, 'parent_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
