@extends('layouts.master')


@section('content')
    <h2> Create a visitor </h2>
    <form method='POST' action='/visitors'>
        {{csrf_field()}}
        <div class="form-group">
            <input type='text' name='group_leader_name'>
        </div>
        <div class='form-group'>
            <input type='email' name='email'>
        </div>
        <div class="form-group">
            <input type='number' name='group_size' placeholder=1 min="1" max="25">
        </div>

        <div class="form-group">
            <input type='submit' class="btn btn-primary" id='theButton' value='Add a visitor'>
        </div>

    </form>

@endsection