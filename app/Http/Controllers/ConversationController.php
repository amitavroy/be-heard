<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
            abort(404, 'The conversation was not found.');
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

        // assuming the validation will check if the id is present
        $conversation = Conversation::find($postData['conversationId']);

        $comment = $conversation->comments()->create([
            'body' => $postData['body'],
            'user_id' => Auth::user()->id,
        ]);

        return response($comment, 200);
    }

    public function getCommentById(Request $request)
    {
        $postData = $request->validate([
            'commentId' => 'required|exists:comments,id',
        ]);

        $comment = Comment::find($postData['commentId']);

        return response($comment, 200);
    }

    public function updateCommentById(Request $request)
    {
        $postData = $request->validate([
            'commentId' => 'required|exists:comments,id',
            'body' => 'required|min:10',
        ]);

        $comment = Comment::find($postData['commentId']);

        if ($comment->user_id !== Auth::user()->id) {
            $userId = Auth::user()->id;
            \Log::info("User {$userId} managed to try and edit other user comment");
            return response($comment, 200);
        }

        $comment->body = $postData['body'];
        $comment->save();

        return response($comment, 201);
    }
}
