<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\CreateRequest as WebsiteCreateRequest;
use App\Http\Requests\Website\PlanChangeRequest as WebsitePlanChangeRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Website;
use App\Plan;
use App\PhraseChecks;
use App\Phrases;
use App\googleScraper;
use Auth;
use Mail;
use DB;
use Carbon;

class WebsiteController extends Controller {

    /**
     * Create a new authentication controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('csrf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $user   = Auth::user();

        $_plans = Plan::all();
        $plans  = [];

        foreach ($_plans as $plan) {
            $plans[$plan->id] = $plan->plan; 
        }

        return view('website.create')->with([
            'user'   => $user,
            '_plans' => $_plans,
            'plans'  => $plans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(WebsiteCreateRequest $request)
    {
        $website = new Website();
        $plan    = Plan::find($request->input('plan'));
        $user    = Auth::user();

        $url     = filter_var($request->input('url'), FILTER_VALIDATE_URL);

        if (!$url) {
            return redirect('website/create')
                    ->with([
                        'flash' => [
                            'message' => trans('Please provide valid URL address.'),
                            'class'   => 'alert-danger'
                        ]
                    ])
                    ->withInput();
        }
        
        $parse   = parse_url($request->input('url'));

        if (!isset($parse['host'])) {
            return redirect('website/create')
                    ->with([
                        'flash' => [
                            'message' => trans('Please provide valid URL address.'),
                            'class'   => 'alert-danger'
                        ]
                    ])
                    ->withInput();
        }

        $name    = $parse['host'];

        // create website
        $website->user_id    = Auth::user()->id;
        $website->plan_id    = $plan->id;
        $website->name       = $name;
        $website->url        = $request->input('url');

        $website->save();

        $client_id = bin2hex(openssl_random_pseudo_bytes(8));

        DB::table('oauth_clients')->insert([
            'id'         => $client_id,
            'secret'     => bin2hex(openssl_random_pseudo_bytes(12)),
            'name'       => $website->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('oauth_client_endpoints')->insert([
            'client_id'    => $client_id,
            'redirect_uri' => '/oauth/token/',
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now()
        ]);

        if (intval($plan->price) > 0) {
            $emailVariables = [
                'website' => $request->input('url'),
                'plan'    => $plan
            ];

            Mail::send('emails.website.payment', $emailVariables, function($message) use ($user) {
                $message->to($user->email)->subject(trans('We have charged your credit card.'));
            });

            // subscription
            $website->subscription(lcfirst($plan->plan))->create($request->input('stripeToken'));
        }
        
        // send e-mail
        $emailVariables = ['website' => $request->input('url')];

        Mail::send('emails.website.create', $emailVariables, function($message) use ($user) {
            $message->to($user->email)->subject(trans('New website attached to your account.'));
        });

        // return redirection
        return redirect('website/listing')->with([
            'flash' => [
                'message' => trans('Site added successfuly.')
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        return redirect('website/listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getListing()
    {
        $user     = Auth::user();
        $plans    = Plan::all();
        $websites = Website::where('user_id', '=', $user->id)
                           ->orderBy('created_at', 'desc')
                           ->paginate(15);

        foreach ($websites as $website) {
            if (is_null($website->token)) {
                $clients = DB::table('oauth_clients')
                                ->where('name', '=', $website->id)
                                ->get();

                if (isset($clients[0])) {
                    $website->oauth_id   = $clients[0]->id;
                    $website->secret_key = $clients[0]->secret;
                }
            }
        }

        $_plans_list = Plan::all();
        $plans_list  = [];

        foreach ($_plans_list as $plan_list) {
            $plans_list[$plan_list->id] = $plan_list->plan;
        }

        return view('website.listing')
                ->with([
                    'user'        => $user,
                    'websites'    => $websites,
                    'plans'       => $plans,
                    '_plans_list' => $_plans_list,
                    'plans_list'  => $plans_list
                ]);
    }

    /**
     * Delete resource
     *
     * @return Response
     */
    public function getDelete($id)
    {
        $user = Auth::user();
        $website = Website::findOrFail($id);

        if ($website->user_id != $user->id) {
            return redirect('website/listing')->with([
                'flash' => [
                    'message' => trans('Unauthorized.')
                ]
            ]);
        }

        // send e-mail
        $emailVariables = ['website' => $request->input('url')];

        Mail::send('emails.website.delete', $emailVariables, function($message) use ($user) {
            $message->to($user->email)->subject(trans('Your website was deleted.'));
        });

        $website->subscription()->cancel();
        $website->delete();

        return redirect('website/listing')->with([
            'flash' => [
                'message' => trans('Page was deleted. Subscription was canceled.')
            ]
        ]);
    }

    /**
     * Change plan of the website
     *
     * @return Response
     */
    public function postPlanChange(WebsitePlanChangeRequest $request)
    {
        var_dump($request->input('plan'));
        var_dump($request->input('password'));
        var_dump($request->input('website'));
        exit;
        $user    = Auth::user();
        $website = Website::find($request->input('website'));
        $plan    = Plan::find($request->input('plan'));
        if (!isset($website)) {
            Response::json(['success' => false, 'message' => trans('Site does not exist.')]);
        }

        if ($website->user_id != $user->id) {
            Response::json(['success' => false, 'message' => trans('Unauthorized.')]);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            Response::json(['success' => false, 'message' => trans('Wrong password.')]);
        }

        $website->subscription(lcfirst($plan->plan))->swap();
        $website->plan_id = $plan->id;
        $website->save();

        $emailVariables = [
            'website' => $website->url,
            'plan'    => $plan
        ];

        Mail::send('emails.website.plan', $emailVariables, function($message) use ($user) {
            $message->to($user->email)->subject(trans('We have changed your plan.'));
        });

        Response::json(['success' => true, 'message' => trans('Your plan has changed')]);
    }



    public function googlePosition() {

        $websites = Website::all();
        $data = array();
        foreach ($websites as $website) {
                foreach ($website->phrases as $phrase) {
                $int = googleScraper::scrape($phrase->phrase, array($website->url));
                $data['position'] = $int;
                $data['website_id'] = $website->id;
                $data['phrase_id'] = $phrase->id;
                $data['additional_data'] = 'asdfasdfasdf';
                $data['created_at'] = date('Y-m-d H:i:s');
                \App\PhraseChecks::inserposition($data);
            }
        }
    }
}
