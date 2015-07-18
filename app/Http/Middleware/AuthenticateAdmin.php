<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateAdmin implements Middleware {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{     
		if ($this->auth->guest()) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->guest('auth/login');
			}
        } else {
            if ($this->auth->user()->role != 1) {
                return response('Access denied.', 403);
            }
        }

 		return $next($request);
	}

}
