<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Occurence;

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

    /*
     * accepts a list of occurences and returns the courses they belong to
     */

    public function findCourses($occurences){
        $courses =[];

        foreach($occurences as $occurence){

            $course = Course::find($occurence->course_id);
            array_push($courses, $course);
        }

        return $courses;
    }

}
