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
        //attach auth middleware to ensure login before accessing this controller
		$this->middleware('auth');
	}

	/**
	 * redirects the user to their personalized overview screen
	 * compares user_type
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

        if(Auth::user()->user_type === 3)   // if user is student services then return them to studentServices
        {
            return redirect()->route('studentServices/home');
        }

        if(Auth::user()->user_type === 4)   // if user is a student then return them to student home
        {
            return redirect()->route('invigilators/home');
        }


        //if user an appropriate type then display the error page
		return view('errors/error')->with('error','Your user type was not found, try logging in again');
	}



}
