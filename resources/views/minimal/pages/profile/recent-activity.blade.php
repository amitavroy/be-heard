@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>My Recent activity</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @include('minimal.partials.profile-nav')

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="recent-activity">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="conversations">
                                <h2>Latest posts</h2>
                                @foreach($conversations as $conversation)
                                    @include('minimal.partials.conversation-teaser')
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="comments">
                                <h2>Latest comments</h2>
                                @foreach($comments as $comment)
                                    @include('minimal.partials.comments-teaser')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection