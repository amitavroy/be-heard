@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h1>Login</h1>

            <form action="{{route('login')}}" method="post">

                {{csrf_field()}}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remember"> Remember me
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection