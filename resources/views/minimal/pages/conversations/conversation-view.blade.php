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

    <div class="row">
        <div class="col-sm-12">
            <div class="top-menu">
                <ul>
                    <li>
                        <a href="#" class="btn btn-default">New</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                           onclick="window.eventBus.$emit('addNewReplyEvent', {{$conversation->id}});"
                           class="btn btn-default">New conversation</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h2>Comments</h2>
            @if(count($conversation->comments) > 0)
                @foreach($conversation->comments as $comment)
                    @include('minimal.partials.comment-view')
                @endforeach
                @else
                <p>No comments yet. Be the first to drop a comment.</p>
            @endif
        </div>
    </div>
@endsection