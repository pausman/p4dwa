@extends('layouts.master')

@section('content')
    <h2>Register</h2>


    <div class="container">
        <form method='POST' action='{{ route('register') }}'>
            {{ csrf_field() }}
            <div class="form-group row">
                <label for='name' class="col-sm-2 col-form-label">Name</label>
                <input id='name' type='text' name='name' value='{{ old('name') }}' required autofocus>
                @include('modules.fielderrormsg', ['field' => 'name'])
            </div>
            <div class=" form-group row">
                <label for='email' class="col-sm-2 col-form-label">E-Mail Address</label>
                <input id='email' type='email' name='email' value='{{ old('email') }}' required>
                @include('modules.fielderrormsg', ['field' => 'email'])
            </div>
            <div class=" form-group row">
                <label for='password' class="col-sm-2 col-form-label">Password (min: 6)</label>
                <input id='password' type='password' name='password' required>
                @include('modules.fielderrormsg', ['field' => 'password'])
            </div>
            <div class=" form-group row">
                <label for='password-confirm' class="col-sm-2 col-form-labe" l>Confirm Password</label>
                <input id='password-confirm' type='password' name='password_confirmation' required>
            </div>
            <button type='submit' class='btn btn-primary'>Register</button>
        </form>
    </div>
    <p class=" lead">
        Already have an account? <a href='/login'>Login here...</a>
    </p>

@endsection