@extends('layouts.master')


@section('content')

    <h2> Your Reservation for EIC Visitor Day </h2>

    <form method='POST' action='/visitors/{{ $visitor->id }}'>
        @if(count($errors) > 0)
            <div class='alertmsg'>
                Please correct the errors below.

            </div>
        @endif

        {{ method_field('put') }}
        {{ csrf_field() }}
        <div class="form-group row">
            <label for='groupname'>* Group Name: </label>
            <input type='text'
                   name='groupname'
                   id='groupname'
                   size='30'
                   value='{{ old('groupname', $visitor->group_name) }}'>
            @include('modules.fielderrormsg', ['field' => 'groupname'])
        </div>
        <div class="form-group row">
            <label for='groupsize'>* Group Size (max 15): </label>
            <input type='number' name='groupsize' id='groupsize' value='{{ old('groupsize', $visitor->group_size) }}'>
            @include('modules.fielderrormsg', ['field' => 'groupsize'])
        </div>
            @include('modules.fielderrormsg', ['field' => 'boattimes'])
        <div class="form-group row">
            <label for='toschedule_id'>* Boat departing from the Mainland: </label>
            <select name='toschedule_id'>
                <option value='{{$visitor->schedules[0]->id}}'>{{\Carbon\Carbon::parse( $visitor->schedules[0]->departure_time)->format('g:i a')}}</option>
                @foreach($toschedules as $toschedule)

                    <option value='{{ $toschedule->id }}' {{ (old('toschedule_id', $visitor->schedules[0]->id) == $toschedule->id) ? 'selected' : '' }}>{{ \Carbon\Carbon::parse($toschedule->departure_time)->format('g:i a' )}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label for='toschedule_id'>* Boat returning to the Mainland: </label>
            <select name='fromschedule_id'>
                <option value='{{$visitor->schedules[1]->id}}'>{{\Carbon\Carbon::parse( $visitor->schedules[1]->departure_time)->format('g:i a')}}</option>
                @foreach($fromschedules as $fromschedule)

                    <option value='{{ $fromschedule->id }}' {{ (old('fromschedule_id', $visitor->schedules[1]->id) == $fromschedule->id) ? 'selected' : '' }}>{{ \Carbon\Carbon::parse($fromschedule->departure_time)->format('g:i a') }}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group row">

            <input type='submit' value='Save changes' class='btn btn-success'>
    </form>
    <br>
    <form mmethod='GET' action='/visitors/{{ $visitor->id }}'>
        {{ csrf_field() }}
        </div>
        <div class="form-group row">
            <input type='submit' value='Cancel' class='btn btn-warning'>
        </div>
    </form>
    <div class='alertmsg'> * means a required field</div>




@endsection
