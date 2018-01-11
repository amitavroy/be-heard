<?php

namespace App\Models;

use App\Models\Presenters\CommonPresenter;
use App\User;

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
}
