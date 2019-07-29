@extends('layouts.app')

@section('content')
    <a href="{{ route('occasions.create') }} " class="btn btn-primary btn-lg">Create New Occasion</a>
    <div class="container">
        <div class="row justify-content-center">
            @foreach($occasions as $occasion)
                <div class="col-md-3 mb-3 mr-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$occasion->name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Start Date: {{$occasion->from_date}}</h6>
                            <h6 class="card-subtitle mb-2 text-muted">End Date: {{$occasion->to_date}}</h6>
                            <p class="card-text">{{$occasion->description}}</p>
                            <a href="{{ route('occasions.show',$occasion) }} " class="card-link">Show Occasion</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
