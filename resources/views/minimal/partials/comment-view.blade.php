<div class="comment-container" id="{{$comment->id}}">
    <div class="meta">
        Created {{$comment->timeAgo()}} by {{$comment->user->name}}
    </div>

    <div class="body">
        {!! $comment->body  !!}
    </div>
</div>