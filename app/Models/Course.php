<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Occurrence;

class Course extends Model {

	//

    protected $table = 'courses';

    protected $fillable = ['description', 'code', 'name', 'school_id', 'start_date', 'end_date'];

    public function assessments(){

        return $this->hasMany('App\Models\Assessment', 'course_id','id');
    }

    public function occurrences(){
        return $this->hasMany('App\Models\Occurrence', 'course_id','id');
    }
}
