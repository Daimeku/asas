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
use App\Models\Submission;

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
            'submissions' => $submissions,
            'tests' => $tests
        ];

        dd($data);
	}

    public function assignments(){

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $assignments = collect();   // stores upcoming assignments
        $pastAssignments = collect();

        //loops through list of active assessments and separates tests from assignments

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }

        }

        foreach($pastAssessments as $assessment){
            if($assessment->assessment_type === 1){
                $pastAssessments->push($assessment);
            }

        }

        $data = [
            'assignments' => $assignments,
            'pastAssignments' => $pastAssignments
        ];
        dd($data);

    }

    public function assignment($assignment_id){
        $assignment = Assessment::find($assignment_id);
        if($assignment === null){
            dd("Assignment not found");
        }
        if(!$this->checkCourseID($assignment->course_id)){
            dd("YOU DO NOT HAVE ACCESS TO THIS COURSE");
        }
        $submissions = $assignment->submissions;

        $data = [
            'assignment' => $assignment,
            'submissions' => $submissions
        ];

        dd($data);
    }


    public function uploadAssignment(){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);

        $data = [
            'courses' => $courses
        ];

        return view('lecturers/createAssignment_test',$data);


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
            'end_date' => 'date',
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
        $file = Request::file('assessment');

        $assessment = new Assessment;

        $assessment->title = Request::input('title');
        $assessment->description = Request::input('description');
        $assessment->start_date = $start_date;
        $assessment->assessment_type = Request::input('assessment_type');
        $assessment->course_id = Request::input('course_id');

        if($assessment->assessment_type === 2){
            $assessment->time = Request::input('time');
        }else{
            $end_date = new Carbon(Request::input('end_date'));
            $assessment->end_date = $end_date;

        }
        $assessment->save();

        if($file->isValid()){
            $filePath = "/database/files/assessments/$assessment->id";
            $file->move($filePath,"assessment");
        }

        $assessment->filepath = $filePath;

        $assessment->save();

        $data = [];
        return redirect()->route('teachers/assignments');
    }

    public function submissions(){
        $submissions = $this->findSubmissions();

        $data = [
            'submissions' => $submissions
        ];
        dd($data);
    }

    public function submission($submission_id){

        $submission = $this->findSubmission($submission_id);

        $data = [
            'submission' => $submission
        ];

        dd($data);
    }

    /*
     * find submissions for courses the user is currently assigned to
     * organizes the submissions by course and returns an
     * array of accepted & unaccepted submissions
     */

    public function findSubmissions(){

        // get list of assessments
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);

        $acceptedSubmissions = [];  // submissions that have already been accepted (accepted=true)
        $unacceptedSubmissions = []; // submissions that haven't been accepted (accepted=false)

        //initialize an array key for each course and set the value to an empty collection
        foreach($assessments as $assessment){
            $course = Course::find($assessment->course_id);
            $acceptedSubmissions[$course->name] = collect();
            $unacceptedSubmissions[$course->name] = collect();

        }

        //loop through assessments and retrieves accepted & unnacepted submissions
        foreach($assessments as $assessment){

            $tempUASubmissions = Submission::where('assessment_id',$assessment->id)->where('accepted',false)->with('users')->get(); // get all unaccepted submissions
            $tempASubmissions = Submission::where('assessment_id',$assessment->id)->where('accepted',true)->with('users')->get(); // get all accepted submissions
            $course = Course::find($assessment->course_id);

            //loops through UASubmissions and adds each submission to the collection
            foreach($tempUASubmissions as $sub){
                $sub->userList = $sub->users; // list of all users that submitted this assignment
                $unacceptedSubmissions[$course->name]->push($sub);
            }
            //loops through ASubmissions and adds each submission to the collection
            foreach($tempASubmissions as $sub){
                $sub->userList = $sub->users;   // list of all users that submitted this assignment
                $acceptedSubmissions[$course->name]->push($sub);
            }

        }

        //the final array containing both accepted and unnaccepted submissions will be returned
        $submissions = [
            'accepted' => $acceptedSubmissions,
            'unaccepted' => $unacceptedSubmissions
        ];

        return $submissions;
    }

    /*
     * accepts an id and returns a single submission that belongs to a course the user has access to
     */
    public function findSubmission($id){

        $submission = Submission::find($id);
        if($submission === null){
            $error = [ "ERROR SUBMISSION NOT FOUND"];
            dd( "ERROR SUBMISSION NOT FOUND");
        }

        if (!$this->checkCourseID($submission->assessment->course->id)){
            dd("ERROR YOU DO NOT CURRENTLY HAVE ACCESS TO THAT COURSE'S SUBMISSIONS");
        }
        $submission->userList = $submission->users;
        return $submission;

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
