<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Occurence;
use App\Models\Assessment;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'email', 'password', 'user_type', 'image_file_path'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /*
     * setting a many to many reltionship between users and occurences
     */

	 public function occurences(){
	 	return $this->belongsToMany('App\Models\Occurence', 'user_courses','user_id','occurence_id');
	 }

    public function submissions(){
        return $this->belongsToMany('App\Models\Submission','user_submissions');
    }

    /*
     * accepts a list of occurences and returns the courses they belong to
     */

    public function findCourses($occurences){
        $courses = collect();

        foreach($occurences as $occurence){

            $course = Course::find($occurence->course_id);
            $courses->push($course);

        }
        return $courses;
    }

    /*
     * accepts a list of courses and returns a list of active assessments for that course
     */

    public function findActiveAssessments($courses){
        $assessments = collect();

        /*
         * loops through the courses and finds assignments with that course id and end_date greater than the current date
         */

        foreach($courses as $course){
            $courseAssessments =  Assessment::where('course_id', $course->id)->where('end_date', '>', date("Y-m-d"))->get(); //->where('end_date', '>=', date("Y-m-d H:i:s"));
            if(! $courseAssessments->isEmpty()){

               $assessments= $assessments->merge($courseAssessments);
            }
        }

        return $assessments;
    }

    /*
     * finds all past assessments
     */

    public function findPastAssessments($courses){
        $assessments = collect();

        /*
         * loops through the courses and finds assignments with that course id and end_date greater than the current date
         */

        foreach($courses as $course){
            $courseAssessments =  Assessment::where('course_id', $course->id)->where('end_date', '<', date("Y-m-d H:i:s"))->take(500)->get(); //->where('end_date', '>=', date("Y-m-d H:i:s"));

            if(! $courseAssessments->isEmpty()){

                $assessments= $assessments->merge($courseAssessments);
            }
        }

        return $assessments;
    }

}
