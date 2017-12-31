@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h2>Categories</h2>
            <div class="categories">
                @foreach($categogies as $categogy)
                    <div class="category">
                        <h3>{{$categogy->name}}
                            <small>{{$categogy->conversations->count()}} posts</small>
                        </h3>
                        <p>{{$categogy->description}}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="conversations">
                <h2>Latest posts</h2>
                @foreach($conversations as $conversation)
                    <div class="conversation teaser">
                        <span class="author">{!! $conversation->author->profilePic() !!}</span>
                        <h3>{{$conversation->title}}</h3>
                        <p>{{$conversation->body}}</p>
                        <ul>
                            @foreach($conversation->categories as $category)
                                <li>{{$category->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection