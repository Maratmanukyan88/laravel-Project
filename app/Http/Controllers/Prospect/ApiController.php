<?php

namespace App\Http\Controllers\Prospect;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Token;
use App\Prospect;

use Input;

class ProspectController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('oauth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function postCreate()
    {
        $token    = Token::find(Input::get('access_token'));
        $website  = $token->website();

        $prospect = new Prospect;
        $prospect->website_id = $website->id;

        $fillable = ['email', 'ip', 'user_agent'];

        // save prospect data
        foreach ($fillable as $input) {
            if (is_null(Input::get($input))) {
                continue;
            }

            $prospect->{$input} = Input::get($input);
        }

        // save additional data
        $additional_inputs = [];
        $additional = new stdClass;

        foreach ($additional_inputs as $input) {
            if (is_null(Input::get($input))) {
                continue;
            }

            $additional->{$input} = Input::get($input);
        }

        $prospect->additional_data = $additional;

        // save prospect data
        $prospect->save();
    }
}
