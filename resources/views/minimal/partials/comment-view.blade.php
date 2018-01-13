<div class="comment-container" id="{{$comment->id}}">
    <div class="meta">
        Created {{$comment->timeAgo()}} by <strong>{{$comment->user->name}}</strong>

        <div class="controls">
            @if($comment->isOwner())
                <span class="pull-right">
                <a href="javascript:void(0);"
                   onclick="window.eventBus.$emit('editReplyEvent', {{$comment->id}});"
                   class="inline-links">Edit comment</a>
                <a href="#" class="inline-links">Delete comment</a>
            </span>
            @endif
        </div>
    </div>

    <div class="body">
        {!! parseMarkdown($comment->body) !!}
    </div>
</div>