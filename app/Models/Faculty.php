<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model {

	protected $table = 'faculties_colleges';

    protected $fillable = ['name', 'code'];

}
