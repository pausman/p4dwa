@extends('layouts.master')


@section('content')
    <h2> Create a boat </h2>
    <form method='POST' action='/boats'>
    {{csrf_field()}}
        <div class="form-group">
            <input type='text' name='name' placeholder='Rowrowrowaboat' maxlength="40">
        </div>
        <div class="form-group">
            <input type='number' name='capacity' placeholder=1 min="1" max="25">
        </div>
        <div class="form-group">
            <input type='submit' class="btn btn-primary" id='theButton' value='Add a boat'>
        </div>

    </form>

@endsection