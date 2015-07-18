<?php namespace App\Http\Requests\Website;

use App\Http\Requests\Request;
use Auth;

class CreateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		if (!isset($user)) {
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
			'url'  => 'unique:websites,url|required|active_url',
			'plan' => 'required|numeric',
		];
	}

}
