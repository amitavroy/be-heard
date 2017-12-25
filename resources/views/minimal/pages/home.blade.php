@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h1>Welcome {{Auth::user()->name}}</h1>
        </div>
    </div>
@endsection