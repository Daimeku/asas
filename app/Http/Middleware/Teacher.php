<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class Teacher {

	/**
	 * Handle an incoming request.
	 * check if user is a teacher and redirect if not
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(! Auth::check()){
            return redirect()->route('login');
        }

        if(Auth::user()->user_type != 1){
            return redirect('/');
        }
		return $next($request);
	}

}
