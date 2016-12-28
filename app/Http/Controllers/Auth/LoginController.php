<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLoggedInEvent;
use App\Events\UserLoggedOutEvent;
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

    use AuthenticatesUsers {
        AuthenticatesUsers::login as private AuthenticatesUsersLogin;
        AuthenticatesUsers::logout as private AuthenticatesUsersLogout;
    }

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

    public function login(Request $request)
    {
        $response = $this->AuthenticatesUsersLogin($request);

        if ($user = Auth::user()) {
            event(new UserLoggedInEvent($user, Carbon::now()));
        }

        return $response;
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        $response = $this->AuthenticatesUsersLogout($request);

        event(new UserLoggedOutEvent($user, Carbon::now()));

        return $response;
    }
}
