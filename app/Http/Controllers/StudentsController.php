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
//        dd($data);
		return view('students/overview', $data);
	}




    public function assignments(){


        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);

        $submissionAssessments = collect();
        $submissions = Auth::user()->submissions()->with('assessment')->get();
        //remove assessments that are already submitted
        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);


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

        $footerData = $this->getFooterData();

        $data = [
            'user' => Auth::user(),
          'assignments' => $assignments,
          'courses' => $courses,
            'footerData' => $footerData
        ];

        return view('students/assignments',$data);

    }
    /*
     * loops through assessments and submissions and builds a list of assessments that havent been submitted by this user
     */

    public function checkSubmittedAssessments($assessments, $submissions){
        $newAssessments = collect();
        foreach($assessments as $assessment){
            $conf = false;
            foreach($submissions as $submission){
                if((intval($submission->assessment_id) === intval($assessment->id)) ){
                    $conf=false;
                    break;
                }else{

                    $conf = true;
                }
            }

            if($conf === true){
                $newAssessments->push($assessment);
            }

        }
        $assessments = $newAssessments;
        return $assessments;
    }

    public function tests(){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $tests = collect();

        foreach($assessments as $assessment){

           if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

        $footerData = $this->getFooterData();

        $data = [
            'user' => Auth::user(),
            'tests' => $tests,
            'courses' => $courses,
            'footerData' => $footerData
        ];


        dd($data);

    }
    public function submissions(){

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
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
        $footerData = $this->getFooterData();

        $data = [
            'submissions' => $submissions,
            'courses' => $courses,
            'submissionGroups' => $submissionGroups,
            'footerData' => $footerData
        ];

        return view('students/submissions', $data);
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


    public function uploadAssignment($assessment_id){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $submissions = Auth::user()->submissions;

        //checks if the user is assigned to the current assessment
        if(!($this->checkAssessmentBelongs($assessments,$assessment_id)) ){
            return "ASSIGNMENT NOT ASSIGNED TO THIS USER";
        }

        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);

        //checks to make sure that the user has permission to upload the chocsen assessment
        //scans list of assessments and finds one with an id matching the assessment_id param
        $currentAssessment = null;
        $conf = false;
        foreach($assessments as $assessment){
            if(intval($assessment_id) === $assessment->id){
                $currentAssessment = $assessment;
                $conf=true;
                break;
            }
        }


        if($conf!=true){
            return "ASSIGNMENT NOT FOUND FOR THIS USER. Possible duplicate submission.";
        }
        if($currentAssessment->assessment_type !=1){
            return "YOU ARE ATTEMPTING TO UPLOAD A TEST. ONLY ASSIGNMENTS CAN BE UPLOADED.";
        }



        $data = [
            'user' => Auth::user(),
            'assessment' => $currentAssessment,
        ];

        return view('students/upload', $data);

    }

    public function checkAssessmentBelongs($assessments, $assessment_id){
        $conf = false;
        foreach($assessments as $assessment){
            if(intval($assessment_id) === $assessment->id){
                $conf = true;
            }
        }
        return $conf;
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
        else{
            return "FILE NOT VALID";
        }



    }


}
