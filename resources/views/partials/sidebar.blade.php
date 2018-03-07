<nav class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" role="navigation">

    <div class="navmenu-title">Peer Review</div>

    <ul class="nav navmenu-nav">
        <li><a href="{{ route('home') }}">Home <span class="glyphicon glyphicon-home"></span></a></li>

        @permission('applications.view')
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reviews <b class="caret"></b><span class="glyphicon glyphicon-inbox"></span></a>
            <ul class="dropdown-menu navmenu-nav" role="menu">
            </ul>
        </li>
        @endpermission
    </ul>

    @ability('', 'users.view,roles.view')
    <div class="navmenu-title">Admin</div>

    <ul class="nav navmenu-nav">
        @permission('users.view')<li><a href="{{ route('users.index') }}">Users <span class="glyphicon glyphicon-user"></span></a></li>@endpermission
        @permission('roles.view')<li><a href="{{ route('roles.index') }}">Roles <span class="glyphicon glyphicon-tags"></span></a></li>@endpermission
    </ul>
    @endability

    <div class="bottom text-muted hidden-xs hidden-sm">
        <small>&copy; {{ date('Y') }} Team Dog. All rights reserved.</small><br />
        <small>Designed by <a href="http://teamdog.io/">Team Dog.</a></small><br />
        <small>Page loaded in {{ round((microtime(true) - LARAVEL_START), 4) }} seconds.</small>
    </div>

</nav>
