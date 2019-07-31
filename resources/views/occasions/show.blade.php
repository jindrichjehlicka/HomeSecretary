@extends('layouts.app')

@section('content')
    <div class="mb-3"> <a href="{{ route('occasions.edit',$occasion) }} " class="btn btn-primary btn-lg">Edit occasion</a></div>
    <div class="mb-3"> <a href="{{ route('occasions.destroy',$occasion) }} " class="btn btn-danger btn-lg">Delete Occasion</a></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2>{{$occasion->name}}</h2>
                <p class="mb3">{{$occasion->description}}</p>
                <h6 class="card-subtitle mb-2 text-muted">Starts: {{$occasion->from_date}}</h6>
                <h6 class="card-subtitle mb-5 text-muted">Ends: {{$occasion->to_date}}</h6>
                <show-location :latitude="{{$occasion->latitude}}" :longitude="{{$occasion->longitude}}"></show-location>

            </div>
        </div>
    </div>

@endsection
