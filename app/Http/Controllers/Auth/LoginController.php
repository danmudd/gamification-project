<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Override AuthenticatesUsers username function to allow for dual user/email login.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Override AuthenticatesUsers credentials function to allow for dual user/email login.
     *
     * @param Request $request
     * @return array
     */
    public function credentials(Request $request)
    {
        $userIn = $request->{$this->username()};
        $userCol = filter_var($userIn, FILTER_VALIDATE_EMAIL) ? 'email' : $this->username();

        return [$userCol => $userIn, 'password' => $request->password];
    }
}
