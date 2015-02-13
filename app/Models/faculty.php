<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class faculty extends Model {

	protected $table = 'faculties';

    protected $fillable = ['name', 'code'];

}
