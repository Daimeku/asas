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
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Symfony\Component\Finder\SplFileInfo;

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

//        $submissions = Auth::user()->submissions()->with('assessment')->take(10)->get();  //get all submissions, eager load assessments
        $submissions = collect();
        foreach($assessments as $assessment){
            $subs = $assessment->submissions;
            if($subs !=null){
                foreach($subs as $submission){
                    $submissions->push($submission);
                }
            }
        }
        //loops through list of active assessments and separates tests from assignments

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

//        foreach($courses as $course){
//            echo json_encode($course->assessments, JSON_PRETTY_PRINT);
//        }
        $footerData = $this->getFooterData();
        $data =[
            'courses' => $courses->reverse(),
            'assignments' => $assignments->reverse(),
            'submissions' => $submissions->reverse(),
            'tests' => $tests->reverse(),
            'footerData' => $footerData
        ];

        return view('lecturers/overview',$data);
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
                $pastAssignments->push($assessment);
            }

        }

        $footerData = $this->getFooterData();

        $data = [
            'assignments' => $assignments->reverse(),
            'pastAssignments' => $pastAssignments->reverse(),
            'footerData' => $footerData
        ];

        return view('lecturers/viewAssignments', $data);
    }

    public function tests(){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests

        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

        foreach($pastAssessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }
        $footerData= $this->getFooterData();
        $data =[
            'tests' => $tests,
            'footerData' => $footerData
        ];
//        dd($tests);


        return view('lecturers/viewTests', $data);
    }

    public function assessment($assessment_id){
        $assessment = Assessment::find($assessment_id);
        if($assessment === null){
            dd("assessment not found");
        }
        if(!$this->checkCourseID($assessment->course_id)){
            dd("YOU DO NOT HAVE ACCESS TO THIS COURSE");
        }
        $submissions = $assessment->submissions;

        $footerData = $this->getFooterData();
        $data = [
            'assessment' => $assessment,
            'submissions' => $submissions,
            'footerData' => $footerData
        ];

        return view('lecturers/assessment', $data);
    }

    public function editAssessment($assessment_id){

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);

        $assessment = Assessment::find($assessment_id);
        if($assessment === null){
            dd("assessment not found");
        }
        if(!$this->checkCourseID($assessment->course_id)){
            dd("YOU DO NOT HAVE ACCESS TO THIS COURSE");
        }

        $coursesArray = [];
        foreach($courses as $course){
            $coursesArray[$course->id] = $course->name;
        }

        $footerData=$this->getFooterData();
        $data = [
          'assessment' => $assessment,
          'courses' => $coursesArray,
          'footerData' => $footerData

        ];

        return view('lecturers/editAssessment', $data);

    }

    public function edit($assessment_id){

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

        $assessment = Assessment::find($assessment_id);
        if($assessment === null){
            dd("assessment not found");
        }
        if(!$this->checkCourseID($assessment->course_id)){
            dd("YOU DO NOT HAVE ACCESS TO THIS COURSE");
        }

        if(Request::input('assessment_type') == 1){
            $file = Request::file('assessment');
            if( ($file !=null) ){

                if($file->isValid()){
                    $filename =Request::input('filename');
                    if($filename == null){
                        $filename = "submission.txt";
                    }
                    $filePath = public_path() . ("\\files\\assessments\\$assessment->id");
                    $file->move($filePath,$filename);
                    $assessment->filepath = ("\\files\\assessments\\$assessment->id\\$filename");
                }

            }
        }
        $assessment->title = Request::input('title');
        $assessment->description = Request::input('description');
        $assessment->start_date = Request::input('start_date');
        $assessment->course_id = Request::input('course_id');

        if($assessment->assessment_type == 1){
            $assessment->end_date = Request::input('end_date');
        }

        $assessment->save();
        return redirect()->back()->with('success', 'Assessment successfully updated');
    }


    public function uploadAssignment(){
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);

        $footerData = $this->getFooterData();
        $data = [
            'courses' => $courses,
            'footerData' => $footerData
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
        $assessment = new Assessment;

        $assessment->title = Request::input('title');
        $assessment->description = Request::input('description');
        $assessment->start_date = $start_date;
        $assessment->assessment_type = Request::input('assessment_type');
        $assessment->course_id = Request::input('course_id');

        //if assessment is a test then add the time to the date
        if($assessment->assessment_type == 2){
            $assessment->start_date = $assessment->start_date->addHours(Request::input('time'));
            $assessment->end_date = $assessment->start_date;

        }
        else //if assessment is an assignment then get the end date from the user input
        {
            $end_date = new Carbon(Request::input('end_date'));
            $assessment->end_date = $end_date;

        }
        $assessment->save();
        if(Request::input('assessment_type') == 1){
            $file = Request::file('assessment');
            if( ($file !=null) ){

                if($file->isValid()){
                    $filename =Request::input('filename');
                    if($filename == null){
                        $filename = "assessment.txt";
                    }
                    $filePath = public_path() . ("\\files\\assessments\\$assessment->id");
                    $file->move($filePath,$filename);
                    $assessment->filepath = ("\\files\\assessments\\$assessment->id\\$filename");
                }

            }
        }

        $assessment->save();

        if($assessment->assessment_type == 1){
            return redirect()->route('teachers/assignments');
        }
        else{
            return redirect()->route('teachers/tests');
        }

    }

    public function submissions(){

        $submissions = $this->findSubmissions();
        $footerData = $this->getFooterData();
        $data = [
            'submissions' => $submissions,
            'footerData' => $footerData

        ];

        return view('lecturers/submissions',$data);
    }

    public function submission($submission_id){

        $submission = $this->findSubmission($submission_id);
        $footerData = $this->getFooterData();

        $data = [
            'submission' => $submission,
            'footerData' => $footerData
        ];

        return view('lecturers/submissions',$data);
    }

    public function deleteAssessment($assessment_id){

        $assessment = Assessment::find($assessment_id);
        if($assessment === null){
            dd("assessment not found");
        }
        if(!$this->checkCourseID($assessment->course_id)){
            dd("YOU DO NOT HAVE ACCESS TO THIS COURSE");
        }
        //delete all submissions for this assessment
        foreach($assessment->submissions as $submission){
            $submission->delete();
        }
        $assessment->delete();

        return redirect()->route('teachers/assignments');
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
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        //add pastAssessments to assessments
        if(!$pastAssessments->isEmpty()){
            $assessments->merge($pastAssessments);
        }

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

    public function getFooterData()
    {
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $submissions = Auth::user()->submissions()->with('assessment')->take(5)->get();

        foreach($submissions as $submission){
            $assessments->push($submission->assessment);
        }

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

        $footerData = [
            'courses' => $courses->take(5),
            'assignments' => $assignments->take(5),
            'tests' => $tests->take(5)

        ];
//        dd($footerData['courses']->count());
        return $footerData;
    }

    public function download()
    {
        $filename = Request::input('filename');


        $file_path = public_path() . $filename;
        $file = new SplFileInfo($file_path, $file_path, 'subpath');
        if (file_exists($file_path))
        {

            $fn = 'submission.txt';
            // Send Download
            return response()->download(($file), $fn, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

}
