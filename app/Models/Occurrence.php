<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Occurrence extends Model {

    protected $table = 'occurences';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }
}
