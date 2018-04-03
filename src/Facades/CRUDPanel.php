<?php

namespace SickCRUD\CRUD\Facades;

use Illuminate\Support\Facades\Facade;

class CRUDPanel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CRUDPanel';
    }
}
