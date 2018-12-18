@extends('layouts.master')


@section('content')

    <h2> Your Reservation for EIC Visitor Day </h2>

    <!-- form to edit a reservation -->
    <div class="row">
        <div class="col-sm-6">
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
                           value='{{ old('groupname', $visitor->group_name) }}'
                           required>
                    @include('modules.fielderrormsg', ['field' => 'groupname'])
                </div>
                <div class="form-group row">
                    <label for='groupsize'>* Group Size (max 15): </label>
                    <input type='number'
                           name='groupsize'
                           id='groupsize'
                           required
                           value='{{ old('groupsize', $visitor->group_size) }}'>
                    @include('modules.fielderrormsg', ['field' => 'groupsize'])
                </div>
                @include('modules.fielderrormsg', ['field' => 'boattimes'])
                <div class="form-group row">
                    <label for='tochedule_id'>* Boat departing from the Mainland: </label>
                    <select name='toschedule_id' id='tochedule_id'required>
                        <option
                                value='{{$visitor->schedules[0]->id}}'>{{\Carbon\Carbon::
                            parse( $visitor->schedules[0]->departure_time)->format('g:i a')}}
                        </option>
                        @foreach($toschedules as $toschedule)
                            <option
                                    value='{{ $toschedule->id }}'
                                    {{ (old('toschedule_id', $visitor->schedules[0]->id) ==
                                    $toschedule->id) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($toschedule->departure_time)->format('g:i a' )}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row" required>
                    <label for='fromschedule_id'>* Boat returning to the Mainland: </label>
                    <select name='fromschedule_id' id='fromschedule_id'>
                        <option
                                value='{{$visitor->schedules[1]->id}}'>
                            {{\Carbon\Carbon::parse( $visitor->schedules[1]->departure_time)->format('g:i a')}}
                        </option>
                        @foreach($fromschedules as $fromschedule)
                            <option
                                    value='{{ $fromschedule->id }}'
                                    {{ (old('fromschedule_id', $visitor->schedules[1]->id) ==
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
            <form method='GET' action='/visitors/{{ $visitor->id }}'>
                <div class="form-group row">
                    <input type='submit' value='Cancel' class='btn btn-warning'>
                </div>
            </form>
            <div class='alertmsg'> * signifies a required field</div>
        </div>

        <!-- put up a list of boat runs and remaining capacity to help with selecting timess -->
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
            </table>
        </div>
    </div>
@endsection
