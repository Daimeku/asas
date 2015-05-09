<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/*
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::user()->user_type === 1){
            return redirect()->route('teachers/home');
        }

        if(Auth::user()->user_type === 2)   // if user is a student then return them to student home
        {
            return redirect()->route('students/home');
        }



        //if user isnt either type display welcome page
		return view('welcome');
	}



}
