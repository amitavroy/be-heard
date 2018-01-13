<div class="conversation teaser">
    <div class="clearfix">
        <span class="author pull-left">{!! $conversation->author->profilePic() !!}</span>
        <h3>
            <a href="{{route('conversation.view', $conversation->slug)}}">{{$conversation->title}}</a>
        </h3>
    </div>
    <ul class="categories">
        @foreach($conversation->categories as $category)
            <li>{{$category->name}}</li>
        @endforeach
    </ul>
</div>