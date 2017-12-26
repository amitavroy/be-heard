@extends('minimal.templates.html')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            @if(count($invites) === 0)
                <div class="no-result-content">
                    <p>You have not invited anyone yet. <a href="{{route('invite.add')}}">Click here</a></p>
                </div>
            @endif

            @unless(count($invites) === 0)
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Users I have invited</h1></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{{route('invite.add')}}" class="btn btn-primary">Invite</a>
                        </div>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Expires on</th>
                                <th>Used</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($invites as $invite)
                                <tr>
                                    <td>{{$invite->id}}</td>
                                    <td>{{$invite->email}}</td>
                                    <td>{{$invite->expire_at->format('Y/m/d H:m:s')}}</td>
                                    <td>{{($invite->used == '0') ? 'No' : 'Yes'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$invites->render()}}
            @endunless

        </div>
    </div>
@endsection