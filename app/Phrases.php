<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrases extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'phrases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['website_id', 'phrase', 'last_check'];

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
    public static $rules = array(
        'phrase' => 'required',
    );

    /**
     * Article is owned by user
     * 
     * @return belongsTo
     */
    public function phrases() {
        return $this->belongsTo('App\Website');
    }

    public static function insertPhrases($data) {
        $phrase = new Phrases();
        $newPhrase = $phrase->create($data);
    }

    public static function deletePhrases($id) {
        self::where('id', $id)->delete();
    }

    public static function updatePhrases($id, $data) {
        self::where('id', $id)->update($data);
    }
}