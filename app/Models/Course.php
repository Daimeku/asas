<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

	//

    protected $table = 'courses';

    protected $fillable = ['description', 'code', 'name', 'school_id', 'start_date', 'end_date'];

}
