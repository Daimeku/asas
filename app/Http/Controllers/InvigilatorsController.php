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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = Assessment::where('end_date', '>', date("Y-m-d"))->with('course')->get();

        if($tests === null){
            dd("NO UPCOMING AVAILABLE");
        }
        $tests = $tests->where('assessment_type',2); //->where('end_date', '>', date("Y-m-d"));

        $data = [
            'tests' => $tests,
        ];

        return view('invigilators/schedule', $data);
	}

    public function test($assessment_id){

        $test = $this->findTest($assessment_id);
        $data = [
            'test' => $test
        ];
        dd($data);
    }

    public function studentEntry($assessment_id, $user_id){
//        dd($assessment_id);
        $error = null;
        $student = null;
        $test = $this->findTest($assessment_id);
        $course = $test->course;
        $occurrences = $course->occurrences;

//        if(!$this->checkOccurrenceTime($occurrences)){
//            return redirect()->route('invigilators/error')->with('error','It is not time for this test');
//        }


        $student = $this->findStudent($user_id,$course->id);


        if($student->errorMessage === null){
//            $checkSubmission = $student->submissions()->where('assessment_id', $test->id)->first();
//            if($checkSubmission != null){
//                dd($checkSubmission);
//                $error = new \stdClass();
//                $error->errorMessage = "STUDENT ALREADY ENTERED TEST";
//               $student = null;
//            }else{
//                $student = $student->sanitize();
//            }

            $student = $student->sanitize();
        }
        else{
//            dd("here");
            $error = $student;
            return redirect()->route('invigilators/studentEntryEmpty',['assessment_id'=>$test->id])->with('error', $student->errorMessage);
//            $student = new \stdClass();
//            $error->message = "STUDENT NOT FOUND";
        }

        $data = [
            'test' => $test,
            'course' => $course,
            'student' => $student,
            'occurrence' => $occurrences->first(),
            'error' => $error
        ];
//         dd($data);

        return view('invigilators/studentsEntry', $data);
    }

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
        dd($student);

    }

    public function studentEntryEmpty($assessment_id){
        $error = null;
        $test = $this->findTest($assessment_id);
        $occurrences = $test->course->occurrences; // build list of active tests


//        if(!$this->checkOccurrenceTime($occurrences)){
//            return redirect()->route('invigilators/error')->with('error','It is not time for this test');
//        }

        // build time as string and check current time against list of possible test times
        $course = $test->course;

        $data = [
            'test' => $test,
            'course' => $course,
            'student' => new \stdClass(),
            'occurrence' => $occurrences->first(),
            'error' => $error
        ];
        return view('invigilators/studentsEntryEmpty', $data);
        // dd($data);
    }

    public function findTest($assessment_id){
        $test = Assessment::find($assessment_id);
        if($test === null){
            dd("assessment not found");
        }
        $date = new Carbon(date('Y-m-d H:i:s'));
        if(!($test->end_date >= $date)){
            dd("Assessment end date passed");
        }

        if($test->assessment_type != 2){
            dd("ASSESSMENT IS NOT A TEST");
        }

        return $test;
    }

    public function checkOccurrenceTime($occurrences){
        $conf=false;
        $currentTime = date('Y-m-d H:i');
//        dd($occurrences);
        foreach($occurrences as $occurrence){
            if( strcasecmp(substr($occurrence->day->day,0,3), date('D') ) === 0 ){
//                $currentTime = date('H:i');
//                dd($currentTime= strtotime('22:00'));
//                dd($currentTime);
                $startTime = date('Y-m-d H:i',strtotime($occurrence->start_time));
                $endTime = date('Y-m-d H:i',strtotime($occurrence->end_time));

                if( ($currentTime>= $startTime) && ($currentTime <= $endTime) ){
                    $conf=true;
                }

            }

        }

        return $conf;
    }

    public function findStudent($user_id, $course_id){
        $student = User::where('user_type',2)->where('id',$user_id)->first();
        if($student === null){
            $student = new \stdClass();
            $student->errorMessage = "STUDENT NOT FOUND";
            return $student;
        }

        $tempCourse = $student->occurrences()->where('course_id',$course_id)->first();
        if($tempCourse === null){
            $student = new \stdClass();
            $student->errorMessage = "STUDENT NOT REGISTERED FOR THIS COURSE";
            return $student;
        }
        return $student;

    }

    public function searchStudent($assessment_id){
        $student_id = Request::input('student_id');

        return redirect()->route('invigilators/studentEntry',['assessment_id'=>$assessment_id, 'user_id'=>$student_id]);
    }

    public function enterTest($test_id, $user_id){
        $test = $this->findTest($test_id);
        $student = $this->findStudent($user_id, $test->course->id);
        $checkSubmission = $student->submissions()->where('assessment_id', $test->id)->first();

        if($checkSubmission != null){
            return redirect()->back()->with('error','student has already entered the test');
        }

        $submission = new Submission;
        $submission->time = date('Y-m-d H:i:s');
        $submission->accepted = false;
        $submission->submission_type = 1;
        $submission->assessment_id = $test->id;
//        dd($submission);
        $submission->save();

//         create an entry in the user_submissions table
        DB::table('user_submissions')->insert([
            'submission_id' => $submission->id,
            'user_id' => $student->id,
            'entered_test' => true

        ]);
        \Event::fire(new StudentEnteredTest($student->id, $test->id));

        return redirect()->route('invigilators/studentEntry',['assessment_id'=>$test->id,'user_id'=>$student->id])->with('success','student successfully added');

    }

    public function showError(){
        $error = Session::get('error');

        $data = [
            'error' => $error,
        ];

        return view('invigilators/error_page', $data);

    }

}
