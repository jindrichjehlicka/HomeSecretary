@extends('layouts.app')

@section('content')
    <edit-task :task="{{$task}}"></edit-task>

@endsection
