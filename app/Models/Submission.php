<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model {

	protected $table = 'submissions';

    protected $fillable = ['file_path', 'time', 'assessment_id'];

    public function assessment(){
        return $this->belongsTo('App\Models\Assessment');

    }

}
