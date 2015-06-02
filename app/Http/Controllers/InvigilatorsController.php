<?php namespace App\Http\Controllers;

use App\Events\PaperWasCollected;
use App\Events\StudentEnteredTest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Submission;
use App\Models\Assessment;
use DB;


class InvigilatorsController extends Controller {

    /*
     * Check to ensure user is an invigilator using middleware
     */
    public function __construct(){
        $this->middleware("invigilator");
    }

	/**
	 * Display the home page for this invigilator
	 * @return invigilators/schedule
	 */
	public function index()
	{
        //load all active tests in system
		$tests = Assessment::where('end_date', '>', date("Y-m-d"))->with('course')->get();
        //if tests are empty return
        if($tests === null){
            return redirect()->route('invigilators/error')->with('error','No upcoming tests available');
        }

        //load upcoming tests from DB
        $tests = $tests->where('assessment_type',2);

        //populate and return data array with view
        $data = [
            'tests' => $tests->reverse(),
        ];

        return view('invigilators/schedule', $data);
	}

    /*
     * displays json form a single test
     */
    public function test($assessment_id){

        $test = $this->findTest($assessment_id);
        $data = [
            'test' => $test
        ];
        dd($data);
    }

    /*
     * displays studentEntry  view where invigilators can enter students into a test
     * Loads student based on id number and appropriate access to the course/test
     */
    public function studentEntry($assessment_id, $user_id){

        $error = null;
        $student = null;

        //find the appropriate test, course & occurrences
        $test = $this->findTest($assessment_id);
        $course = $test->course;
        $occurrences = $course->occurrences;

//        Check that test is currently underway or almost ready
//        if(!$this->checkOccurrenceTime($occurrences)){
//            return redirect()->route('invigilators/error')->with('error','It is not time for this test');
//        }

//        find the appropriate student
        $student = $this->findStudent($user_id,$course->id);

        //if student has no input then santize model to return to user
        if($student->errorMessage === null){
            $student = $student->sanitize();
        }
        else{
            $error = $student;
            return redirect()->route('invigilators/studentEntryEmpty',['assessment_id'=>$test->id])->with('error', $student->errorMessage);
        }

        $data = [
            'test' => $test,
            'course' => $course,
            'student' => $student,
            'occurrence' => $occurrences->first(),
            'error' => $error
        ];

        return view('invigilators/studentsEntry', $data);
    }

    /*
     * Display page to collect papers
     */
    public function paperCollection($assessment_id){

        $test = $this->findTest($assessment_id);

        //get student and ensure student has an existing submission for this test
        //fire event to update submission and send email

        $data = [
            'test' => $test,
            'course'=> $test->course,
            'message' => null

        ];
        return view('invigilators/paperCollection', $data);

    }

    public function collectPaper($assessment_id){

        //get user id and paper_id from form input
        $user_id = Request::input('user_id');
        $paper_id = Request::input('paper_id');

        //check if student is registered for test
        $test = $this->findTest($assessment_id);

        $student = $this->findStudent($user_id, $test->course->id);
        if($student->errorMessage != null){

            return redirect()->back()->with('error',$student->errorMessage);

        }

        //check if student entered the test
        if($student->errorMessage === null){
            $checkSubmission = $student->submissions()->where('assessment_id', $test->id)->first();
            if($checkSubmission === null){
                return redirect()->back()->with('error',"No record of student entry");

            }
            else{
                $user_submission = DB::table('user_submissions')->where('user_id',$student->id)->where('submission_id',$checkSubmission->id)->first();

                if($user_submission->paper_collected == true){
                    return redirect()->back()->with('error',"Student already submitted paper");
                }
            }
        }

        \Event::fire(new PaperWasCollected($student->id,$test->id,$paper_id));

        //
        $message = "paper successfully added";
        $data = [
            'test' => $test,
            'course'=> $test->course,
            'success' => $message

        ];

        return redirect()->back()->with('success',$message);

    }

    /*
     * Default student entry page
     */
    public function studentEntryEmpty($assessment_id){
        $error = null;
        $test = $this->findTest($assessment_id);
        $occurrences = $test->course->occurrences; // build list of active tests

        $course = $test->course;

        $data = [
            'test' => $test,
            'course' => $course,
            'student' => new \stdClass(),
            'occurrence' => $occurrences->first(),
            'error' => $error
        ];
        return view('invigilators/studentsEntryEmpty', $data);
    }

    /*
     * Finds a particular test that is still active or upcoming
     */
    public function findTest($assessment_id){

        $test = Assessment::find($assessment_id);

        //if test isnt found
        if($test === null){
            dd("assessment not found");
        }

        $date = new Carbon(date('Y-m-d H:i:s'));
        //if end date has passed
        if(!($test->end_date >= $date)){
            dd("Assessment end date passed");
        }

        //if assessment is an assignment
        if($test->assessment_type != 2){
            dd("ASSESSMENT IS NOT A TEST");
        }

        return $test;
    }

    /*
     * ensures that occurrence time and current time match, so students arent entered into tests before start_time and after end_time
     */
    public function checkOccurrenceTime($occurrences){
        $conf=false;
        $currentTime = date('Y-m-d H:i');

        //foreach occurrence see if a time is associated with the current time
        foreach($occurrences as $occurrence){
            if( strcasecmp(substr($occurrence->day->day,0,3), date('D') ) === 0 ){

                $startTime = date('Y-m-d H:i',strtotime($occurrence->start_time));
                $endTime = date('Y-m-d H:i',strtotime($occurrence->end_time));

                if( ($currentTime>= $startTime) && ($currentTime <= $endTime) ){
                    $conf=true;
                }

            }

        }

        return $conf;
    }

    /*
     * Finds a student and verifies that they are registered for a particular course
     * accepts student id and course id
     * returns the student or an error object
     */
    public function findStudent($user_id, $course_id){

        //get student from users table, that matches id
        $student = User::where('user_type',2)->where('id',$user_id)->first();

        //if student isnt found create and return an error object
        if($student === null){
            $student = new \stdClass();
            $student->errorMessage = "STUDENT NOT FOUND";
            return $student;
        }

        //find the course and check if student is registered for it
        $tempCourse = $student->occurrences()->where('course_id',$course_id)->first();
        if($tempCourse === null){
            $student = new \stdClass();
            $student->errorMessage = "STUDENT NOT REGISTERED FOR THIS COURSE";
            return $student;
        }
        return $student;

    }

    //manage incoming search requests
    public function searchStudent($assessment_id){
        $student_id = Request::input('student_id');

        return redirect()->route('invigilators/studentEntry',['assessment_id'=>$assessment_id, 'user_id'=>$student_id]);
    }

    /*
     * Accepts a test and student id and enters the student into the test by
     * creating a submission linked to that test and leaving it unnaccepted until the paper is collected
     * returns a redirect with success or failure attached to session
     */
    public function enterTest($test_id, $user_id){
        $test = $this->findTest($test_id);
        $student = $this->findStudent($user_id, $test->course->id);
        $checkSubmission = $student->submissions()->where('assessment_id', $test->id)->first();

        //check if submission exists for this student and course already
        if($checkSubmission != null){
            return redirect()->back()->with('error','student has already entered the test');
        }

        //create submission and assign properties
        $submission = new Submission;
        $submission->time = date('Y-m-d H:i:s');
        $submission->accepted = false;
        $submission->submission_type = 1;
        $submission->assessment_id = $test->id;

        //save the submission
        $submission->save();

//      create an entry in the user_submissions table
        DB::table('user_submissions')->insert([
            'submission_id' => $submission->id,
            'user_id' => $student->id,
            'entered_test' => true

        ]);

        //fire the entered test event to log data and send email
        \Event::fire(new StudentEnteredTest($student->id, $submission->id));

        return redirect()->route('invigilators/studentEntry',['assessment_id'=>$test->id,'user_id'=>$student->id])->with('success','student successfully added');

    }

    /*
     * Display errors from session data
     */
    public function showError(){
        $error = Session::get('error');

        $data = [
            'error' => $error,
        ];

        return view('invigilators/error_page', $data);

    }

}
