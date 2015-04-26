<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Models\Submission;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Course;
use App\Models\Assessment;

class StudentsController extends Controller {

    public function __construct(){
        $this->middleware("student");
    }

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

                $user = Auth::user();
        $occurences = $user->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $submissionAssessments = collect();
        $assignments = collect();
        $tests = collect();

            $submissions = Auth::user()->submissions()->with('assessment')->take(10)->get();
        foreach($submissions as $submission){
            $submissionAssessments->push($submission->assessment);
        }

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }
		$data = [

			'user' => Auth::user(),	//returning user object
            'assignments' => $assignments,
            'tests' => $tests,
            'courses' => $courses,
            'pastAssessments' => $pastAssessments,
            'submissions' => $submissions,
            'submissionAssessments' => $submissionAssessments


		];
//        dd($data);

		return view('students/overview', $data);
	}

    public function assignments($id){

            return view('students/assignment');

    }

    public function assignment($assignment_id){

        $assignment = Assessment::find($assignment_id);
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $course = $assignment->course;
        $submissionAssessments = collect();
        $submissions = Auth::user()->submissions()->with('assessment')->take(10)->get();
        foreach($submissions as $submission){
            $submissionAssessments->push($submission->assessment);
        }

        $data = [
            'user' => Auth::user(),
          'assignment' => $assignment,
          'course' => $course,
          'courses' => $courses,
            'submissionAssessments' => $submissionAssessments
        ];
        return view('students/assignment',$data);

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



    }

    public function getFilePath($file, $id){

    }

}
