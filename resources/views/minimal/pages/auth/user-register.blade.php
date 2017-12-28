@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-md-push-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Register</h1></div>
                <div class="panel-body">
                    <form action="{{route('register.save')}}" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="email">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            <span class="bh error">{{$errors->first('name')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" value="{{$invite->email}}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <span class="bh error">{{$errors->first('password')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="password">Confirm password</label>
                            <input type="password" name="c_password" id="c_password" class="form-control">
                            <span class="bh error">{{$errors->first('c_password')}}</span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">
                                Register
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection