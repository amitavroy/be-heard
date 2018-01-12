<div class="comment-container" id="{{$comment->id}}">
    <div class="meta">
        Created {{$comment->timeAgo()}} by <strong>{{$comment->user->name}}</strong>
    </div>

    <div class="body">
        {!! $comment->body  !!}
    </div>
</div>