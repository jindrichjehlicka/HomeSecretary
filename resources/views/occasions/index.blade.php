@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($occasions as $occasion)
                    <h1>{{$occasion->name}}</h1>

                @endforeach
            </div>
        </div>
    </div>
@endsection
