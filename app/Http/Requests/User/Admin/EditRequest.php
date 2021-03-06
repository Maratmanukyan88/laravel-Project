<?php 

namespace App\Http\Requests\User\Admin;

use App\Http\Requests\Request;

class EditRequest extends Request {

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
		$rules = [
			'email'                 => 'required|max:255',
			'new_password'          => 'required_with:password',
			'password_confirmation' => 'required_with:password',
		];

		return $rules;
	}

}
