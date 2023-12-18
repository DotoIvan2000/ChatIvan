<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'profile_photo_path',
        'type_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function teamMessages()
    {
        return $this->hasMany(TeamMessage::class);
    }

    public function senders()
    {
        return $this->belongsToMany(User::class, 'messages', 'receiver_id', 'sender_id');
    }

    public function receivers()
    {
        return $this->belongsToMany(User::class, 'messages', 'sender_id', 'receiver_id');
    }

    public function pendingApproves()
    {
        return $this->hasMany(PendingApprove::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'followee_id', 'id');
    }

    public function followees()
    {
        return $this->hasMany(Follower::class, 'follower_id', 'id');
    }

    public function scopeFilterUsers($query, $filter)
    {
        return $query->where(function ($query) use ($filter) {
            $query->where('email', 'LIKE', '%'.$filter.'%')
                ->orWhere('username', 'LIKE', '%'.$filter.'%')
                ->orWhere('first_name', 'LIKE', '%'.$filter.'%')
                ->orWhere('last_name', 'LIKE', '%'.$filter.'%');
        });
    }
}
