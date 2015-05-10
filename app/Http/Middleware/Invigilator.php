<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class Invigilator {

	/**
	 * Handle an incoming request.
	 *
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
