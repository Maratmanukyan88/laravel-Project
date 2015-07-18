<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use Carbon;
use Auth;

class AuthController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar) {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('csrf');
    }

    /**
     * Redirect user to login page
     *
     * @return redirect
     */
    public function getAuth() {
        return redirect('auth/login');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin() {
        return view('auth.login');
    }

    /**
     * Show the application forgot password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForgot() {
        return view('auth.forgot');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout() {
        $this->auth->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Reset user's password and send it by e-mail
     *
     * @return \Illuminate\Http\Response
     */
    public function getPassword($username, $token) {
        $user = User::where('username', '=', $username)->first();

        // if token exists in database, activate account
        if (isset($user) && !empty($user->token)) {

            $encryptedToken = unserialize(base64_decode($user->token));

            if (isset($encryptedToken['token']) &&
                    $encryptedToken['reason'] == 'lost' &&
                    $encryptedToken['token'] == $token) {

                $user->token = '';
                $random = str_random(10);

                $user->password = bcrypt($random);

                $user->save();

                $emailVariables = ['username' => $user->username, 'password' => $random];

                Mail::send('emails.auth.password', $emailVariables, function($message) use ($user) {
                    $message->to($user->email)->subject(trans('New password'));
                });

                return redirect('auth/login')
                                ->with([
                                    'flash' => [
                                        'message' => trans('Please check your e-mail inbox to receive new password.'),
                                    ]
                ]);
            }
        }

        return redirect('auth/login')
                        ->with([
                            'flash' => [
                                'message' => trans('Token is not valid.'),
                                'class' => 'alert-danger'
                            ]
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt(array_add($credentials, 'active', '1'), $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        $error = trans('These credentials do not match our records.');

        if ($this->auth->validate($credentials)) {
            $error = trans('Please activate your account first.');
        }

        return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->with([
                            'flash' => [
                                'message' => $error,
                                'class' => 'alert-danger'
                            ]
        ]);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postForgot(Request $request) {
        $this->validate($request, ['email' => 'required|email']);

        $user = User::where('email', '=', $request->only('email'))->active()->first();

        if (!isset($user)) {
            return redirect('auth/forgot')
                            ->with([
                                'flash' => [
                                    'message' => trans('E-mail address is not connected to any active account.'),
                                    'class' => 'alert-danger'
                                ]
            ]);
        }

        // generate token

        $random = str_random(64);

        $arr = ['reason' => 'lost', 'token' => $random, 'generated_at' => date('Y-m-d H:i:s')];

        $user->token = base64_encode(serialize($arr));
        $user->save();

        // send e-mail with confirmation link

        $emailVariables = ['username' => $user->username, 'token' => $random];

        Mail::send('emails.auth.forgot', $emailVariables, function($message) use ($user) {
            $message->to($user->email)->subject(trans('Your lost password'));
        });

        return redirect('auth/forgot')
                        ->with([
                            'flash' => [
                                'message' => trans('Please check your e-mail inbox to recover the password.'),
                            ]
        ]);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath() {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath() {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

}
