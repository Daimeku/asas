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


class StudentsController extends Controller {

    public function __construct(){
        $this->middleware("student");
    }

	/**
	 * loads relevent data and returns the student overview page
	 *
	 * @return Response
	 */
	public function index()
    {
        $user = Auth::user();
        $occurences = $user->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $pastAssessments = Auth::user()->findPastAssessments($courses);
        $submissions = Auth::user()->submissions()->with('assessment')->get();  //get all submissions, eager load assessments
        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);

        $assignments = collect();   // stores upcoming assignments
        $tests = collect();         // stores upcoming tests


        //loops through list of assessments and separate tests from assignments
//        dd($assessments);
        foreach($assessments as $assessment){
            if($assessment->assessment_type == 1){
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type == 2){
                $tests->push($assessment);
            }
        }
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
//        dd($data);
		return view('students/overview', $data);
	}




    public function assignments()
    {

//      load occurrences, courses and finally assessments
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);

        $submissions = Auth::user()->submissions()->with('assessment')->get();      // get submissions from user model
        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);        //remove assessments that are already submitted



        $assignments = collect();   // stores assignments
        $tests = collect();         // stores tests
        //loop through assessments and separate assignments from tests
        foreach($assessments as $assessment){
            if($assessment->assessment_type === 1){ // if assessment type is 1 then it is an assignment
                $assignments->push($assessment);
            }
            else if($assessment->assessment_type === 2){ // if assessment_type is 2 then it is a test
                $tests->push($assessment);
            }
        }

        $submissionAssessments = collect(); // stores assignments that were submitted
        //loop through submissions and add related assessments to $submissionAssessments
        foreach($submissions as $submission){
            $submissionAssessments->push($submission->assessment);
        }

        $footerData = $this->getFooterData();  // get data for footer

        $data = [
            'user' => Auth::user()->sanitize(),
          'assignments' => $assignments->reverse(),
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

    public function tests()
    {
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $tests = collect();

        foreach($assessments as $assessment){

           if($assessment->assessment_type === 2){
                $tests->push($assessment);
            }
        }

        $footerData = $this->getFooterData();

        $data = [
            'user' => Auth::user()->sanitize(),
            'tests' => $tests->reverse(),
            'courses' => $courses,
            'footerData' => $footerData
        ];

        return view('students/tests', $data);

    }

    public function assessment($assessment_id){

        $assessment = Assessment::find($assessment_id);

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);

        $submissions = Auth::user()->submissions()->with('assessment')->get();      // get submissions from user model
//        $assessments = $this->checkSubmittedAssessments($assessments, $submissions);        //remove assessments that are already submitted

        if($assessment === null){
            dd("ASSESSMENT NOT FOUND");
        }

        if(!$this->checkCourseID($assessment->course_id)){
            dd("YOU DO NOT HAVE ACCESS TO THAT COURSE");
        }

        if(!($this->checkAssessmentBelongs($assessments,$assessment_id)) ){
            return "ASSIGNMENT NOT ASSIGNED TO THIS USER";
        }

        $footerData = $this->getFooterData();
        $data = [
            'user' => Auth::user()->sanitize(),
            'assessment' => $assessment,
            'footerData' => $footerData
        ];

        return view('students/assessment', $data);
    }

    public function submissions()
    {

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $submissions = Auth::user()->submissions()->with('assessment')->take(25)->get();

        $submissionGroups = collect();

        foreach($submissions as $submission){
            $assessment = $submission->assessment;
            $course = $assessment->course;

            $group = [
                'submission' => $submission,
                'course' => $course,
                'assessment' => $assessment
            ];
            $submissionGroups->push($group);
        }
        $footerData = $this->getFooterData();

        $data = [
            'submissions' => $submissions->reverse(),
            'courses' => $courses,
            'submissionGroups' => $submissionGroups,
            'footerData' => $footerData
        ];

        return view('students/submissions', $data);
    }

    public function submission($submission_id){

        $submission = Submission::find($submission_id);
        if($submission === null){
            $error = [ "ERROR SUBMISSION NOT FOUND"];
            dd( "ERROR SUBMISSION NOT FOUND");
        }

        if (!$this->checkCourseID($submission->assessment->course->id)){
            dd("ERROR YOU DO NOT CURRENTLY HAVE ACCESS TO THAT COURSE");
        }
        if(!$this->checkUserHasSubmission($submission)){
            dd("ERROR YOU DO NOT CURRENTLY HAVE ACCESS TO THIS SUBMISSION");
        }

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

    public function checkUserHasSubmission($submission){
        foreach($submission->users as $user){
            if($user->id === Auth::user()->id){
                return true;
            }
        }
        return false;
    }

    public function getFooterData()
    {
        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = collect();
        $submissions = Auth::user()->submissions()->with('assessment')->take(25)->get();

        foreach($submissions as $submission){
            $assessments->push($submission->assessment);
        }

        $footerData = [
            'courses' => $courses,
            'assessments' => $assessments
        ];

        return $footerData;
    }


    public function uploadAssignment($assessment_id)
    {


        $currentAssessment = $this->getCurrentAssessment($assessment_id);
        $footerData = $this->getFooterData();
        $data = [
            'user' => Auth::user()->sanitize(),
            'assessment' => $currentAssessment,
            'footerData' => $footerData
        ];

        return view('students/uploadAssignments', $data);

    }

    public function getCurrentAssessment($assessment_id){

        $occurences = Auth::user()->occurences;
        $courses = Auth::user()->findCourses($occurences);
        $assessments = Auth::user()->findActiveAssessments($courses);
        $submissions = Auth::user()->submissions;

        //checks if the user is assigned to the current assessment
        if(!($this->checkAssessmentBelongs($assessments,$assessment_id)) ){
            return "ASSIGNMENT NOT ASSIGNED TO THIS USER";
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
            return "ASSIGNMENT NOT FOUND FOR THIS USER. Possible duplicate submission.";
        }
        //check assessment is a test
        if($currentAssessment->assessment_type !=1){
            return "YOU ARE ATTEMPTING TO UPLOAD A TEST. ONLY ASSIGNMENTS CAN BE UPLOADED.";
        }

        return $currentAssessment;
    }

    public function checkAssessmentBelongs($assessments, $assessment_id){
        $conf = false;
        foreach($assessments as $assessment){
            if(intval($assessment_id) === $assessment->id){
                $conf = true;
            }
        }
        return $conf;
    }

    public function upload($assessment_id){

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
//        dd($students);
        $file = Request::file('assessment');
        $submissionName = Request::input('submissionName');
        $assessment = $this->getCurrentAssessment($assessment_id);

        if($file->isValid()){

            $filePath = public_path().("\\files\\assessments\\$assessment->id\\submissions");
            $file->move($filePath,"submission");

            // create an entry in the submissions table
            $submission = new Submission;
            $submission->file_path = $filePath . $submissionName;
            $submission->time = date('Y-m-d H:i:s');
            $submission->accepted = false;
            $submission->submission_type = 2;
            $submission->assessment_id = Request::input('assessment_id');
            $submission->save();

            // create an entry in the user_submissions table

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
            return "FILE NOT VALID";
        }

        return redirect()->route('students/submissions');

    }

    /**
     * checks if the course_id matches a course the user has access to
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

    public function download()
    {
        $filename = Request::input('filename');

        // Check if file exists in app/storage/file folder
        $file_path = public_path() . $filename;

        $file = new SplFileInfo($file_path, $file_path, 'subpath');
        if (file_exists($file_path))
        {
//            return (new Response($file,200));
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
            exit('Requested file does not exist on our server!');
        }
    }

}
