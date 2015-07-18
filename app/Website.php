<?php 

namespace App;

use Laravel\Cashier\BillableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model implements \Laravel\Cashier\Contracts\Billable
{

	use Billable, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'websites';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'url'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The attributes which using Carbon.
	 *
	 * @var array
	 */
	protected $dates = ['created_at', 'deleted_at', 'updated_at', 'trial_ends_at', 'subscription_ends_at'];

	/**
	 * Website has an owner
	 * 
	 * @return Collection
	 */
	public function user() 
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Website has many Phrases used by google scraper
	 * to track keywords in search results
	 * 
	 * @return Collection
	 */
    public function phrases()
    {
        return $this->hasMany('App\Phrases');
    }

	/**
	 * Website has many crawling schedules
	 * 
	 * @return Collection
	 */
    public function checks()
    {
        return $this->hasMany('App\PhraseChecks');
    }
}
