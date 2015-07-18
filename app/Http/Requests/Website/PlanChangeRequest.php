<?php namespace App\Http\Requests\Website;

use App\Http\Requests\Request;
use Auth;

class PlanChangeRequest extends Request {

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
			'plan'     => 'required|numeric|exists:website_plans,id',
			'website'  => 'required|numeric|exists:websites,id',
			'password' => 'required'
		];
	}

}
