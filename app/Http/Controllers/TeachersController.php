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
use App\Models\Occurrence;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\Session;

class TeachersController extends Controller {

    /*
     * attach teacher middleware to ensure only teachers get access to this controller
     */
    public function __construct(){
        $this->middleware("teacher");
    }

	/**
	 * Displays a personalized overview screen
     * loads number of courses, assignments, tests and submissions
	 * returns
	 * @return teachers/overview view
	 */
	public function index()
	{
		//load occurrences, courses and assessments (active and past)
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests

        $submissions = collect();

        //loop through assessments and find all submissions for each assessment
        //populate the submissions collection
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

    /*
     * Display a list of all assignments (active & inactive) for courses this
     * teacher is registered for.
     * loads
     */
    public function assignments(){

        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
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

        //loops through list of past assessments and find assignments only
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

    /*
     * Displays a list of tests (active & inactive) for courses
     * this teacher is registered for
     */
    public function tests(){

        //load occurrences, courses and assessments
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests

        //separate tests from assignments
        foreach($assessments as $assessment){
          if($assessment->assessment_type === 2){
                $tests->push($assessment);
          }
        }

        $pastTests = collect();
        //separate past tests from past assignments
        foreach($pastAssessments as $assessment){
           if($assessment->assessment_type === 2){
                $pastTests->push($assessment);
            }
        }

        $footerData= $this->getFooterData();
        $data =[
            'tests' => $tests->reverse(),
            'pastTests' => $pastTests->reverse(),
            'footerData' => $footerData
        ];

        return view('lecturers/viewTests', $data);
    }

    /*
     * Display an individual assessment the teacher has access to based on id number
     * loads an assessment
     */
    public function assessment($assessment_id){

        $assessment = Assessment::find($assessment_id);

        //if assessment isnt found redirect to error page
        if($assessment === null){
            return redirect()->route('teachers/error')->with('error','Assessment not found');
        }

        //if assessment belongs to a course the user does not have access to redirect to error page
        if(!$this->checkCourseID($assessment->course_id)){
            return redirect()->route('teachers/error')->with('error','You do not have access to this course');
        }

        //find all submissions for that assessment
        $submissions = $assessment->submissions;

        $footerData = $this->getFooterData();
        $data = [
            'assessment' => $assessment,
            'submissions' => $submissions,
            'footerData' => $footerData
        ];

        return view('lecturers/assessment', $data);
    }

    /*
     * Displays form & allows teachers to make changes to assessments they have created
     * an assessment cannot be changed if its due date has already occurred
     * @return editAssessment view
     */
    public function editAssessment($assessment_id){

        //get occurrences, courses
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);

        $assessment = Assessment::find($assessment_id);
        //if assessment isnt found redirect to error page
        if($assessment === null){
            return redirect()->route('teachers/error')->with('error','Assessment not found');
        }
        //if teacher doesnt have access to the assessment redirect to error page
        if(!$this->checkCourseID($assessment->course_id)){
            return redirect()->route('teachers/error')->with('error','You do not have access to this course');
        }

        $coursesArray = [];
        //load list of courses in case teacher wants to change assessment course
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

    /*
     * POST of edit, actually applies the chages to the assessment
     */
    public function edit($assessment_id){

        //define validation rules to ensure assessment update follows protocol
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

        //if assessment isnt found redirect to error page
        if($assessment === null){
            return redirect()->route('teachers/error')->with('error','Assessment not found');
        }
        //if teacher does have access to the assessment redirect to error page
        if(!$this->checkCourseID($assessment->course_id)){
            return redirect()->route('teachers/error')->with('error','You do not have access to this course');
        }

        //if the assessment type is 1 (meaning it is an assignment)
        // check for and accept a file related to the assessment
        //store the file in the related assessment submissions directory

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

        //update assessment properties
        $assessment->title = Request::input('title');
        $assessment->description = Request::input('description');
        $assessment->start_date = Request::input('start_date');
        $assessment->course_id = Request::input('course_id');

        //if assessment is an assignment set the end date
        if($assessment->assessment_type == 1){
            $assessment->end_date = Request::input('end_date');
        }

        //apply the changes to the assessment in the DB
        // if assessment update fails redirect to previous page with error, if it succeeds redirect back with success message
        if($assessment->save()){
            return redirect()->back()->with('success', 'Assessment successfully updated');
        }
        else
        {
            return redirect()->back()->withInput()->withErrors(['assessment unsuccessfully saved']);
        }

    }

    /*
     * displays view that Allows user to upload an assignment when creating an assessment
     */

    public function uploadAssignment(){
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);

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

        //create new assessment & date and assign properties
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

        //if assessment is an assignment then check for and accept a file upload
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
        if(! $assessment->save()){
            return redirect()->route('teachers/error')->with('error','assessment not successfully saved');
        }

        if($assessment->assessment_type == 1){
            return redirect()->route('teachers/assignments');
        }
        else{
            return redirect()->route('teachers/tests');
        }

    }

    /*
     * Displays a list of submissions for all courses & assignments the teacher has access to
     */
    public function submissions(){

        $submissions = $this->findSubmissions();
        $footerData = $this->getFooterData();
        $data = [
            'submissions' => $submissions,
            'footerData' => $footerData

        ];

        return view('lecturers/submissions',$data);
    }

    /*
     * Displays a single submission the user has access to
     */
    public function submission($submission_id){

        $submission = $this->findSubmission($submission_id);
        $footerData = $this->getFooterData();

        $data = [
            'submission' => $submission,
            'footerData' => $footerData
        ];

        return view('lecturers/submissions',$data);
    }

    /*
     * Deletes an assessment from the system (assessmet must not be past its due date)
     */
    public function deleteAssessment($assessment_id){

        $assessment = Assessment::find($assessment_id);
        if($assessment === null){
            return redirect()->route('teachers/error')->with('error','Assessment not found');
        }
        if(!$this->checkCourseID($assessment->course_id)){
            return redirect()->route('teachers/error')->with('error','You do not have access to this course');

        }
        //delete all submissions for this assessment
        foreach($assessment->submissions as $submission){
            $submission->delete();
        }
        $assessment->delete();

        return redirect()->back();
    }

    /*
     * find submissions for courses the user is currently assigned to
     * organizes the submissions by course and returns an
     * array of accepted & unaccepted submissions
     */

    public function findSubmissions(){

        // get list of assessments
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
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
        //if submission isnt found redirect to error page
        if($submission === null){
            return redirect()->route('teachers/error')->with('error','Submission not found');
        }
        //if teacher doesnt have access to the course & assignment redirect to error page
        if (!$this->checkCourseID($submission->assessment->course->id)){
            return redirect()->route('teachers/error')->with('error',"You do not have access to this course's submissions");
        }
        $submission->userList = $submission->users; // set list of users for easy access
        return $submission;

    }

    /**
     * checks if the course_id matches a course the teacher has access to
     */
    public function checkCourseID($course_id)
    {
        //finds a list of occurrences the user is registered for and compares
        //them to the course_id passed to this function
        //if one of them matches return true, else return false
        $occurrences = Auth::user()->occurrences;
        $conf = false;
        foreach ($occurrences as $occurrence) {

            if ($occurrence->course_id === intval($course_id)) {

                if ($occurrence->end_date > date('Y-m-d H:i:s')) {
                    $conf = true;
                }
            }
        }
        return $conf;
    }

    /*
     * loads data required for populating lists in the footer for teacher pages
     */
    public function getFooterData()
    {
        //load occurrences, courses, assessments and submissions
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $submissions = Auth::user()->submissions()->with('assessment')->take(5)->get();

        //create recent submissions list using assignment names
        foreach($submissions as $submission){
            $assessments->push($submission->assessment);
        }

        $assignments = collect();
        $tests = collect();

        //separate tests and assignments
        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }
        //create footerData array and return it
        $footerData = [
            'courses' => $courses->take(5),
            'assignments' => $assignments->take(5),
            'tests' => $tests->take(5)

        ];
        return $footerData;
    }

    /*
     * Accepts a filename from request input and downloads that file from the appropriate directory
     * returns error page if file isnt found
     */
    public function download()
    {
        //get filename from input
        $filename = Request::input('filename');
        //create filepath for retrieval
        $file_path = public_path() . $filename;

        //create fileInfo model of class
        $file = new SplFileInfo($file_path, $file_path, 'subpath');

        //if the file exists in a properly structured directory then name the file and return it in a response
        if ( (file_exists($file_path) && (!is_dir($file_path)) ))
        {
            $fn = 'submission.txt';
            try{
                return response()->download(($file), $fn, [
                    'Content-Length: '. filesize($file)
                ]);
            }
            catch(exception $ex){
                return redirect('teachers/error')->with('error', 'Exception in file download');
            }

        }
        else
        {
            return redirect()->route('teachers/error')->with('error','Requested file not found');
        }
    }

    /*
     * Displays the error page with an error sent to the session data
     */
    public function showError(){
        $error = Session::get('error');
        $footerData= $this->getFooterData();
        $data = [
            'error' => $error,
            'footerData' => $footerData
        ];

        return view('lecturers/error_page', $data);
    }

}
