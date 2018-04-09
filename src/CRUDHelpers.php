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

}