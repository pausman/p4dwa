@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $visitor->group_name }}
@endsection

@section('content')
    <!--conformation form to delete a reservationm-->
    <h1>Confirm deletion</h1>
    <p>Are you sure you want to delete <strong>{{ $visitor->group_name }}</strong>?</p>
    <div class='row'>
        <div class="col-sm-6">
            <form method='POST' action='/visitors/{{ $visitor->id }}'>
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <input type='submit' value='Yes, delete it!' class='btn btn-danger btn-small'>
            </form>
            <p>
            <form method='GET' action='/visitors/{{ $visitor->id }}'>
                <input type='submit' value='Cancel' class='btn btn-warning'>
            </form>
        </div>
    </div>
@endsection