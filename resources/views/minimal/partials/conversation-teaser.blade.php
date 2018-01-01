<div class="conversation teaser">
    <span class="author">{!! $conversation->author->profilePic() !!}</span>
    <h3>
        <a href="{{route('conversation.view', $conversation->slug)}}">{{$conversation->title}}</a>
    </h3>
    <ul class="categories">
        @foreach($conversation->categories as $category)
            <li>{{$category->name}}</li>
        @endforeach
    </ul>
</div>