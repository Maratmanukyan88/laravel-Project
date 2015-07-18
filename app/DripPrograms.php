<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DripPrograms extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drip_programs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'data'];

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
    protected $dates = ['created_at', 'updated_at'];
//    public static $rules = array(
//        'username' => 'required',
//        'email' => 'required|email|unique:users'
//    );

    /**
     * Article is owned by user
     * 
     * @return belongsTo
     */
    public function phrases() {
        return $this->belongsTo('App\Website');
    }

    public static function insertDrip($data) {
        $Drip = new DripPrograms();
        $newDrip = $Drip->create($data);
    }

}
