@extends('layouts.master')


@section('content')
    <ul>
        @foreach ($visitors as $visitor)
            <li> {{$visitor->group_leader_name}} with size {{ $visitor->group_size}} </li>
            <ul>
                <li> {{$visitor->email}}</li>
            </ul>
        @endforeach
    </ul>

@endsection