@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($tasks as $task)
                    <h1>{{$task->name}}</h1>

                @endforeach
            </div>
        </div>
    </div>
@endsection
