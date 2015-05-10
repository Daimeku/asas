<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model {

	protected $table = 'days';

    public function occurrences(){
        return $this->hasMany('App\Models\Occurrences');
    }

}
