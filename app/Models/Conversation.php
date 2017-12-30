<?php

namespace App\Models;

use App\User;

class Conversation extends BaseModel
{
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'conversation_categories');
    }
}
