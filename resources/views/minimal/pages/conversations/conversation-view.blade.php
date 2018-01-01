@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12 conversations">
            <div class="conversation">
                <h1>{{$conversation->title}}</h1>
                <div class="meta">
                    <ul class="categories">
                        @foreach($conversation->categories as $category)
                            <li>{{$category->name}}</li>
                        @endforeach
                    </ul>
                    <p>Created by {{$conversation->author->name}} on {{$conversation->timeAgo()}}</p>
                </div>
                <div class="content">
                    {!! $conversation->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection