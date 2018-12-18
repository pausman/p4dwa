@extends('layouts.master')


@section('content')

    <h2> Current Reservations for EIC Visitor Day</h2>

    <!-- show a list of all your reservations -->
    @foreach ($visitors as $visitor)
        <div class="panel-groupr">
            <div class="panel-body groupinfo">Group Name: {{$visitor->group_name}} </div>
            <div class="panel-body groupinfo">Group Size: {{ $visitor->group_size}} </div>
            <div class="panel-body groupinfo">
                <div class="panel-body boats">Boat Schedule:</div>
                <div class="col-sm-6 boats">
                    From {{$visitor['schedules'][0]->departure_location}} at
                    {{ \Carbon\Carbon::parse($visitor['schedules'][0]->departure_time)->format('g:i a')}}
                    <br>
                </div>
                <div class="col-sm-6 boats">
                    From {{$visitor['schedules'][1]->departure_location}} at
                    {{ \Carbon\Carbon::parse($visitor['schedules'][1]->departure_time)->format('g:i a')}}
                    <br>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href='/visitors/{{ $visitor->id }}'> View Details</a>
        <p>

    @endforeach
@endsection
