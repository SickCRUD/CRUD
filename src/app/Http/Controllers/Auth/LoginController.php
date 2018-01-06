<?php

namespace SickCRUD\CRUD\App\Http\Controllers\Auth;

// Laravel
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Lang;
// SickCRUD
use SickCRUD\CRUD\App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // import the Laravel authentication
    use AuthenticatesUsers;

    /**
     * Show the login page view
     *
     * @return mixed
     */
    public function show()
    {
        // set the page title
        $this->setPageTitle(Lang::get('SickCRUD::misc.pages.login'));

        // set the page body class
        $this->setBodyClass('auth-page');

        return View::make('SickCRUD::pages.auth.login', $this->getViewData());
    }

}
