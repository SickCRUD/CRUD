<?php

namespace SickCRUD\CRUD\App\Http\Controllers\Auth;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// SickCRUD
use SickCRUD\CRUD\App\Http\Controllers\BaseController;

class LoginController extends BaseController
{
    // import the Laravel authentication
    use AuthenticatesUsers {
        logout as defaultLogout;
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // use the guest middleware except for logout
        $this->middleware('guest', ['except' => 'logout']);

        // redirect here after successful login
        // TODO: Change with URL::route()?
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo : SickCRUD_url('dashboard');

        // redirect after logout
        $this->redirectAfterLogout = URL::route('SickCRUD.auth.login');
    }

    /**
     * Show the login page view.
     *
     * @return mixed
     */
    public function show()
    {
        // set the page title
        $this->setPageTitle(Lang::get('SickCRUD::auth.pages.login'));

        // set the page body class
        $this->setBodyClass('auth-page');

        return View::make('SickCRUD::pages.auth.login', $this->getViewData());
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        // declare validation rules
        $validationRules = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        // if the captcha is config enabled
        if (SickCRUD_config('general', 'login-reCaptcha') === true) {
            $validationRules['g-recaptcha-response'] = 'required|captcha';
        }

        $request->validate($validationRules);
    }

    /**
     * Uses the default Laravel logout and then redirect to custom route.
     *
     * @param Request $request
     *
     * @return \Illuminate\Support\Facades\Redirect;
     */
    public function logout(Request $request)
    {
        // run the default Laravel logout
        $this->defaultLogout($request);

        return Redirect::to($this->redirectAfterLogout);
    }
}
