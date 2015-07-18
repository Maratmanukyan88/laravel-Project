<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class User extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
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
			'password' => '',
			'remember_token' => '',
			'username' => '',
			'created_at' => '',
			'updated_at' => '',
			'email' => '',
			'active' => '',
			'role' => '',
			'additional_data' => '',
			'username' => 'required|max:255',
			'email'    => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		];
	}

}
