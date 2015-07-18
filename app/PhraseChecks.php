<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhraseChecks extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'phrase_checks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['phrase_id', 'website_id', 'position', 'additional_data'];

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

    /**
     * Article is owned by user
     * 
     * @return belongsTo
     */
    public function checks()
    {
        return $this->belongsTo('App\Website');
    }

    public static function inserposition($data) {
        $phrasechecks = new PhraseChecks();
        $phrasechecks->create($data);
    }

}
