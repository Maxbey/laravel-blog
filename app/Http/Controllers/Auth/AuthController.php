<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * After login redirect to articles page
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Redirect after logout.
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Login path
     * @var string
     */
    protected $loginPath = 'auth/login';

    /**
     * Login username to be used by the controller.
     * @var string
     */
    protected $username = 'login';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => 'required|min:3',
            'email' => 'required|email',
            'permissions_id' => 'required',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6|same:password'
        ]);
    }
}
