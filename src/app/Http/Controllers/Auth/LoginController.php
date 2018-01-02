<?php

namespace SickCRUD\CRUD\App\Http\Controllers\Auth;

// Laravel
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Lang;
// SickCRUD
use SickCRUD\CRUD\App\Http\Controllers\Controller;
use SickCRUD\CRUD\Core\Traits\ViewData;

class LoginController extends Controller
{
    // import the Laravel authentication
    use AuthenticatesUsers,
        // and SickCRUD features
        ViewData;

    public function show()
    {
        // set the page title
        $this->setPageTitle(Lang::get('SickCRUD::misc.pages.login'));

        // set the page body class
        $this->setBodyClass('auth-page');

        return View::make('SickCRUD::pages.login', $this->getViewData());
    }

}
