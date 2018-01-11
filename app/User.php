<?php

namespace App;

use App\Models\Comment;
use App\Models\Conversation;
use App\Models\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, UserPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'creator');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
