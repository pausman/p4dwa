@extends('layouts.master')


@section('content')

    <h2> Reservation System for EIC Visitor Day </h2>

    @if ($visitors->isNotEmpty())

        <form method='GET' action='/visitors/{{ $visitors[0]->id }}'>
            <button type="submit" class="btn btn-primary">View Your Reservation</button>
        </form>
    @else
        <form method='GET' action='/visitors/create'>
            <button type="submit" class="btn btn-primary">Create a Reservation</button>
        </form>
    @endif




@endsection