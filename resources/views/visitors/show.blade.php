@extends('layouts.master')


@section('content')

    <h2> Welcome to the Reservation System for EIC Visitor Day </h2>

    @foreach ($visitors as $visitor)
        <div class="panel-group">

            <div class="panel-body groupinfo">Group Name: {{$visitor->group_name}} </div>

            <div class="panel-body groupinfo">Group Size: {{ $visitor->group_size}} </div>

            <div class="panel-body">
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

        <a class="btn btn-primary" href='/visitors/{{ $visitor->id }}/edit'> Edit</a>
        <a class="btn btn-danger" href='/visitors/{{ $visitor->id }}/delete'> Delete</a>

    @endforeach

@endsection
