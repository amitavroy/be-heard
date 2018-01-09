<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
    }

    public function view($slug)
    {
        $conversation = Conversation::where('slug', $slug)
            ->with('categories')
            ->with('comments')
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
        $postData = $request->validate([
            'title' => 'required|min:5',
            'body' => 'required|min: 5'
        ]);

        $conversation = Conversation::create([
            'title' => $postData['title'],
            'creator' => Auth::user()->id,
            'slug' => str_slug($postData['title']),
            'body' => $postData['body'],
            'published' => 1,
            'sticky' => 0,
        ]);

        flash('Conversation was saved.', 'success');

        return response(['data' => $conversation], 201);
    }

    public function conversationReply(Request $request)
    {
        $postData = $request->validate([
            'conversationId' => 'required|exists:conversations,id',
            'body' => 'required|min:10',
        ]);

        return response($postData, 200);
    }
}
