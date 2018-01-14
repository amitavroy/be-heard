<div class="comment teaser">
    <div class="clearfix">
        <span class="author pull-left">{!! $comment->user->profilePic() !!}</span>
        <h3>
            <a href="{{route('conversation.view', $comment->commentable->slug)}}">{{$comment->body}}</a>
        </h3>
    </div>
</div>