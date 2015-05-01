<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;

use Auth;
use DB;
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

        $this->validate(Request::instance(),[
            'title' => 'Required',
            'description' => 'required|',
            'filepath' => '',
            'start_date' => 'date|required',
            'end_date' => 'date|required',
            'assessment_type' => 'required|numeric',
            'course_id' => 'required|numeric'

        ]);

        // check if teacher is assigned to a course with a matching course_id
        $occurences = Auth::user()->occurences;
        foreach($occurences as $occurence){

            if($occurence->course_id == intval(Request::input('course_id'))){

                if($occurence->end_date > date('Y-m-d H:i:s')){
                    echo("course assigned");
                }
            }
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



}
