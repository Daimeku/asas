<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occurence extends Model {

    protected $table = 'occurences';

    protected $guarded = ['id', 'created_at', 'updated_at'];

}
