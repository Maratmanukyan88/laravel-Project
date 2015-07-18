<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request {

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

		if ($this->has('password')){
		    $rules['new_password']          = $rules['new_password'] . '|min:6';
		    $rules['password_confirmation'] = $rules['password_confirmation'] . '|min:6';
		}

		return $rules;
	}

}
