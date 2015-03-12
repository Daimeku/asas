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
		
		DB::table('user_courses')->insert(
			['user_id' =>1, 'course_id' =>1]
		);
	
	}
}