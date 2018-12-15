<nav class="navbar navbar-default navbar-light bg-light">

    <div class="input-group">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{config('app.name')}}</a>
        </div>
        <ul class="nav navbar-nav navbar-left">

            @foreach(config('app.nav'.Auth::check()) as $link => $label)
                <li class="nav-item"><a href='{{ $link }}'
                                        class='{{ Request::is(substr($link, 1)) ? 'active' : '' }}'>{{ $label }}</a>
            @endforeach



        </ul>
    </div>
</nav>


