<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model {

	protected $table = 'assessments';

    protected $fillable = ['title', 'description', 'filepath', 'start_date', 'end_date', 'course_id'];

}
