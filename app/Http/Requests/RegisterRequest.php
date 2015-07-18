<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class RegisterRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		if (isset($user)) {
			return false;
		}

		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'   => 'required|max:255|unique:users',
			'email'      => 'required|email|max:255|unique:users',
			'firstname'  => 'required',
			'lastname'   => 'required',
			'phone'      => 'required',
			'company'    => 'required',
			'password'   => 'required|confirmed|min:6',
		];
	}

}
