<?php 

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Requests\User\Admin\EditRequest;

use App\Http\Requests\ProfileAdminRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use Auth;
use View;
use Session;
use Mail;
use Redirect;
use Hash;

class AdminController extends Controller {

	/**
	 * Create a new authentication controller instance.
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('csrf');
	}

	/**
	 * Redirect user to listing
	 *
	 * @return Response
	 */
	public function getUser()
	{
		return redirect('admin/user/listing');
	}

	/**
	 * Display all users
	 *
	 * @return Response
	 */
	public function getListing()
	{
		$roles = Role::all();
        $users = User::paginate(15);

        return view('user.admin.listing')
        		->with([
        			'users' => $users,
        			'roles' => $roles
        		]);
    }

	/**
	 * Show the form for editing profile
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		$user = User::findOrFail($id);

		// get json encoded additional data
		$json = json_decode($user->getAttribute('additional_data'));

		// set virtual columns to fill inputs
		foreach ($json as $key => $value) {
			$user->setAttribute($key, $value);
		}

		// return view
		return view('user.admin.edit', compact('user'));
	}

	/**
	 * Process the form for editing profile
	 *
	 * @return Response
	 */
	public function postEdit($id, EditRequest $request)
	{
		$user = User::findOrFail($id);

		$user->email = $request->input('email');

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

		// return view
		return redirect('admin/user/listing')
				->with([
					'flash' => ['message' => trans('Profile updated.')]
				]);
	}

	/**
	 * Change password action
	 *
	 * @return Response
	 */
	public function getPassword($id)
	{
		$random = str_random(12);

		$user = User::findOrFail($id);
		$user->password = Hash::make($random);

        // save user
        $user->save();

        // send confirmation e-mail
		$email_variables = ['username' => $user->username, 'password' => $random];
		
		Mail::send('emails.user.admin.password', $email_variables, function($message) use ($user)
		{
            $message->to($user->email)->subject(trans('New password'));
		});

		// return view
		return redirect('admin/user/listing')
				->with([
					'flash' => ['message' => trans('Password was sent.')]
				]);
	}
    
}
