<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;
use App\Models\Assessment;
use App\Models\Submission;
use App\Models\User;

class StudentServicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$student = $this->findStudent(2,2);
        return view('studentServices/collectAssignments');
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

    public function findStudentSubmission(){

        $user_id = Request::input('user_id');
        $submission_id = Request::input('submission_id');
        //validate input

        //find student
        $student = User::where('id',$user_id)->where('user_type',2)->first();
        if($student == null){
            return redirect()->back()->with('error','Student not found');
        }
//        $student = User::where('id',$user_id)->where('user_type',2);
        //find submission that is hardcopy or hard/soft copy that hasn't been accepted yet
        $submission = Submission::where('id',$submission_id)->where('submission_type',1)->orWhere('submission_type',3)->first();
        if($submission == null){
            return redirect()->back()->with('error','Submission not found');
        }

        //check if submission has already been accepted
//        dd($submission->accepted);
        if($submission->accepted == true){
            return redirect()->back()->with('error', 'submission as already been accepted');
        }

        $conf = false;
        foreach($submission->users as $user){
            if($user->id == $user_id){
                $conf = true;
                break;
            }
        }

        $studentData = [
            'student' => $student->sanitize(),
            'submission' => $submission
        ];
        if($conf === true){
            return redirect()->back()->with('student',$student->sanitize())->with('submission',$submission);
        }

        return redirect()->back()->with('error', 'Submission and student do not match');

    }

    public function acceptStudentSubmission(){
        $user_id = Request::input('user_id');
        $submission_id = Request::input('submission_id');

        $student = User::find($user_id);
        $submission = Submission::find($submission_id);
        if($submission == null){
           return redirect()->back()->with('error', 'submission not found');
        }
        $submission->accepted = true;
        $submission->save();
        $data = [
            'submission' => $submission,
            'assessment' => $submission->assessment,
            'student' => $student->sanitize()
        ];

        Mail::send('emails/receipt',$data, function($message){
            $message->from('ASAS-TEST@gmail.com');
            $message->to('daimeku@gmail.com', 'Ashani kentish')->subject('Assignment submitted');
        });
//        $rows = DB::table('user_submissions')->where('user_id',$user_id)->where('submission_id',$submission_id)
//            ->update(['paper_collected'=>1]);
        return redirect()->back()->with('success','Assignment successfully accepted');
    }

}
