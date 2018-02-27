<?php

namespace SickCRUD\CRUD\Core\Exceptions;

use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class AccessDeniedException extends Exception
{
    /**
     * Render the error view with 403 code.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return Response::make(View::make('SickCRUD::errors.403'), 403);
    }
}
