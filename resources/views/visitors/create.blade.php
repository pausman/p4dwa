@extends('layouts.master')


@section('content')

    <h2> Create Your Reservation for EIC Visitor Day </h2>
    <div class="row">
        <div class="col-sm-6">
            <form method='POST' action='/visitors'>
                @if(count($errors) > 0)
                    <div class='alertmsg'>
                        Please correct the errors below.
                    </div>
                @endif
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for='groupname'>* Group Name: </label>
                    <input type='text'
                           name='groupname'
                           id='groupname'
                           size='30'
                           value='{{ old('groupname') }}'>
                    @include('modules.fielderrormsg', ['field' => 'groupname'])
                </div>
                <div class="form-group row">
                    <label for='groupsize'>* Group Size (max 15): </label>
                    <input type='number'
                           name='groupsize'
                           id='groupsize'
                           value='{{ old('groupsize') }}'>
                    @include('modules.fielderrormsg', ['field' => 'groupsize'])
                </div>
                @include('modules.fielderrormsg', ['field' => 'boattimes'])
                <div class="form-group row">
                    <label for='toschedule_id'>* Boat departing from the Mainland: </label>
                    <select name='toschedule_id'>
                        <option value=''>Choose one...</option>
                        @foreach($toschedules as $toschedule)
                            <option
                                    value='{{ $toschedule->id }}'
                                    {{ (old('toschedule_id') ==
                                    $toschedule->id) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($toschedule->departure_time)->format('g:i a' )}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for='toschedule_id'>* Boat returning to the Mainland: </label>

                    <select name='fromschedule_id'>
                        <option value=''>Choose one...</option>
                        @foreach($fromschedules as $fromschedule)
                            <option
                                    value='{{ $fromschedule->id }}'
                                    {{ (old('fromschedule_id') ==
                                    $fromschedule->id) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($fromschedule->departure_time)->format('g:i a') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <input type='submit' value='Save changes' class='btn btn-success'>
                </div>
            </form>
            <form method='GET' action='/visitors'>
                <div class="form-group row">
                    <input type='submit' value='Cancel' class='btn btn-warning'>
                </div>
            </form>
            <div class='alertmsg'> * required field</div>
        </div>
        <div class="col-sm-6">
            <table class="table table-sm table-bordered table-striped">
                <thead class="thead-dark">
                <tr>
                <th colspan="3">Schedule for reference</th>
                </tr>
                <tr>
                    <th scope="col">Departure Time</th>
                    <th scope="col">Departure Location</th>
                    <th scope="col">Available Capacity</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($allschedules as $schedule)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i a' )}}</td>
                        <td>{{$schedule->departure_location}}</td>
                        <td>{{$schedule->remaining_capacity}}</td>
                    </tr>
                @endforeach
                </tbody>
        </div>
    </div>
@endsection
