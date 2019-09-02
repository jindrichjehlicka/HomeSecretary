@extends('layouts.app')

@section('content')
    <div class="mb-3"><a href="{{ route('groups.edit',$group) }} " class="btn btn-primary btn-lg">Edit Group</a></div>
    <div class="mb-3"><a href="{{ route('groups.destroy',$group) }} " class="btn btn-danger btn-lg">Delete Group</a>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2>{{$group->name}}</h2>
                <p class="mb5">{{$group->description}}</p>

                <h6 class="card-subtitle mt-5 mb-1 text-muted">Members</h6>
                <ul class="list-group">
                    @foreach($members as $member)
                        <li class="list-group-item">{{$member->name}}</li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>
@endsection
