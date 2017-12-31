<?php

namespace App\Models;

class Category extends BaseModel
{
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_categories');
    }

    public static function dashboardListing()
    {
        return static::categoryQuery()
            ->orderBy('name', 'desc')
            ->with('conversations')
            ->get();
    }

    public static function categoryQuery()
    {
        return static::where('is_active', 1);
    }
}
