@extends('layouts.app')

@section('content')
  <a href="{{ route('tasks.create') }} " class="btn btn-primary btn-lg">Create New Task</a>

    <div class="container">
        <div class="row justify-content-center">
            @foreach($tasks as $task)
                <div class="col-md-3 mb-3 mr-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$task->name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">deadline: {{$task->deadline}}</h6>
                            <p class="card-text">{{$task->description}}</p>

                            <a href="{{ route('tasks.show',$task) }} " class="card-link">Show Task</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
