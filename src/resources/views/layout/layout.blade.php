<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- CSRF Token for every request --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>

    </title>

    @yield('beforeStyles')

    @foreach(SickCRUD_config('layout', 'styles') as $style)
        <link rel="stylesheet" href="{{ SickCRUD_asset($style['path'], ($style['local'] ?? true)) }}">
    @endforeach

    @yield('afterStyles')

</head>
<body>

    <div class="wrapper @yield('bodyClass')">

        <header class="main-header">

            <a href="{{ SickCRUD_url('/') }}" class="logo fixed-top">

                {{-- TODO: accept logo IMG --}}
                <span class="logo-mini">
                    {!! SickCRUD_config('layout', 'navbar.logo.text.logo-mini') !!}
                </span>

                <span class="logo-large">
                    {!! SickCRUD_config('layout', 'navbar.logo.text.logo-large') !!}
                </span>

            </a>

            {{-- TODO: add a setting to customize the scroll of the navbar (fixed or not) --}}
            <nav class="navbar navbar-expand-md navbar-dark {{ SickCRUD_config('layout', 'navbar.navbar-fixed') ? 'navbar-fixed' : '' }}">



            </nav>

        </header>

        <main class="content">



        </main>

    </div>

    @yield('beforeStyles')

    @foreach(SickCRUD_config('layout', 'scripts') as $script)
        <script src="{{ SickCRUD_asset($script['path'], ($script['local'] ?? true)) }}"></script>
    @endforeach

    @yield('afterStyles')

</body>
</html>