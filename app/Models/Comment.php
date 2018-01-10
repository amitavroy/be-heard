<?php

namespace App\Models;

class Comment extends BaseModel
{
    public function commentable()
    {
        return $this->morphTo();
    }
}
