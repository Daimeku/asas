<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;

use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Assessment;
use App\Models\Occurence;

class TeachersController extends Controller {

    public function __construct(){
        $this->middleware("teacher");
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests

        $submissions = Auth::user()->submissions()->with('assessment')->take(10)->get();  //get all submissions, eager load assessments

        //loops through list of active assessments and separates tests from assignments

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

        foreach($courses as $course){
            echo json_encode($course->assessments, JSON_PRETTY_PRINT);
        }

        $data =[
            'courses' => $courses,
            'assignments' => $assignments,
            'tests' => $tests
        ];
        dd($data);
	}


    public function uploadAssignment(){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);

        $data = [
            'courses' => $courses
        ];

        return view('lecturers/createAssignment');


    }
    /*
     * create a new assignment
     */

    public function createAssessment(){

        //create validator and check for correct user input
        $val = Validator::make(Request::all(),[
            'title' => 'Required',
            'description' => 'required|',
            'filepath' => '',
            'start_date' => 'date|required',
            'end_date' => 'date|required',
            'assessment_type' => 'required|numeric',
            'course_id' => 'required|numeric'

        ]);
        // if validation fails return to the previous page with the validator errors
        if($val->fails()){
            return redirect()->back()->withInput()->withErrors($val->errors()->all());
        }

        // check if teacher is assigned to a course with a matching course_id
        if(!$this->checkCourseID(Request::input('course_id')) ){
            return redirect()->back()->withErrors(['error', 'you do not currently have access to that course'])->withInput();
        }

        $start_date = new Carbon(Request::input('start_date'));
        $end_date = new Carbon(Request::input('end_date'));

        $assessment = new Assessment;

        $assessment->title = Request::input('title');
        $assessment->description = Request::input('description');
        $assessment->filepath = Request::input('filepath');
        $assessment->start_date = $start_date;
        $assessment->end_date = $end_date;
        $assessment->assessment_type = Request::input('assessment_type');
        $assessment->course_id = Request::input('course_id');
        $assessment->save();
        dd($assessment);

        $data = [];
        dd($data);
    }

    public function submissions(){


    }

    /**
     * checks if the course_id matches a course the teacher has access to
     */
    public function checkCourseID($course_id)
    {
        $occurences = Auth::user()->occurences;
        $conf = false;
        foreach ($occurences as $occurence) {

            if ($occurence->course_id === intval($course_id)) {

                if ($occurence->end_date > date('Y-m-d H:i:s')) {
                    $conf = true;
                }
            }
        }
        return $conf;
    }


}
