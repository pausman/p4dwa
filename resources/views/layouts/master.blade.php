<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', config('app.name'))</title>
    <meta charset='utf-8'>

    {{-- Latest compiled and minified CSS --}}
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href='/css/eic.css' rel='stylesheet'>

    {{--load any local page head code --}}
    @stack('head')
</head>

<body>

<header>
    @include('layouts.nav')
</header>
@if(session('alert'))
    <div class='alert'>
        {{ session('alert') }}
    </div>
@endif

{{--Main content section --}}

<section>
    <div class="container text-center">
        <div class="jumbotron">
            @yield('content')
        </div>
    </div>

</section>

{{--Footer--}}
<div class="footer">
    @if(Auth::check())
            <form  method='POST' id='logout' action='/logout'>
                {{ csrf_field() }}
                <a href='#'
                   onClick='document.getElementById("logout").submit();'>Logout {{ $user->name }}</a>
            </form>

    @endif
</div>