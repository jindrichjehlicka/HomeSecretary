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
                            <p class="card-text">{{$task->description}}</p>
                            <h6 class="card-subtitle mb-4 mt-2 text-muted">deadline: {{$task->deadline}}</h6>

                            <h6 class="card-subtitle mb-1 text-muted">Progress</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: {{$task->progress}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$task->progress}}%</div>
                            </div>
                            <a href="{{ route('tasks.show',$task) }} " class="card-link">Show Task</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
