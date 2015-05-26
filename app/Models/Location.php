<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Occurrence;

class Location extends Model {

	protected $table = 'locations';

    public function occurrences(){
        return $this->hasMany('App\Models\Occurrences');
    }

}
