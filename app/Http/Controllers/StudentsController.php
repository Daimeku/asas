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
	 * loads relevent data and returns the student overview page
	 *
	 * @return Response
	 */
	public function index()
    {
        $user = Auth::user();
        $occurences = $user->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests

        $submissions = Auth::user()->submissions()->with('assessment')->take(10)->get();  //get all submissions, eager load assessments

        //loops through list of assessments and separate tests from assignments

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

        $footerData = $this->getFooterData();
		$data = [

			'user' => Auth::user(),	//returning user object
            'assignments' => $assignments,
            'tests' => $tests,
            'courses' => $courses,
            'pastAssessments' => $pastAssessments,
            'submissions' => $submissions,
            'footerData' => $footerData


		];

		return view('students/overview', $data);
	}

    public function getFooterData(){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = collect();
        $submissions = Auth::user()->submissions()->with('assessment')->take(25)->get();

        foreach($submissions as $submission){
            $assessments->push($submission->assessment);
        }

        $footerData = [
            'courses' => $courses,
            'assessments' => $assessments
        ];

        return $footerData;
    }


    public function assignments(){


        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);


        $submissionAssessments = collect();
        $submissions = Auth::user()->submissions()->with('assessment')->take(10)->get();

        $assignments = collect();
        $tests = collect();

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

        foreach($submissions as $submission){
            $submissionAssessments->push($submission->assessment);
        }


        $data = [
            'user' => Auth::user(),
          'assignments' => $assignments,
          'courses' => $courses,
            'submissionAssessments' => $submissionAssessments
        ];

        return view('students/assignments',$data);

    }

    public function submissions(){

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $submissions = Auth::user()->submissions()->with('assessment')->take(25)->get();

        $submissionGroups = collect();

        foreach($submissions as $submission){
            $assessment = $submission->assessment;
            $course = $assessment->course;

            $group = [
                'submission' => $submission,
                'course' => $course,
                'assessment' => $assessment
            ];
            $submissionGroups->push($group);
        }

        $data = [
            'submissions' => $submissions,
            'courses' => $courses,
            'submissionGroups' => $submissionGroups,
            'submissionAssessments' => []
        ];

        return view('students/submissions', $data);
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
