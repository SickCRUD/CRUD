<?php

if (!function_exists('SickCRUD_config')) {
    /**
     * Little helper to get the SickCRUD config directly by passing the key.
     *
     * @param string $prefix
     * @param string $key
     * @param mixed        $default
     *
     * @return mixed|\Illuminate\Config\Repository
     */
    function SickCRUD_config($prefix = null, $key = null, $default = null)
    {
        return config('SickCRUD.'.$prefix.'.'.$key, $default);
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

if (!function_exists('SickCRUD_title_format')) {
    /**
     * Helper to get the formatted title for a page
     *
     * @param string $title
     *
     * @return string
     */
    function SickCRUD_title_format($title = '')
    {
        return str_replace('%title', $title, SickCRUD_config('layout', 'page-title.title-format'));
    }
}
