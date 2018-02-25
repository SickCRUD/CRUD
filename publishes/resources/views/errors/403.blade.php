<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <!-- Simple HttpErrorPages | MIT License | https://github.com/AndiDittrich/HttpErrorPages -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ rtrim(Lang::get('SickCRUD::misc.errors.403.title'), '.') }} | 403 - {{ rtrim(Lang::get('SickCRUD::misc.errors.403.heading'), '.') }}</title>
    <link rel="stylesheet" href="{{ SickCRUD_asset('vendor/bootstrap/css/bootstrap.min.css', true) }}">
    <link rel="stylesheet" href="{{ SickCRUD_asset('css/sick-crud.min.css', true) }}">
</head>
<body class="error-page">
    <div class="cover">
        <h1>{{ Lang::get('SickCRUD::misc.errors.403.heading') }} <small>{{ Lang::get('SickCRUD::misc.errors.error') }} 403</small></h1>
        <p class="lead">{{ Lang::get('SickCRUD::misc.errors.403.description') }}</p>
    </div>
    @if(SickCRUD_config('general', 'technical-contact'))
        <footer>
            <p>{{ Lang::get('SickCRUD::misc.errors.technical_contact') }}: <a href="mailto:{{ SickCRUD_config('general', 'technical-contact') }}">{{ SickCRUD_config('general', 'technical-contact') }}</a></p>
        </footer>
    @endif
</body>
</html>
