@extends('layouts.master')


@section('content')
    @foreach ($boats as $boat)
        <li> {{$boat->name}} </li>
    @endforeach

@endsection