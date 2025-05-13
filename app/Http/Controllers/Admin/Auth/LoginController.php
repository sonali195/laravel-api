<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * LoginController
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = AppServiceProvider::ADMIN;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    /**
     * ShowLoginForm
     *
     * @return void
     * @author CK
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * login
     *
     * @param  mixed $request
     * @return void
     * @author CK
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'   => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->route('admin.dashboard')->withInput()->with('success', trans('auth.Logged_in_successfully'));
        } else {
            return redirect()->route('admin.login')->withInput()->with('error', trans('auth.failed'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout
     *
     * @param  mixed $request
     * @return void
     * @author CK
     */
    public function logout(Request $request)
    {
        $this->redirectTo = AppServiceProvider::ADMIN . "/login";
        auth()->guard('admin')->logout();
        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
