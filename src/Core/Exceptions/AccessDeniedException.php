<?php
namespace SickCRUD\CRUD\Core\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class AccessDeniedException extends Exception
{
    /**
     * Render the error view with 403 code.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return Response::make(View::make('errors.403'), 403);
    }
}