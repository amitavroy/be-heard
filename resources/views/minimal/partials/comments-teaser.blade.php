<div class="comments teaser">
    <div class="clearfix">
        <span class="author pull-left">{!! $comment->user->profilePic() !!}</span>
        <h3>
            {{--{{route('conversation.view', $conversation->slug)}}--}}
            <a href="">{{$comment->body}}</a>
        </h3>
    </div>
</div>