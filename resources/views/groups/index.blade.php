@extends('layouts.app')

@section('content')
    <a href="{{ route('groups.create') }} " class="btn btn-primary btn-lg">Create New Group</a>
    <div class="container">
        <div class="row justify-content-center">
            @foreach($groups as $group)
                <div class="col-md-3 mb-3 mr-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$group->name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Group admin: {{$admins[$group->id]->name}}</h6>
                            <p class="card-text">{{$group->description}}</p>
                            <a href="#" class="card-link">View group</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
