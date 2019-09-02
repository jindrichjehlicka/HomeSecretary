@extends('layouts.app')

@section('content')
    <div class="mb-3"><a href="{{ route('tasks.edit',$task) }} " class="btn btn-primary btn-lg">Edit task</a></div>
    <div class="mb-3"><a href="{{ route('tasks.destroy',$task) }} " class="btn btn-danger btn-lg">Delete task</a></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2>{{$task->name}}</h2>
                <p class="mb3">{{$task->description}}</p>
                <h6 class="card-subtitle mb-2 text-muted">Deadline: {{$task->deadline}}</h6>
                <show-location :latitude="{{$task->latitude}}" :longitude="{{$task->longitude}}"></show-location>
                <complete-task-list :task="{{$task}}" :user="{{auth()->user()}}"></complete-task-list>
            </div>
        </div>
    </div>

@endsection
