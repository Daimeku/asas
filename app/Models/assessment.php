<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model {

	protected $table = 'assessments';

    protected $fillable = ['title', 'description', 'filepath', 'start_date', 'end_date', 'course_id'];

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function submissions(){
        return $this->hasMany('App\Models\Submission');
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
