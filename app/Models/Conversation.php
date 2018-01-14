<?php

namespace App\Models;

use App\Models\Presenters\CommonPresenter;
use App\User;
use Carbon\Carbon;

class Conversation extends BaseModel
{
    use CommonPresenter;

    public function author()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'conversation_categories');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->orderBy('created_at', 'desc');
    }

    public static function getConversations($count = 10)
    {
        return static::conversationQuery()
            ->with('author')
            ->with('categories')
            ->limit($count)
            ->get();
    }

    public static function getConversationsByUser($user, $count = 10)
    {
        return static::where('published', 1)
            ->where('created_at', '<=', Carbon::now())
            ->where('creator', $user->id)
            ->orderBy('sticky', 'desc')
            ->orderBy('updated_at', 'desc')
            ->with('author')
            ->with('categories')
            ->limit($count)
            ->get();
    }

    public static function conversationQuery()
    {
        return static::where('published', 1)
            ->where('created_at', '<=', Carbon::now())
            ->orderBy('sticky', 'desc')
            ->orderBy('updated_at', 'desc');
    }
}
