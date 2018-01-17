<?php

namespace SickCRUD\CRUD\App\Http\Controllers\Auth;

// Laravel
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
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
     * RegisterController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        // use the guest middleware
        $this->middleware('guest');

        // build the user default model class
        $userFqn = SickCRUD_config('crud', 'user-fqn');
        $this->user = new $userFqn();
    }

    /**
     * Show the register page view
     *
     * @return mixed
     */
    public function show()
    {
        // set the page title
        $this->setPageTitle(Lang::get('SickCRUD::misc.pages.register'));

        // set the page body class
        $this->setBodyClass('auth-page');

        return View::make('SickCRUD::pages.auth.register', $this->getViewData());
    }

    /**
     * Register the new user to the database
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
     * Validate the register request
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function validateRegister(Request $request)
    {
        // return the validated response
         return $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:'.$this->user->getTable(),
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create the user and save it to database
     *
     * @param array $data
     *
     * @return Model;
     *
     */
    public function create(Array $data = [])
    {
        // encrypt the password before saving it
        $data['password'] = Hash::make($data['password']);

        // then, save it
        return $this->user->create($data);
    }

}