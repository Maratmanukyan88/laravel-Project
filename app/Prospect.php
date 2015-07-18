<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prospects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['additional_data'];

}
