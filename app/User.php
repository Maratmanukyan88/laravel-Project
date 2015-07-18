<?php 

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['role', 'active', 'username', 'email', 'password', 'additional_data', 'token', 'remember_token'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * The attributes which using Carbon.
	 *
	 * @var array
	 */
	protected $dates = ['created_at', 'updated_at'];

	/**
	 * Filters users to get only activated ones
	 *
	 * @var array
	 */
	public function scopeActive($query)
	{
		$query->where('active', '=', '1');
	}

	/**
	 * Filters users to get non activated ones
	 *
	 * @var array
	 */
	public function scopeInactive($query)
	{
		$query->where('active', '=', '0');
	}

	/**
	 * Filters users to get non activated ones
	 */
	public function Websites()
	{
		return $this->hasMany('App\Website');
	}
}
