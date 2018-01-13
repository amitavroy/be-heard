@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Profile</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#recent-activity" aria-controls="recent-activity" role="tab" data-toggle="tab">Recent activity</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My profile</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Change password</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="recent-activity">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>List of conversation user started</p>
                        </div>
                        <div class="col-sm-6">
                            <p>List of comments user added</p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>User's profile page</p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>A form for the user to change his/her password.</p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Some common settings for the user. We can look at this later.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection