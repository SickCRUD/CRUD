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

    @foreach(SickCRUD_config('layout.styles') as $style)
        @if(!isset($style['local']) || $style['local'])
            <link rel="stylesheet" href="{{ asset($style['path']) }}">
        @else
            <link rel="stylesheet" href="{{ $style['path'] }}">
        @endif
    @endforeach

</head>
<body>

<div class="wrapper">

    <header class="main-header">

        <a href="#" class="logo fixed-top">

            <span class="logo-mini">
                <b>SC</b>
            </span>

            <span class="logo-lg">
                <b>Sick</b>CRUD
            </span>

        </a>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top">


        </nav>

    </header>

    <main class="content">


    </main>

</div>

</body>
</html>