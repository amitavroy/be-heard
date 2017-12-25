@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-md-push-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Forgot password</h1></div>
                <div class="panel-body">
                    <form action="{{route('do-forgot-password')}}" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <span class="bh error">{{$errors->first('email')}}</span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">
                                Send Email
                            </button>

                            <a href="{{route('login')}}">Back to login</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection