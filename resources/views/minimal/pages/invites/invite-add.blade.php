@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Invite users</h1></div>
                <div class="panel-body">
                    <form action="{{route('invite.add')}}" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="emails">Email address</label>
                            <textarea name="emails" id="emails" cols="30" rows="10" class="form-control"></textarea>
                            <span class="bh help-text">You can enter one email address per line</span>
                        </div>

                        <button class="btn btn-primary">
                            Send
                        </button>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection