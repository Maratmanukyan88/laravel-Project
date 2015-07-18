<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'website_plans';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'plan', 'additional_data'];

}
