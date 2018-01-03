<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
    }

    public function view($slug)
    {
        $conversation = Conversation::where('slug', $slug)
            ->with('categories')
            ->where('published', 1)
            ->where('created_at', '<=', Carbon::now())
            ->first();

        if (!$conversation) {
            abort(404, 'The conversation as not found.');
        }

        return view('minimal.pages.conversations.conversation-view')
            ->with('conversation', $conversation);
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
