<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 7:10 PM
 */

namespace Youtube\Auth\Http\Controllers;

use Assets;
use Sentinel;
use Youtube\Auth\Http\Requests\LoginRequest;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Show login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Toinn
     */
    public function getLogin()
    {
        Assets::removeStylesheets(['jquery-ui']);
        Assets::addStylesheets(['icheck']);

        Assets::removeJavascript(['jquery-ui', 'slimscroll', 'form', 'application', 'demonstration']);
        Assets::addJavascript(['validation', 'icheck']);

        return view('auth::auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @author Toinn
     */
    public function postLogin(LoginRequest $request)
    {
        try {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            $remember = $request->input('remember') == 1 ? true : false;
            try {
                if (Sentinel::authenticate($credentials, $remember)) {
                    return redirect()->intended()->with('success_msg', trans('auth::auth.login.success'));
                }
            } catch (ThrottlingException $e) {
                return redirect()->route('access.login')->with('error_msg', $e->getMessage())->withInput();
            }

            return redirect()->route('access.login')->with('error_msg', trans('auth::auth.login.fail'))->withInput();
        } catch (NotActivatedException $e) {
            return redirect()->route('access.login')->with('error_msg', trans('auth::auth.login.not_active'))->withInput();
        }
    }

    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse
     * @author Toinn
     */
    public function getLogout()
    {
        Sentinel::logout();
        return redirect()->route('access.login')->with('success_msg', trans('auth::auth.login.logout_success'));
    }

}