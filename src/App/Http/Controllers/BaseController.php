<?php

namespace SickCRUD\CRUD\App\Http\Controllers;

use Illuminate\Routing\Controller;
use SickCRUD\CRUD\Core\Traits\ViewData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
// SickCRUD
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        // SickCRUD traits
        ViewData;
}
