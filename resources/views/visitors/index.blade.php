@extends('layouts.master')


@section('content')

    <h2> Reservation System for EIC Visitor Day </h2>

    @if ($visitors->count() > 0)

        <form method='GET' action='/visitors/{{ $visitors[0]->id }}'>
            <button type="submit" class="btn btn-primary">View Your Reservation</button>
        </form>
    @else
        <form>
            <button type="submit" class="btn btn-primary" name=' create'>Create a Reservation</button>
        </form>
    @endif




@endsection