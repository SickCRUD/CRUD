<?php

namespace SickCRUD\CRUD\App\Http\Controllers\Auth;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\RegistersUsers;
// SickCRUD
use SickCRUD\CRUD\App\Http\Controllers\BaseController;

class RegisterController extends BaseController
{
    // import the Laravel registration
    use RegistersUsers;

    /**
     * Define the user model once while instantiating.
     *
     * @var mixed
     */
    protected $user = null;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // use the guest middleware
        $this->middleware('guest');

        // build the user default model class
        $userFqn = SickCRUD_config('crud', 'user-fqn');
        $this->user = new $userFqn();

        // change redirect
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo : SickCRUD_url('dashboard');
    }

    /**
     * Show the register page view.
     *
     * @return mixed
     */
    public function show()
    {
        // set the page title
        $this->setPageTitle(Lang::get('SickCRUD::auth.pages.register'));

        // set the page body classes
        $bodyClasses = ['login-page'];

        // check whether it's fixed or not
        if(SickCRUD_config('layout', 'navbar.navbar-fixed', true) == true){
            $bodyClasses[] = 'fixed';
        }

        // set body classes
        $this->addBodyClasses($bodyClasses);

        return View::make('SickCRUD::pages.auth.register', $this->getViewData());
    }

    /**
     * Register the new user to the database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // validate the request first and if it's valid, then continue with the creation
        $this->guard()->login($this->create($this->validateRegister($request)));

        // redirect the user if successful
        return Redirect::to($this->redirectPath());
    }

    /**
     * Validate the register request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function validateRegister(Request $request)
    {
        // declare validation rules
        $validationRules = [
            'name'     => 'required',
            'email'    => 'required|email|unique:'.$this->user->getTable(),
            'password' => 'required|confirmed',
        ];

        // if the captcha is config enabled
        if (SickCRUD_config('general', 'register-reCaptcha') === true) {
            $validationRules['g-recaptcha-response'] = 'required|captcha';
        }

        // if the tos are config enabled
        if (SickCRUD_config('general', 'register-require-tos') === true) {
            $validationRules['tos'] = 'required';
        }

        // return the validated response
        return $request->validate($validationRules);
    }

    /**
     * Create the user and save it to database.
     *
     * @param array $data
     *
     * @return Model;
     */
    public function create(array $data = [])
    {
        // encrypt the password before saving it
        $data['password'] = Hash::make($data['password']);

        // then, save it
        return $this->user->create($data);
    }
}
