<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Request;

class Student {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
//        dd(Request::input('user_id'));
        if(! Auth::check()){
            return "USER NOT LOGGED IN";
        }

        if(Auth::user()->user_type != 2){
            return redirect('/');
        }
		return $next($request);
	}

}
