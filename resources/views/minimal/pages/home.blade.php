@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h1>Welcome {{Auth::user()->name}}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            @foreach($categogies as $categogy)
                <ul>
                    <li>{{$categogy->name}}</li>
                </ul>
                @endforeach
        </div>
        <div class="col-md-6 col-sm-12"></div>
    </div>
@endsection