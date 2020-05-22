<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo/list';

    public function loginForm() {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        session()->flash('message', 'Just Logged Out!');

        return redirect()->route('auth.loginForm');
    }
}
