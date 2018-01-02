@foreach(SickCRUD_config('layout', 'scripts') as $script)
    <script src="{{ SickCRUD_asset($script['path'], ($script['local'] ?? true)) }}"></script>
@endforeach