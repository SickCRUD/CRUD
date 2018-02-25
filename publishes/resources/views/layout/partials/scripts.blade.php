{{-- <script src="{{ URL::asset('') }}"></script> --}}

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