<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('minimal.pages.profile.profile-index');
    }

    public function recentActivities()
    {
        $user = Auth::user();

        $conversations = Conversation::getConversationsByUser($user, 5);
        $comments = Comment::getLatestCommentsOfUser($user, 5);

        return view('minimal.pages.profile.recent-activity')
            ->with('user', $user)
            ->with('conversations', $conversations)
            ->with('comments', $comments);
    }

    public function getChangePassword()
    {
        return view('minimal.pages.profile.change-password');
    }
}
