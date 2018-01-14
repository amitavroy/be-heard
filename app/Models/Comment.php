<?php

namespace App\Models;

use App\Models\Presenters\CommonPresenter;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Comment extends BaseModel
{
    use CommonPresenter;

    protected $touches = ['commentable'];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function isOwner()
    {
        return ($this->user_id === Auth::user()->id) ? true : false;
    }

    public static function getLatestCommentsOfUser($user, $count = 10)
    {
        return static::where('created_at', '<=', Carbon::now())
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->limit($count)
            ->get();
    }
}
