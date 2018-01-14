@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Profile</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @include('minimal.partials.profile-nav')

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="messages">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>A form for the user to change his/her password.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection