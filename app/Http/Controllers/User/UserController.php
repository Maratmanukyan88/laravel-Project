<?php 

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use User;
use View;
use Session;
use Mail;

class UserController extends Controller {

	/**
	 * Create a new authentication controller instance.
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('csrf');
	}

	/**
	 * Show the form for editing profile
	 *
	 * @return Response
	 */
	public function getProfile()
	{
		$user = Auth::user();

		// get json encoded additional data
		$json = json_decode($user->getAttribute('additional_data'));

		// set virtual columns to fill inputs
		foreach ($json as $key => $value) {
			$user->setAttribute($key, $value);
		}

		// return view
		return view('user.profile', compact('user'));
	}

	/**
	 * Process the form for editing profile
	 *
	 * @return Response
	 */
	public function postProfile(ProfileRequest $request)
	{
		$user    = Auth::user();
		$message = trans('Settings saved.'); 

		// user changed e-mail
		if ($request->input('email') != $user->email) {
			// generate token
		
			$random = str_random(32);

			$arr = [
				'reason'       => 'email',
				'email'        => $request->input('email'),
				'token'        => $random,
				'generated_at' => date('Y-m-d H:i:s')
			];

			$user->token = base64_encode(serialize($arr));
			$user->save();

			// send e-mail with confirmation link

			$emailVariables = ['username' => $user->username, 'token' => $random];

			Mail::send('emails.user.mail', $emailVariables, function($message) use ($user)
			{
			    $message->to($user->email)->subject(trans('Please, confirm your e-mail change.'));
			});

			$message = trans('Settings saved. Please check your previous inbox to confirm new e-mail address.'); 
		}

		// user set new password
		if ($request->has('password') ||
			$request->has('new_password') ||
			$request->has('password_confirmation')) {

			if (!Auth::attempt(['username' => $user->username, 'password' => $request->input('password')], false))
			{
				return redirect('user/profile')
						->with([
							'flash' => ['message' => trans('Current password is invalid.'), 'class' => 'alert-danger']
						]);
			}

			if ($request->input('new_password') != $request->input('password_confirmation'))
			{
				return redirect('user/profile')
						->with([
							'flash' => ['message' => trans('Passwords do not match.'), 'class' => 'alert-danger']
						]);
			}

			$user->password = bcrypt($request->input('new_password'));
			$user->save();
		}

		// save user data
		$additional_data = json_encode([
            'firstname' => $request->input('firstname'),
            'lastname'  => $request->input('lastname'),
            'phone'     => $request->input('phone'),
            'company'   => $request->input('company'),
        ]);

        $user->additional_data = $additional_data;

        // save user
        $user->save();

        return redirect('user/profile')
				->with([
					'flash' => ['message' => $message]
				]);
	}

	/**
	 * Confirm mail change
	 *
	 * @return Response
	 */
	public function getConfirm($token)
	{
		$user = Auth::user();

		if (!empty($user->token)) {

			$encryptedToken = unserialize(base64_decode($user->token));

			if (isset($encryptedToken['token']) && 
				$encryptedToken['reason'] == 'email' && 
				$encryptedToken['token'] == $token) {

				$user->email = $encryptedToken['email'];
				$user->save();

				return redirect('user/profile')
						->with([
							'flash' => [
								'message' => trans('E-mail address changed successfuly.'),
							]
						]);
			}
		}

		return redirect('profile')
					->with([
						'flash' => [
							'message' => trans('Token is not valid.'),
							'class'   => 'alert-danger'
						]
					]);
	}
}
