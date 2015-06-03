<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Models\Submission;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Course;
use App\Models\Assessment;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class StudentsController extends Controller {

    /*
     * attach middleware to controller to verify the user is a student
     */
    public function __construct(){
        $this->middleware("student");
    }

	/**
	 * loads relevent data and returns the student overview page
	 *loads occurrences, courses, assessments
	 * @return students/overview view
	 */
	public function index()
    {
        //load occurrences, courses, assessments, submissions
        $user = Auth::user();
        $occurrences = $user->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);
        $submissions = Auth::user()->submissions()->with('assessment')->get();  //get all submissions, eager load assessments
        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests


        //loops through list of assessments and separate tests from assignments
        $assignments = $this->getAssignmentsFromAssessments($assessments);
        $tests = $this->getTestsFromAssessments($assessments);

        //load footer and populate data array
        $footerData = $this->getFooterData();
		$data = [

			'user' => Auth::user()->sanitize(),	//returning user object
            'assignments' => $assignments->reverse(),
            'tests' => $tests->reverse(),
            'courses' => $courses,
            'pastAssessments' => $pastAssessments->reverse(),
            'submissions' => $submissions,
            'footerData' => $footerData


		];

		return view('students/overview', $data);
	}

    /*
     * Displays a list of assignment the student has access to
     */
    public function assignments()
    {

//      load occurrences, courses and finally assessments
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        // get submissions from user model
        $submissions = Auth::user()->submissions()->with('assessment')->get();

        //remove assessments that are already submitted
        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);

        //loop through assessments and separate assignments from tests
        $assignments = $this->getAssignmentsFromAssessments($assessments);

        //separate past assignments from past test
        $pastAssignments = $this->getAssignmentsFromAssessments($pastAssessments);

//        $submissionAssessments = collect(); // stores assignments that were submitted
        //loop through submissions and add related assessments to $submissionAssessments
//        foreach($submissions as $submission){
//            $submissionAssessments->push($submission->assessment);
//        }

        $footerData = $this->getFooterData();  // get data for footer

        //populate data array and return with view
        $data = [
            'user' => Auth::user()->sanitize(),
          'assignments' => $assignments->reverse(),
          'pastAssignments' => $pastAssignments->reverse(),
          'courses' => $courses,
            'footerData' => $footerData
        ];

        return view('students/assignments',$data);

    }

    /*
     * loops through assessments and submissions and builds a list of assessments that havent been submitted by this user
     * returns a list of unsubmitted assessments
     */
    public function checkSubmittedAssessments($assessments, $submissions)
    {
        $newAssessments = collect();

        //foreach assessment, chck if any submissions match its course_id
        //if submission matches then dont return that assessment
        foreach($assessments as $assessment){
            $conf = true;
            // check if any submissions by this student exist for this assessment
            foreach($submissions as $submission){
                if((intval($submission->assessment_id) === intval($assessment->id)) ){
                    $conf=false;
                    break;
                }
            }
            // if conf is true then the assessment can be added to the list
            if($conf === true){
                $newAssessments->push($assessment);
            }

        }
        $assessments = $newAssessments;
        return $assessments;
    }

    /*
     * Display a list of active & inactive tests
     * loads occurrences, tests, courses
     * returns students/tests view
     */
    public function tests()
    {

        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);

        $tests = $this->getTestsFromAssessments($assessments);

        $footerData = $this->getFooterData();

        $data = [
            'user' => Auth::user()->sanitize(),
            'tests' => $tests->reverse(),
            'courses' => $courses,
            'footerData' => $footerData
        ];

        return view('students/tests', $data);

    }

    /*
     * Dislpays an individual assessment
     * loads assessment, courses
     */
    public function assessment($assessment_id){

        //load assessment, occurrences and courses
        $assessment = Assessment::find($assessment_id);

        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);

        //if assessment isnt found redirect to error page
        if($assessment === null){
            return redirect()->route('students/error')->with('error','Assessment not found');
        }

        //add past assessments to list
        foreach($pastAssessments as $assessmentTemp){
            $assessments->push($assessmentTemp);
        }

        //check that student has access to this course
        if(!$this->checkCourseID($assessment->course_id)){
            return redirect()->route('students/error')->with('error','You do not have access to this course');
        }

        //ensure this student has been assigned to this assessment
        if(!($this->checkAssessmentBelongs($assessments,$assessment_id)) ){
            return redirect()->route('students/error')->with('error','You do not have access to this assessment');
        }

        $footerData = $this->getFooterData();
        $data = [
            'user' => Auth::user()->sanitize(),
            'assessment' => $assessment,
            'footerData' => $footerData
        ];

        return view('students/assessment', $data);
    }

    /*
     * Displays a list of all submissions related to this student
     * uses submissionGroups to group submissions by assessment for readability purposes & formatting in the views
     * returns students/submissions view
     */
    public function submissions()
    {
        //loads occurrences, courses, submissions
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $submissions = Auth::user()->submissions()->with('assessment')->take(25)->get();

        $submissionGroups = collect();

        //foreach submission add its related assessment and course to the submissionGroup
        foreach($submissions as $submission){
            $assessment = $submission->assessment;
            $course = $assessment->course;

            //populate submission group
            $group = [
                'submission' => $submission,
                'course' => $course,
                'assessment' => $assessment
            ];
            //push submission to group
            $submissionGroups->push($group);
        }

        $footerData = $this->getFooterData();

        $data = [
            'submissions' => $submissions,
            'courses' => $courses,
            'submissionGroups' => $submissionGroups->reverse(),
            'footerData' => $footerData
        ];

        return view('students/submissions', $data);
    }

    /*
     * Displays an individual submission
     * returns students/submission view
     */
    public function submission($submission_id){

        $submission = Submission::find($submission_id);
        //if submission isnt found redirect to error screen
        if($submission === null){
            return redirect()->route('students/error')->with('error','Submission not found');
        }

        //Ensure student has access to this course, else return error
        if (!$this->checkCourseID($submission->assessment->course->id)){
            return redirect()->route('students/error')->with('error','You do not have access to this course');
        }
        //ensure student has access to this submission, else return error
        if(!$this->checkUserHasSubmission($submission)){
            return redirect()->route('students/error')->with('error','You do not have access to this submission');
        }

        //set submission userlist, course and populate data array
        $submission->userList = $submission->users;
        $footerData = $this->getFooterData();
        $course = $submission->assessment->course;
        $data = [
            'submission' => $submission,
            'course' => $course,
            'assessment' => $submission->assessment,
            'footerData' => $footerData
        ];

        return view('students/submission', $data);
    }

    /*
     * Displays page for student to submit and upload an assignment
     */
    public function uploadAssignment($assessment_id)
    {
        //accepts assessment id and finds the related assessment the student has access to
        $currentAssessment = $this->getCurrentAssessment($assessment_id);

        //load footer data and return view
        $footerData = $this->getFooterData();
        $data = [
            'user' => Auth::user()->sanitize(),
            'assessment' => $currentAssessment,
            'footerData' => $footerData
        ];

        return view('students/uploadAssignments', $data);

    }

    /*
     * Display page for student to add assignment submission to queue
     * for collection by studentServices
     */
    public function addToQueueView($assessment_id){
        //finds & verifies current assessment
        $currentAssessment = $this->getCurrentAssessment($assessment_id);
        $footerData = $this->getFooterData();
        $data = [
            'user' => Auth::user()->sanitize(),
            'assessment' => $currentAssessment,
            'footerData' => $footerData
        ];

        return view('students/addToQueue', $data);

    }

    /*
     * Adds the assessment to the studentServices queue for acceptance
     *
     */
    public function addToQueue($assessment_id){

        //get list of students submitting this assignment
        $students = Request::input('students'); // get list of student ids,
        array_unshift($students, Auth::user()->id); // add current student id to list of student ids

        $submission = new Submission;
        $submission->time = date('Y-m-d H:i:s');
        $submission->accepted = false;
        $submission->submission_type = 1;
        $submission->assessment_id = $assessment_id;
        $submission->save();

        // create entries in the user_submissions table

        foreach($students as $student_id){
            if($student_id != null){
                DB::table('user_submissions')->insert([
                    'submission_id' => $submission->id,
                    'user_id' => $student_id
                ]);
            }

        }

        return redirect()->route('students/submissions')->with('success','Assignment added to queue');

    }

    /*
     * facilitates student uploading of assignments
     * accepts a list of students if a group assignment and a file for the assignment
     */
    public function upload($assessment_id){

        //create validator with validation rules
        $val = Validator::make(Request::all(),[
            'assessment' => 'Required',
            'students' => 'Required'

        ]);

        // if validation fails return to the previous page with the validator errors
        if($val->fails()){
            return redirect()->back()->withInput()->withErrors($val->errors()->all());
        }

        $students = Request::input('students'); // get list of student ids,
        array_unshift($students, Auth::user()->id); // add current student id to list of student ids

        $file = Request::file('assessment');
        $fileName = Request::input('fileName');
        $assessment = $this->getCurrentAssessment($assessment_id);

        //if a valid file has been uploaded
        if($file->isValid()){

            $filePath = public_path().("\\files\\assessments\\$assessment->id\\submissions");
            if($fileName == null){
                $fileName = "submission";
            }
            $fileName = $fileName ."." .$file->getClientOriginalExtension();
            $file->move($filePath,$fileName);
            $path =("\\files\\assessments\\$assessment->id\\submissions\\$fileName");
            // create an entry in the submissions table
            $submission = new Submission;
            $submission->file_path = $path;
            $submission->time = date('Y-m-d H:i:s');
            $submission->accepted = false;
            $submission->submission_type = 2;
            $submission->assessment_id = Request::input('assessment_id');
            $submission->save();

            // create appropriate entries in user_submissions table

            foreach($students as $student_id){
                if($student_id != null){
                    DB::table('user_submissions')->insert([
                        'submission_id' => $submission->id,
                        'user_id' => $student_id
                    ]);
                }

            }


        }
        else{
            return redirect()->route('students/error')->with('error','Uploaded file not valid');
        }

        return redirect()->route('students/submissions')->with('success','successfully added submission');

    }


    /*
     * Allows student to download an assignment file
     * accepts filename from response input
     */
    public function download()
    {
        $filename = Request::input('filename');

        // Check if file exists in app/storage/file folder
        $file_path = public_path() . $filename;

        $file = new SplFileInfo($file_path, $file_path, 'subpath');
        if (file_exists($file_path))
        {
            $fn = basename($file->getRelativePath());
            $fn = $fn . ".txt";

            // Send Download
            return response()->download(($file), $fn, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            return redirect()->route('students/error')->with('error','Requested file not found');
        }
    }

    /*
     * displays error page with error from session data
     */
    public function showError(){
        $error = Session::get('error');

        $footerData= $this->getFooterData();
        $data = [
            'error' => $error,
            'footerData' => $footerData
        ];

        return view('students/error_page', $data);

    }

    /*
   * loads the data required for the students page footer
   * returns array with footerData (courses, assessments, submissions)
   */
    public function getFooterData()
    {
        //load occurrences, courses and assessment to find submission
        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = collect();
        $submissions = Auth::user()->submissions()->with('assessment')->get();

        //load submissions by assessment for readability
        foreach($submissions as $submission){
            $assessments->push($submission->assessment);
        }

        $footerData = [
            'courses' => $courses,
            'assessments' => $assessments->take(5),
            'submissions' => $submissions->reverse()->take(5)
        ];
        return $footerData;
    }

    /*
     * separates tests from assessments and returns tests
     */
    public function getTestsFromAssessments($assessments)
    {
        $tests=collect();
        foreach($assessments as $assessment){
            if($assessment->assessment_type == 2){
                $tests->push($assessment);
            }
        }
        return $tests;
    }

    /*
     * separate assignments from assessments and return assignments collection
     */
    public function getAssignmentsFromAssessments($assessments)
    {
        $assignments = collect();

        foreach($assessments as $assessment){
            if($assessment->assessment_type == 1){
                $assignments->push($assessment);
            }
        }

        return $assignments;
    }

    /*
     * Compares list of users related to a submission to the current user
     * ensures that the user has access to this specific submission
     */
    public function checkUserHasSubmission($submission){
        foreach($submission->users as $user){
            if($user->id === Auth::user()->id){
                return true;
            }
        }
        return false;
    }

    /*
    * checks to ensure that the student has access to the assessment
    */
    public function checkAssessmentBelongs($assessments, $assessment_id){
        $conf = false;
        foreach($assessments as $assessment){
            if(intval($assessment_id) === $assessment->id){
                $conf = true;
            }
        }
        return $conf;
    }

    /*
     * Gets the assessment by the ID passed to it and ensures student has access to it
     * returns the assessment
     */
    public function getCurrentAssessment($assessment_id){

        $occurrences = Auth::user()->occurrences;
        $courses = Auth::user()->findCourses($occurrences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $submissions = Auth::user()->submissions;

        //checks if the user is assigned to the current assessment
        if(!($this->checkAssessmentBelongs($assessments,$assessment_id)) ){
            return redirect()->route('students/error')->with('error','You do not have access to this assessment');
        }

        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);

        //checks to make sure that the user has permission to upload the chocsen assessment
        //scans list of assessments and finds one with an id matching the assessment_id param
        $currentAssessment = null;
        $conf = false;
        foreach($assessments as $assessment){
            if(intval($assessment_id) === $assessment->id){
                $currentAssessment = $assessment;
                $conf=true;
                break;
            }
        }

        //check if assessment is found
        if($conf!=true){
            return redirect()->route('students/error')->with('error','Assessment not found for this user. Possible duplicate submission');
        }
        //check assessment is a test
        if($currentAssessment->assessment_type !=1){
            return redirect()->route('students/error')->with('error','You are attempting to upload a test, only assignments may be uploaded');
        }

        return $currentAssessment;
    }

    /**
     * checks if the course_id matches a course the user has access to
     */
    public function checkCourseID($course_id)
    {
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
}
