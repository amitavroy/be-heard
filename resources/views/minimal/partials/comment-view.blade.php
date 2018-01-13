<div class="comment-container" id="{{$comment->id}}">
    <div class="meta">
        Created {{$comment->timeAgo()}} by <strong>{{$comment->user->name}}</strong>

        @if($comment->isOwner())
            <span class="pull-right">
                <a href="javascript:void(0);"
                   onclick="window.eventBus.$emit('editReplyEvent', {{$comment->id}});"
                   class="inline-links">Edit</a>
                <a href="#" class="inline-links">Delete</a>
            </span>
        @endif
    </div>

    <div class="body">
        {!! parseMarkdown($comment->body) !!}
    </div>
</div>