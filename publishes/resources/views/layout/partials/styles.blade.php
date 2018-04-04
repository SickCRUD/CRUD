<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('vendor/adminlte/css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('vendor/adminlte/css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/SickCRUD.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('vendor/fontawesome/css/fontawesome-all.min.css') }}">

@foreach(SickCRUD_config('layout', 'optional-plugins') as $optionalPlugin)
    @php
        $optionalPluginStyles = SickCRUD_config('layout', 'optional-plugins-list' . '.' . $optionalPlugin);
        $optionalPluginStyles = array_key_exists('css', $optionalPluginStyles)? $optionalPluginStyles['css']:[];
    @endphp
    @foreach((array)$optionalPluginStyles as $optionalPluginStyle)
        @if(!empty($optionalPluginStyle) && file_exists(public_path($optionalPluginStyle)))
            <link rel="stylesheet" href="{{ SickCRUD_asset($optionalPluginStyle, true) }}">
        @endif
    @endforeach
@endforeach