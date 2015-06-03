<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class Invigilator {

	/**
	 * Handle an incoming request.
	 *check if user is an inviglator, if not redirect them to the homecontroller
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
        if(! Auth::check()){
            return redirect()->route('login');
        }

        if(Auth::user()->user_type != 4){
            return redirect('/');
        }
        return $next($request);
    }
}
