<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- CSRF Token for every request --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Include the title partial, pageTitle variable should be already passed --}}
    @include('SickCRUD::layout.partials.title')

    @yield('beforeStyles')

    {{-- Include the styles partial --}}
    @include('SickCRUD::layout.partials.styles')

    @yield('afterStyles')

</head>
<body class="{{ CRUDHelpers::getBodyClasses($bodyClasses) }}">

<div class="wrapper">

    <header class="main-header">

        @include('SickCRUD::layout.partials.navbar')

    </header>

    @if( CRUDHelpers::setupSidebar() )

        <aside class="main-sidebar">

            @include('SickCRUD::layout.partials.sidebar')

        </aside>

    @endif

    <div class="content-wrapper">

        @yield('pageContent')

    </div>

</div>

@yield('beforeScripts')

{{-- Include the scripts partial --}}
@include('SickCRUD::layout.partials.scripts')

@yield('afterScripts')

</body>
</html>