<div class="navbar-wrapper {{ SickCRUD_config('layout', 'navbar.navbar-fixed') == true ? 'fixed-top' : '' }}">

    <a href="{{ SickCRUD_url('/') }}" class="logo">

        {{-- TODO: accept logo IMG --}}
        <span class="logo-mini">
            {!! SickCRUD_config('layout', 'navbar.logo.text.logo-mini') !!}
        </span>

        <span class="logo-large">
            {!! SickCRUD_config('layout', 'navbar.logo.text.logo-large') !!}
        </span>

    </a>

    {{-- TODO: add a setting to customize the scroll of the navbar (fixed or not) --}}
    <nav class="navbar navbar-expand-md navbar-dark">

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ml-auto">

                @if (SickCRUD_config('crud', 'setup-auth-routes') == true)

                    @if (Auth::guest())

                        <li class="nav-item {{ URL::current() == URL::route('SickCRUD.auth.login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ URL::route('SickCRUD.auth.login') }}">{{ Lang::get('SickCRUD::misc.pages.login') }} <span class="sr-only">({{ Lang::get('SickCRUD::misc.current') }})</span></a>
                        </li>

                        @if (SickCRUD_config('crud', 'setup-register-routes'))

                            <li class="nav-item {{ URL::current() == URL::route('SickCRUD.auth.register') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ URL::route('SickCRUD.auth.register') }}">{{ Lang::get('SickCRUD::misc.pages.register') }} <span class="sr-only">({{ Lang::get('SickCRUD::misc.current') }})</span></a>
                            </li>

                        @endif

                    @else

                        <li class="nav-item">
                            <a href="{{ URL::route('SickCRUD.auth.logout') }}" class="nav-link">
                                <i class="fa fa-btn fa-sign-out"></i> {{ trans('SickCRUD::misc.') }}
                            </a>
                        </li>

                    @endif

                @endif

            </ul>

        </div>

    </nav>

</div>


