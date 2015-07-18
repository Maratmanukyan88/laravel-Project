<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Phrases;
use Auth;

class PhraseController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Phrase Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for Phrase that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth', ['only' => 'update']);
    }

    public function getPhrases() {
        $id = Auth::User()->id;
        $websites = \App\Website::getUserWebsites($id);
        $data = array();
        foreach ($websites as $website) {
            $data[$website->id] = $website->url;
        }
        return view('pages/nm-search')->with(array('websites' => $websites, 'data' => $data));
    }

    public function newPhrase() {
        $data = array();
        $data['phrase'] = \Request::get('phrase');
        $data['website_id'] = \Request::get('url');
        $data['created_at'] = date('Y-m-d H:i:s');
        $validator = \Validator::make($data, \App\Phrases::$rules);
        if ($validator->fails()) {
            return redirect()->back();
        } else {
            \App\Phrases::insertPhrases($data);
            return redirect()->back()->with(['flash' => ['message' => trans('Phrase has been Created successfully.'),]]);
        }
    }

    public function deletePhrase($id) {
        \App\Phrases::deletePhrases($id);
        return redirect()->back()->with(['flash' => ['message' => trans('Phrase has been Deleted successfully.'),]]);
    }

    public function getUpdatePhrase($id) {
        $phrases = \App\Phrases::find($id);
        $action = "/phrase-update/$phrases->id";
        return view('pages/phrase-update')->with([
                    'model' => $phrases,
                    'action' => $action
        ]);
    }

    public function postUpdatePhrase($id) {
        $data = array();
        $data['phrase'] = \Request::get('phrase');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $validator = \Validator::make($data, \App\Phrases::$rules);
        if ($validator->fails()) {
            return \Redirect::to('search');
        } else {
            \App\Phrases::updatePhrases($id, $data);
            return \Redirect::to('search')->with(['flash' => ['message' => trans('Phrase has been Updated successfully.'),]]);
        }
    }

}
