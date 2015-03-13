<?php

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\School;
use App\Models\Course;

Class UserCoursesSeeder extends Seeder {
	public function run()
	{
		Faculty::create([
			'name' => 'Faculty of engineering and computing',
			'code' => 'FENC'
		]);

		School::create([
			'name' => 'School of computing and information technology',
			'code' => 'SCIT',
			'faculty_id' => 1
		]);

		Course::create([
			'description' => 'major project',
			'name' => 'major project',
			'code' => 'prj4020',
			'school_id' => 1
		]);

		DB::table('occurences')->insert(
			[
			 	'code' => 'OCC1',
			 	'location' => '2B1',
			 	'day'	=> 'wednesday',
			 	'time'	=> date('H:i:s'),
			 	'course_id' => 1
			]
		);
		
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>2,
			 	'course_id' =>1, 
			 	'occurence_id' =>1, 
			 	'start_date' => '2015-1-1 00:00:00',
			 	'end_date' => '2017-1-1 00:00:00'
			]
		);
	
	}
}