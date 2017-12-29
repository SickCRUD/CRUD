<?php

if (!function_exists('SickCRUD_config')) {
    /**
     * Little helper to get the SickCRUD config directly by passing the key.
     *
     * @param array|string $key
     * @param mixed        $default
     *
     * @return mixed|\Illuminate\Config\Repository
     */
    function SickCRUD_config($key = null, $default = null)
    {
        return config('SickCRUD.'.$key, $default);
    }
}

if (!function_exists('SickCRUD_asset')) {
    /**
     * Helper to get the CSS URL
     *
     * @param string $path
     * @param boolean $local
     *
     * @return string
     */
    function SickCRUD_asset($path = null, $local = true)
    {
        return $local?asset($path):$path;
    }
}

if (!function_exists('SickCRUD_url')) {
    /**
     * Helper to get the CRUD prefixed URL
     *
     * @param string $path
     * @param  mixed   $parameters
     * @param  bool    $secure
     *
     * @return string
     */
    function SickCRUD_url($path = null, $parameters = [], $secure = null)
    {
        // TODO: add prefix
        return url($path, $parameters, $secure);
    }
}
