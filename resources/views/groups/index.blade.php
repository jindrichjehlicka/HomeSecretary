@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($groups as $group)
                    <h1>{{$group->name}}</h1>

                @endforeach
            </div>
        </div>
    </div>
@endsection
