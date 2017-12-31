<?php

namespace App\Models;

use App\User;

class Conversation extends BaseModel
{
    public function author()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'conversation_categories');
    }

    public static function dashboardList($count = 10)
    {
        return static::conversationQuery()
            ->with('author')
            ->with('categories')
            ->orderBy('sticky', 'desc')
            ->orderBy('updated_at')
            ->limit($count)
            ->get();
    }

    public static function conversationQuery()
    {
        return static::where('published', 1);
    }
}
