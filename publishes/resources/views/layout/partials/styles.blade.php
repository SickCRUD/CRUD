@foreach(SickCRUD_config('layout', 'styles') as $style)
    <link rel="stylesheet" href="{{ SickCRUD_asset($style['path'], ($style['local'] ?? true)) }}">
@endforeach