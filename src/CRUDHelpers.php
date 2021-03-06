<?php

namespace SickCRUD\CRUD;

class CRUDHelpers
{
    /**
     * Helper to get the body classes.
     *
     * @param array $classes
     *
     * @return string
     */
    public static function getBodyClasses(array $classes = [])
    {
        // add the eventual skin classes from config
        $classes[] = SickCRUD_config('layout', 'css-skin', 'skin-purple');
        // add eventual body classes from config
        $classes = array_merge($classes, SickCRUD_config('layout', 'body-classes', []));

        return implode(' ', $classes);
    }

    /**
     * Helper to determine if the sidebar should be setted up.
     *
     * @return bool
     */
    public static function setupSidebar()
    {

        // check if it is an auth-page
        $isAuthPage = preg_match('/SickCRUD\.auth\.(?:login|logout|register|password.*)/', \Route::currentRouteName());

        if ($isAuthPage) {
            // strict check
            return SickCRUD_config('layout', 'show-sidebar-in-auth-pages', false) === true;
        }

        return true;
    }
}
