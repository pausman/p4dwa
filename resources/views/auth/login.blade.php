@extends('layouts.master')

@section('content')

    <h2>Login</h2>


    <div class="container">
        <form method='POST' action='{{ route('login') }}'>

            {{ csrf_field() }}
            <div class="form-group row">
                <label for='email' class="col-sm-2 col-form-label">E-Mail Address</label>
                <input id='email' type='email' name='email' value='{{ old('email') }}' required autofocus>
                @include('modules.fielderrormsg', ['field' => 'email'])
            </div>
            <div class="form-group row">
                <label for='password' class="col-sm-2 col-form-label">Password</label>
                <input id='password' type='password' name='password' required>
                @include('modules.fielderrormsg', ['field' => 'password'])
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">
                    <input type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}>
                    Remember Me
                </label>
            </div>

            <button type='submit' class='btn btn-primary'>Login</button>

            <p class="lead">
            Don't have an account? <a href='/register'>Register here...</a>
            </p>
        </form>
    </div>

@endsection