<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Assessment extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $table = 'assessments';

    protected $fillable = ['title', 'description', 'filepath', 'start_date', 'end_date', 'course_id'];


    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function submissions(){
        return $this->hasMany('App\Models\Submission', 'assessment_id','id');
    }

    public function getDates()
    {
        return [
            'created_at',
            'updated_at',
            'start_date',
            'end_date'
        ];
    }

}
