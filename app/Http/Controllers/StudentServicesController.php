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
        return view('studentServices/collectAssignments');
	}

    /*
     * Finds a student based on user_id and ensures they are enrolled
     * for a course matching the course_id
     */
    public function findStudent($user_id, $course_id){
        //find the student
        $student = User::where('user_type',2)->where('id',$user_id)->first();
        //if student isnt found create an error object and return it
        if($student === null){
            $student = new \stdClass();
            $student->errorMessage = "STUDENT NOT FOUND";
            return $student;
        }
        //find the student's occurrence with a matching course id
        $tempCourse = $student->occurrences()->where('course_id',$course_id)->first();
        //if occurrence isnt found then return error object
        if($tempCourse === null){
            $student = new \stdClass();
            $student->errorMessage = "STUDENT NOT REGISTERED FOR THIS COURSE";
            return $student;
        }
        //return the student if found and enrolled for the course
        return $student;
    }

    /*
     * Finds a student submission based on the user_id and submission_id
     * from the request input
     */
    public function findStudentSubmission(){

        $user_id = Request::input('user_id');
        $submission_id = Request::input('submission_id');
        //validate input

        //find student
        $student = User::where('id',$user_id)->where('user_type',2)->first();
        //if student isnt found return error
        if($student == null){
            return redirect()->back()->with('error','Student not found');
        }
        //find submission that is hardcopy or hard/soft copy that hasn't been accepted yet
        $submission = Submission::where('id',$submission_id)->where('submission_type',1)->orWhere('submission_type',3)->first();
        if($submission == null){
            return redirect()->back()->with('error','Submission not found');
        }

        //check if submission has already been accepted
        if($submission->accepted == true){
            return redirect()->back()->with('error', 'submission as already been accepted');
        }

        $conf = false;
        //check that the requested user actually submitted the assignment
        //foreach user attached to the submission compare their id to the request user_id
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
        //if user matches submission->user_id then return page with student and submission
        if($conf === true){
            return redirect()->back()->with('student',$student->sanitize())->with('submission',$submission);
        }

        //if conf fails return error
        return redirect()->back()->with('error', 'Submission and student do not match');

    }

    /*
     * Marks a submission as accepted
     * and sends confirmation email receipt
     */
    public function acceptStudentSubmission(){
        //get user and submission id from request input
        $user_id = Request::input('user_id');
        $submission_id = Request::input('submission_id');

        //find student and submission
        $student = User::find($user_id);
        $submission = Submission::find($submission_id);

        //if submission isnt found return an error
        if($submission == null){
           return redirect()->back()->with('error', 'submission not found');
        }
        //update submission->accepted and save
        $submission->accepted = true;
        $submission->save();

        //load data for email
        $data = [
            'submission' => $submission,
            'assessment' => $submission->assessment,
            'student' => $student->sanitize()
        ];

        //send email receipt
        Mail::send('emails/receipt',$data, function($message){
            $message->from('ASAS-TEST@gmail.com');
            $message->to('daimeku@gmail.com', 'Ashani kentish')->subject('Assignment submitted');
        });

        //if successful redirect back with success message
        return redirect()->back()->with('success','Assignment successfully accepted');
    }

}
