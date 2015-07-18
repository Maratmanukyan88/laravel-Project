<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\CreateRequest as WebsiteCreateRequest;
use App\Http\Requests\Website\PlanChangeRequest as WebsitePlanChangeRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Website;
use App\Plan;
use App\User;
use App\googleScraper;
use Auth;
use Mail;

class AdminController extends Controller {

    /**
     * Create a new authentication controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('csrf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        return redirect('admin/website/listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getListing()
    {
        $websites = Website::all();
        $plans    = Plan::all();
        $users    = User::all();
        return view('website.admin.listing')
                ->with([
                    'websites' => $websites,
                    'plans'    => $plans,
                    'users'    => $users,
                ]);
    }

    /**
     * Delete resource
     *
     * @return Response
     */
    public function getDelete($id)
    {
        $website = Website::findOrFail($id);
        $user    = User::findOrFail($website->user_id);

        // send e-mail
        $emailVariables = ['website' => $request->input('url')];

        Mail::send('emails.website.delete', $emailVariables, function($message) use ($user) {
            $message->to($user->email)->subject(trans('Your website was deleted.'));
        });

        $website->subscription()->cancel();
        $website->delete();

        return redirect('admin/website/listing')->with([
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
    public function ajaxPlanChange(WebsitePlanChangeRequest $request)
    {
        $website = Website::find($id);
        $user    = User::find($website->user_id);
        $plan    = Plan::find($request->input('plan'));

        if (!isset($website)) {
            Response::json(['success' => false, 'message' => trans('Site does not exist.')]);
        }

        if (!isset($user)) {
            Response::json(['success' => false, 'message' => trans('User does not exist.')]);
        }

        $user->subscription(lcfirst($plan->plan))->swap();

        $emailVariables = [
            'website' => $website->url,
            'plan'    => $plan
        ];

        Mail::send('emails.website.plan', $emailVariables, function($message) use ($user) {
            $message->to($user->email)->subject(trans('We have changed your plan.'));
        });

        Response::json(['success' => true, 'message' => trans('Your plan has changed')]);
    }
}
