<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Models\Submission;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Course;

class StudentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// if user isnt a student then display an error
		if (\Auth::user()->user_type != 2) {
			$data = "unauthorized access";
			return view('error', $data);
		}

		$data = [

			'user' => Auth::user(),		//returning user object			

			'current_courses' => DB::table('user_courses')		//get courses user is currently	
					->where('user_id', '=', Auth::user()->id)	//registered for.
					->where('end_date',  '>', date('Y-m-d H:i:s'))->get()
		];

		// dd($data['current_courses']);

		return view('students/overview', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function uploadAssignment($id){

        return view('students/upload');

    }

    public function upload(){
        $file = Request::file('assessment');

        if($file->isValid()){
            echo $file->getClientOriginalName();


            $filePath = base_path()."/database/files/submissions/";
            $file->move($filePath,"submission");

            // create an entry in the submissions table
            $submission = new Submission;
            $submission->file_path = $filePath . "submission";
            $submission->time = date('Y-m-d H:i:s');
            $submission->accepted = true;
            $submission->submission_type = 2;
            $submission->assessment_id = Request::input('assessment_id');
            $submission->save();


            // create an entry in the user_submissions table

            DB::table('user_submissions')->insert([
               'submission_id' => $submission->id,
                'user_id' => Request::input('user_id')
            ]);

        }


//        $user = Auth::user();
//        $occurences = $user->occurences;
//        $courses = Auth::user()->findCourses($occurences);
//        dd($courses);
    }

    public function getFilePath($file, $id){

    }

}