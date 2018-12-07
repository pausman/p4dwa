@extends('layouts.master')


@section('content')
    <h2> Create a schedule </h2>
    <form method='POST' action='/schedules'>
        {{csrf_field()}}
        <div class="form-group">
            <select name='departure_location'>
                <option value="Mainland">Mainland</option>
                <option value="Service Dock">Service Dock</option>
            </select>
        </div>
        <div class="form-group">
            <input type='time' name='departure_time'>
        </div>
        <div class="form-group">
            <select name='boat'>
                @foreach ($boats as $boat)
                    <option value={{$boat->name}}>{{$boat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type='submit' class="btn btn-primary" id='theButton' value='Add a schedule'>
        </div>

    </form>

@endsection