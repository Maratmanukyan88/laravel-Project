<?php

namespace App\Http\Controllers\Oauth;

use Illuminate\Http\Request;

use App;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Website;

use Authorizer;
use Auth;
use Response;
use DB;
use Input;

class OauthController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('csrf');
        $this->middleware('check-authorization-params', ['only' => ['getAuthorize', 'postAuthorize']]);
        $this->middleware('auth');
    }

    /**
     * Display modal with permission request
     *
     * @return Response
     */
    public function getAuthorize()
    {        
        $authParams = Authorizer::getAuthCodeRequestParams();
        $formParams = array_except($authParams,'client');
        $formParams['client_id'] = $authParams['client']->getId();
        
        return view('oauth.auth', [
            'params' => $formParams,
            'client' => $authParams['client']
        ]);
    }

    /**
     * Process permission request
     *
     * @return Response
     */
    public function postAuthorize(Request $request)
    {
        $params = Authorizer::getAuthCodeRequestParams();
        $params['user_id'] = Auth::user()->id;

        $redirectUri = '';

        $client = DB::table('oauth_clients')
                    ->where('id', '=', $request->input('client_id'))
                    ->get();

        // if the user has allowed the client to access its data, redirect back to the client with an auth code
        if (Input::get('approve') !== null && is_array($client) && !empty($client)) {

            $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
            $parseUri    = parse_url($redirectUri, PHP_URL_QUERY);
            $client      = $client[0];

            parse_str($parseUri);

            return redirect('oauth/generateToken')->with('params', [
                'code'          => $code,
                'client_id'     => $client->id,
                'client_secret' => $client->secret,
                'redirect_uri'  => $request->input('redirect_uri'),
                'grant_type'    => 'authorization_code'
            ]);
        }

        // if the user has denied the client to access its data, redirect back to the client with an error message
        if (Input::get('deny') !== null) {
            $return = ['redirectUri' => Authorizer::authCodeRequestDeniedRedirectUri()];
        }

        return response()->json($return);
    }

    /**
     * Display generate token page with form
     *
     * @return Response
     */
    public function getGenerateToken()
    {
        if (is_null(session('params')) || empty(session('params'))) {
            abort(404);
        }
        
        return view('oauth.token', [
            'params' => session('params')
        ]);
    }

    /**
     * Receive token from access key
     *
     * @return Response
     */
    public function postGenerateToken()
    {
        $issue  = Authorizer::issueAccessToken();
        $token  = $issue['access_token'];

        $client = DB::table('oauth_clients')
                    ->where('id', '=', Input::get('client_id'))
                    ->get();

        if (!isset($client[0])) {
            abort(404);
        }

        $website   = Website::findOrFail($client[0]->name);
        $website->token = $token;
        $website->save();

        return Response::json($issue);
    }
}
