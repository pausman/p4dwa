<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">
    <div class='container-fluid'>
        <div class="navbar-header">
            <a class="navbar-brand" href="/">{{config('app.name')}}</a>
        </div>
        <ul class="nav navbar-nav">
            @foreach(config('app.nav') as $link => $label)
                @if(Request::is(substr($link, 1)))
                    <li class="nav-item active"><a href="#">{{ $label }}</a></li>
                @else
                    <li><a href='{{ $link }}'>{{ $label }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>