<?php namespace App\Http\Controllers;

use App\Events\StudentEnteredTest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Submission;
use App\Models\Assessment;
//use App\Events\Event;


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
        dd($data);
	}

    public function test($assessment_id){

        $test = $this->findTest($assessment_id);
        $data = [
            'test' => $test
        ];
        dd($data);
    }

    public function studentEntry($assessment_id, $user_id){
        $test = $this->findTest($assessment_id);
        $course = $test->course;

        $student = $this->findStudent($user_id,$course->id);
        $data = [
            'test' => $test,
            'course' => $course,
            'student' => $student
        ];
        $this->enterTest($student->id, $test->id);
        return view('invigilators/studentsEntry', $data);
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

    public function findStudent($user_id, $course_id){
        $student = User::where('user_type',2)->where('id',$user_id)->first();
        if($student === null){
            return null;
        }

        $tempCourse = $student->occurences()->where('course_id',$course_id)->first();
        return $student->sanitize();

    }

    public function enterTest($user_id, $test_id){
        $test = $this->findTest($test_id);
        $student = $this->findStudent($user_id, $test->course->id);


        \Event::fire(new StudentEnteredTest($student->id, $test->id));
        $submission = new Submission;
        $submission->time = date('Y-m-d H:i:s');
        $submission->accepted = false;
        $submission->submission_type = 1;
        $submission->assessment_id = $test->id;
        dd($submission);
        $submission->save();

        // create an entry in the user_submissions table
        DB::table('user_submissions')->insert([
            'submission_id' => $submission->id,
            'user_id' => $student->id
        ]);


    }

}
