<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_roles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'role', 'capabilites'];

}
