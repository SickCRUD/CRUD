@if(SickCRUD_config('general', 'login-reCaptcha', false) || SickCRUD_config('general', 'register-reCaptcha', false))
    {!! NoCaptcha::renderJs(App::getLocale()) !!}
@endif

@foreach(SickCRUD_config('layout', 'optional-plugins') as $optionalPlugin)
    @php
        $optionalPluginScripts = SickCRUD_config('layout', 'optional-plugins-list' . '.' . $optionalPlugin);
        $optionalPluginScripts = array_key_exists('js', $optionalPluginScripts)? $optionalPluginScripts['js']:[];
    @endphp
    @foreach((array)$optionalPluginScripts as $optionalPluginScript)
        @if(!empty($optionalPluginScript) && file_exists(public_path($optionalPluginScript)))
            <script src="{{ SickCRUD_asset($optionalPluginScript, true) }}"></script>
        @endif
    @endforeach
@endforeach