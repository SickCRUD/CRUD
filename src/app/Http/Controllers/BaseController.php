<?php

namespace SickCRUD\CRUD\App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// SickCRUD
use SickCRUD\CRUD\Core\Traits\ViewData;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        // SickCRUD traits
        ViewData;
}
