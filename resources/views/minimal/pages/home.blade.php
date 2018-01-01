@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="top-menu">
                <ul>
                    <li>
                        <a href="#" class="btn btn-default">New</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                           onclick="window.eventBus.$emit('addNewConversationEvent');"
                           class="btn btn-default">New conversation</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

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
                    @include('minimal.partials.conversation-teaser')
                @endforeach
            </div>
        </div>
    </div>
@endsection