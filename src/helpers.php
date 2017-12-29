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
