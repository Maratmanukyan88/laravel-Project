<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Website;
use App\User;

class Token extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'oauth_access_tokens';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'session_id', 'expire_time'];

	/**
	 * The attributes which using Carbon.
	 *
	 * @var array
	 */
	protected $dates = ['created_at', 'updated_at'];

	/**
	 * Return website connected to API key
	 */
	public function website()
	{
		return Website::where('token', $this->id)->take(1)->get()[0];
	}

	/**
	 * Return user connected to API key
	 */
	public function user()
	{
		$website = Website::where('token', $this->id)->take(1)->get()[0];

		if (!isset($website->user_id)) {
			return null;
		}

		return User::find($website->user_id);
	}

}
