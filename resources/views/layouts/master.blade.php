<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @stack('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top">

            <a class="navbar-brand hidden-xs" href="{{ url('/') }}"><img alt="{{ config('app.name', 'Laravel') }}" src="{{ asset('img/its_a_dog.png') }}" style="max-width: 100%; max-height: 100%" /></a>


            @if (!Auth::guest())
                <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <!-- Right Side Of Navbar -->

            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->full_name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('users.show', ['id' => Auth::user()->id]) }}"><span class="glyphicon glyphicon-user"></span>&nbsp; My Profile</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class=" glyphicon glyphicon-log-out"></span>&nbsp; Log Out</a>
                            <form id="logout-form" action="{{ route('logout' )}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endif
    </nav>

    @yield('precontent')

    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
