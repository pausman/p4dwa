@extends('layouts.master')


@section('content')
DSAF
    @foreach ($schedules as $schedule)
        <li> {{$schedule->departure_location}} at  {{ \Carbon\Carbon::parse($schedule->departure_time)->format("g:i a")}} </li>
    @endforeach

@endsection