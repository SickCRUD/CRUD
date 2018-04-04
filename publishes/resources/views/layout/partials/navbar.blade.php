<!-- Logo -->
<a href="{{ SickCRUD_url('/') }}" class="logo">
    <span class="logo-mini">
        {!! SickCRUD_config('layout', 'navbar.logo.text.logo-mini') !!}
    </span>
    <span class="logo-lg">
        {!! SickCRUD_config('layout', 'navbar.logo.text.logo-large') !!}
    </span>
</a>

<nav class="navbar" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            @if (SickCRUD_config('crud', 'setup-auth-routes') === true)

                @if (Auth::guest())

                    <li class="{{ URL::current() == URL::route('SickCRUD.auth.login') ? 'active' : '' }}">
                        <a href="{{ URL::route('SickCRUD.auth.login') }}">{{ Lang::get('SickCRUD::auth.pages.login') }} <span class="sr-only">({{ Lang::get('SickCRUD::misc.current') }})</span></a>
                    </li>

                    @if (SickCRUD_config('crud', 'setup-register-routes'))

                        <li class="{{ URL::current() == URL::route('SickCRUD.auth.register') ? 'active' : '' }}">
                            <a href="{{ URL::route('SickCRUD.auth.register') }}">{{ Lang::get('SickCRUD::auth.pages.register') }} <span class="sr-only">({{ Lang::get('SickCRUD::misc.current') }})</span></a>
                        </li>

                    @endif

                @else

                    <li>
                        <a href="{{ URL::route('SickCRUD.auth.logout') }}" class="nav-link">
                            <i class="fa fa-btn fa-sign-out"></i> {{ trans('SickCRUD::auth.actions.logout') }}
                        </a>
                    </li>

                @endif

            @endif
        </ul>
    </div>
</nav>

