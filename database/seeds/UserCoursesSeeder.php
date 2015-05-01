<?php

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\School;
use App\Models\Course;
use App\Models\Assessment;

Class UserCoursesSeeder extends Seeder {
	public function run()
	{

		//*********************Faculties/Colleges (All)***********************************************
		//1
		Faculty::create([
			'name' => 'Faculty of Engineering and Computing',
			'code' => 'FENC'
		]);

		//2
		Faculty::create([
			'name' => 'College of Health Sciences',
			'code' => 'COHS'
		]);

		//3
		Faculty::create([
			'name' => 'Faculty of Education and Liberal Studies',
			'code' => 'FELS'
		]);

		//4
		Faculty::create([
			'name' => 'Faculty of Science and Sport',
			'code' => 'FOSS'
		]);

		//5
		Faculty::create([
			'name' => 'College of Business and Management',
			'code' => 'N/A'
		]);

		//6
		Faculty::create([
			'name' => 'Faculty of the Built Environment',
			'code' => 'FOBE'
		]);

		//7
		Faculty::create([
			'name' => 'Faculty of Law',
			'code' => 'N/A'
		]);

		//8
		Faculty::create([
			'name' => 'Joint Colleges of Medicine & Public Health, Oral Health and Veterinary Sciences',
			'code' => 'N/A'
		]);

		//**********************Schools (All)************************************************

		//1
		School::create([
			'name' => 'School of Computing and Information Technology',
			'code' => 'SCIT',
			'faculty_or_college_id' => 1
		]);

		//2
		School::create([
			'name' => 'School of Engineering',
			'code' => 'SOE',
			'faculty_or_college_id' => 1
		]);

		//3
		School::create([
			'name' => 'Caribbean School of Nursing',
			'code' => 'N/A',
			'faculty_or_college_id' => 2
		]);

		//4
		School::create([
			'name' => 'School of Allied Health & Wellness',
			'code' => 'N/A',
			'faculty_or_college_id' => 2
		]);

		//5
		School::create([
			'name' => 'School of Pharmacy',
			'code' => 'N/A',
			'faculty_or_college_id' => 2
		]);

		//6
		School::create([
			'name' => 'School of Technical & Vocational Education',
			'code' => 'N/A',
			'faculty_or_college_id' => 3
		]);

		//7
		School::create([
			'name' => 'Department of Liberal Studies',
			'code' => 'N/A',
			'faculty_or_college_id' => 3
		]);

		//8
		School::create([
			'name' => 'School of Natural & Applied Sciences',
			'code' => 'N/A',
			'faculty_or_college_id' => 4
		]);

		//9
		School::create([
			'name' => 'School of Mathematics and Statistics',
			'code' => 'SOMAS',
			'faculty_or_college_id' => 4
		]);

		//10
		School::create([
			'name' => 'Caribbean School of Sport Sciences',
			'code' => 'N/A',
			'faculty_or_college_id' => 4
		]);

		//11
		School::create([
			'name' => 'Centre for Science-based Research, Entrepreneurship & Continuing Studies',
			'code' => 'N/A',
			'faculty_or_college_id' => 4
		]);

		//12
		School::create([
			'name' => 'School of Business Administration',
			'code' => 'SOBA',
			'faculty_or_college_id' => 5
		]);

		//13
		School::create([
			'name' => 'School of Hospitality and Tourism Management',
			'code' => 'SHTM',
			'faculty_or_college_id' => 5
		]);

		//14
		School::create([
			'name' => 'School of Entrepreneurship',
			'code' => 'N/A',
			'faculty_or_college_id' => 5
		]);

		//15
		School::create([
			'name' => 'UTech/JIM School of Advanced Management',
			'code' => 'N/A',
			'faculty_or_college_id' => 5
		]);

		//16
		School::create([
			'name' => 'School of Building & Land Management',
			'code' => 'SBLM',
			'faculty_or_college_id' => 6
		]);

		//17
		School::create([
			'name' => 'Caribbean School of Architecture',
			'code' => 'CSA',
			'faculty_or_college_id' => 6
		]);

		//18
		School::create([
			'name' => 'School of Law',
			'code' => 'N/A',
			'faculty_or_college_id' => 7
		]);

		//19
		School::create([
			'name' => 'Medicine',
			'code' => 'N/A',
			'faculty_or_college_id' => 8
		]);

		//20
		School::create([
			'name' => 'Public Health & Health Technology',
			'code' => 'N/A',
			'faculty_or_college_id' => 8
		]);

		//21
		School::create([
			'name' => 'Oral Health Sciences',
			'code' => 'N/A',
			'faculty_or_college_id' => 8
		]);

		//22
		School::create([
			'name' => 'Veterinary Sciences',
			'code' => 'N/A',
			'faculty_or_college_id' => 8
		]);

		//************************Courses (SCIT and Engine)*****************************************************
		//1
		Course::create([
			'description' => 'Major project',
			'name' => 'Major Project',
			'code' => 'prj4020',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//2
		Course::create([
			'description' => 'Programming 1',
			'name' => 'Programming 1',
			'code' => 'CMP1024',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//3
		Course::create([
			'description' => 'Information Technology',
			'name' => 'Information Technology',
			'code' => 'INT1001',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//4
		Course::create([
			'description' => 'Computer Networks 1',
			'name' => 'Computer Networks 1',
			'code' => 'CMP1026',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//5
		Course::create([
			'description' => 'Programming 2',
			'name' => 'Programming 2',
			'code' => 'CMP1025',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//6
		Course::create([
			'description' => 'Object-Oriented Programming Using C++',
			'name' => 'Object-Oriented Programming Using C++',
			'code' => 'CIT2004',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//7
		Course::create([
			'description' => 'Database Design',
			'name' => 'Database Design',
			'code' => 'CMP1028',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//8
		Course::create([
			'description' => 'Computer Logic & Digital Design',
			'name' => 'Computer Logic & Digital Design',
			'code' => 'CMP1005',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//9
		Course::create([
			'description' => 'Data Structures',
			'name' => 'Data Structures',
			'code' => 'CMP2006',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//10
		Course::create([
			'description' => 'Software Engineering: Analysis & Design',
			'name' => 'Software Engineering: Analysis & Design',
			'code' => 'CMP2019',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//11
		Course::create([
			'description' => 'Professional, Ethical & Legal Implications of Computer Systems',
			'name' => 'Professional, Ethical & Legal Implications of Computer Systems',
			'code' => 'HUM3010',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//12
		Course::create([
			'description' => 'Data Structures',
			'name' => 'Data Structures',
			'code' => 'CMP2006',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

        Assessment::create([
        'title' => 'data structures assignment 2',
        'description' => 'the second data structures assignment',
        'filepath' => '../files/bolt.jpg',
        'start_date' => date('Y-m-d H:i:s'),
        'end_date' => '2015-10-3 12:00:00',
        'assessment_type' => 1,
        'course_id' => 9

        ]);
        Assessment::create([
            'title' => 'data structuresfirst assignment',
            'description' => 'the first data structures assessment',
            'filepath' => '../files/bolt.jpg',
            'start_date' => date('2015-01-3 12:00:00'),
            'end_date' => '2015-04-3 12:00:00',
            'assessment_type' => 1,
            'course_id' => 9

        ]);



		//13
		Course::create([
			'description' => 'Operating Systems',
			'name' => 'Operating Systems',
			'code' => 'CIT3002',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//14
		Course::create([
			'description' => 'IT Project Management',
			'name' => 'IT Project Management',
			'code' => 'CIT4024',
			'school_id' => 1,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10'
		]);

		//15	
		Course::create([
			'description' => 'Engineering Mathematics 1',
			'name' => 'Engineering Mathematics 1',
			'code' => 'MAT1032',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//16
		Course::create([
			'description' => 'Engineering Mathematics 2',
			'name' => 'Engineering Mathematics 1',
			'code' => 'MAT1033',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//17
		Course::create([
			'description' => 'Engineering Mathematics 3',
			'name' => 'Engineering Mathematics 3',
			'code' => 'MAT1034',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//18
		Course::create([
			'description' => 'Computer Applications to Engineering',
			'name' => 'Computer Applications to Engineering',
			'code' => 'CMP1014',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//19
		Course::create([
			'description' => 'Management for Engineers',
			'name' => 'Management for Engineers',
			'code' => 'ENG4016',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//20
		Course::create([
			'description' => 'Engineering Workshop',
			'name' => 'Engineering Workshop',
			'code' => 'ENG1005',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//21
		Course::create([
			'description' => 'Advanced Engineering Analysis',
			'name' => 'Advanced Engineering Analysis',
			'code' => 'ENG5000',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//22
		Course::create([
			'description' => 'Introduction to Civil Engineering',
			'name' => 'Introduction to Civil Engineering',
			'code' => 'CIV2000',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//23
		Course::create([
			'description' => 'Mechanical Engineering Science',
			'name' => 'Mechanical Engineering Science',
			'code' => 'MEE1002',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//24
		Course::create([
			'description' => 'Control Systems',
			'name' => 'Control Systems',
			'code' => 'ELE3007',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//25
		Course::create([
			'description' => 'Elementary Principles of Chemical Engineering',
			'name' => 'Elementary Principles of Chemical Engineering',
			'code' => 'CHE1001',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//26
		Course::create([
			'description' => 'Instrument Systems II',
			'name' => 'Instrument Systems II',
			'code' => 'EEI3003',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//27
		Course::create([
			'description' => 'Introduction to Engineering',
			'name' => 'Introduction to Engineering',
			'code' => 'ENG1008',
			'school_id' =>2,
			'start_date' => '2015-9-23',
			'end_date' => '2015-12-10' 
		]);

		//*********************Occurence building blocks*****************************************************************

		 DB::table('days')->insert([
        	['day'=>'Sunday'],
        	['day'=>'Monday'],
        	['day'=>'Tuesday'],
        	['day'=>'Wednesday'],
        	['day'=>'Thursday'],
        	['day'=>'Friday'],
        	['day'=>'Saturday']
        ]);
		
        DB::table('locations')->insert([
        	['location'=>'2B1'],
        	['location'=>'2B2'],
        	['location'=>'2B3'],
        	['location'=>'2B4'],
        	['location'=>'2B5'],
        	['location'=>'2B6'],
        	['location'=>'2B7'],
        	['location'=>'1B8'],
        	['location'=>'LT-9A'],
        	['location'=>'LT-10A'],
        	['location'=>'1AX'],        	
        	['location'=>'LAB-A'],
        	['location'=>'LAB-B'],
        	['location'=>'LAB-C'],
        	['location'=>'LAB-D']
        ]);

        DB::table('activities')->insert([
        	['activity'=>'lecture'],
        	['activity'=>'tutorial'],
        	['activity'=>'practical'],
        	['activity'=>'university_elective'],
        	['activity'=>'seminar'],
        ]);

        DB::table('occurence_codes')->insert([
        	['code'=>'UM1'],
        	['code'=>'UM2'],
        	['code'=>'UM3'],
        	['code'=>'UN1'],
        	['code'=>'UN2'],
        	['code'=>'UN3'],
        	['code'=>'UE1'],
        	['code'=>'UE2'],
        	['code'=>'UE3']
        ]);


		//*********************Occurences (SCIT and Engine)**************************************************************

        	
         //1   Prog1 lec 
		DB::table('occurences')->insert(
			[
			 	'code_id' => 1,
			 	'activity_id' => 1,
			 	'day_id' => 2,
			 	'start_time' => '08:00:00',
			 	'end_time' => '10:00:00',
			 	'location_id' => 9,
			 	'course_id' => 2,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//2 NetWork tut
		DB::table('occurences')->insert(
			[
			 	'code_id' => 4,
			 	'activity_id' => 2,
			 	'day_id' => 4,
			 	'start_time' => '12:00:00',
			 	'end_time' => '13:00:00',
			 	'location_id' => 3,
			 	'course_id' => 4,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//3 Soft Eng lec
		DB::table('occurences')->insert(
			[
			 	'code_id' => 3,
			 	'activity_id' => 1,
			 	'day_id' => 3,
			 	'start_time' => '10:00:00',
			 	'end_time' => '12:00:00',
			 	'location_id' => 10,
			 	'course_id' => 10,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//4 Eng Analysis lec
		DB::table('occurences')->insert(
			[
			 	'code_id' => 7,
			 	'activity_id' => 1,
			 	'day_id' => 5,
			 	'start_time' => '16:00:00',
			 	'end_time' => '18:00:00',
			 	'location_id' => 9,
			 	'course_id' => 21,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//5 OOP prac
		DB::table('occurences')->insert(
			[
			 	'code_id' => 1,
			 	'activity_id' => 3,
			 	'day_id' => 6,
			 	'start_time' => '08:00:00',
			 	'end_time' => '11:00:00',
			 	'location_id' => 14,
			 	'course_id' => 6,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//6 DB design prac
		DB::table('occurences')->insert(
			[
			 	'code_id' => 5,
			 	'activity_id' => 3,
			 	'day_id' => 2,
			 	'start_time' => '15:00:00',
			 	'end_time' => '17:00:00',
			 	'location_id' => 13,
			 	'course_id' => 7,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//7 IT tut
		DB::table('occurences')->insert(
			[
			 	'code_id' => 6,
			 	'activity_id' => 2,
			 	'day_id' => 2,
			 	'start_time' => '16:00:00',
			 	'end_time' => '17:00:00',
			 	'location_id' => 4,
			 	'course_id' => 3,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);


		//8 OS tut
		DB::table('occurences')->insert(
			[
			 	'code_id' => 4,
			 	'activity_id' => 2,
			 	'day_id' => 3,
			 	'start_time' => '13:00:00',
			 	'end_time' => '14:00:00',
			 	'location_id' => 6,
			 	'course_id' => 13,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//9 DS prac
		DB::table('occurences')->insert(
			[
			 	'code_id' => 5,
			 	'activity_id' => 3,
			 	'day_id' => 2,
			 	'start_time' => '14:00:00',
			 	'end_time' => '17:00:00',
			 	'location_id' => 14,
			 	'course_id' => 9,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);


		//10 OOP lec
		DB::table('occurences')->insert(
			[
			 	'code_id' => 4,
			 	'activity_id' => 1,
			 	'day_id' => 5,
			 	'start_time' => '12:00:00',
			 	'end_time' => '13:00:00',
			 	'location_id' => 9,
			 	'course_id' => 6,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//11 OOP prac 2
		DB::table('occurences')->insert(
			[
			 	'code_id' => 4,
			 	'activity_id' => 3,
			 	'day_id' => 6,
			 	'start_time' => '12:00:00',
			 	'end_time' => '15:00:00',
			 	'location_id' => 14,
			 	'course_id' => 6,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//12 OOP prac 3
		DB::table('occurences')->insert(
			[
			 	'code_id' => 4,
			 	'activity_id' => 3,
			 	'day_id' => 4,
			 	'start_time' => '12:00:00',
			 	'end_time' => '15:00:00',
			 	'location_id' => 12,
			 	'course_id' => 6,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//13 NetWork tut
		DB::table('occurences')->insert(
			[
			 	'code_id' => 3,
			 	'activity_id' => 2,
			 	'day_id' => 6,
			 	'start_time' => '10:00:00',
			 	'end_time' => '11:00:00',
			 	'location_id' => 7,
			 	'course_id' => 4,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//14 NetWork prac
		DB::table('occurences')->insert(
			[
			 	'code_id' => 5,
			 	'activity_id' => 3,
			 	'day_id' => 4,
			 	'start_time' => '12:00:00',
			 	'end_time' => '15:00:00',
			 	'location_id' => 8,
			 	'course_id' => 4,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		 //15   Prog1 lec 
		DB::table('occurences')->insert(
			[
			 	'code_id' => 1,
			 	'activity_id' => 1,
			 	'day_id' => 4,
			 	'start_time' => '08:00:00',
			 	'end_time' => '10:00:00',
			 	'location_id' => 10,
			 	'course_id' => 2,
                'start_date' => '2015-1-23',
                'end_date' => '2015-12-10'
			]
		);

		//'time'	=> date('D:H:i:s'),

		//**************************Users and Occ************************************************************************

        DB::table('user_courses')->insert(
            [
                'user_id' =>1,
                'occurence_id' =>1

            ]
        );
		//1 ashani -------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>2,
			 	'occurence_id' =>1 
			 	
			]
		);

		//2
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>2,
			 	'occurence_id' =>14 
			 	
			]
		);

		//3
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>2,
			 	'occurence_id' =>13 
			 	
			]
		);

		//4
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>2,
			 	'occurence_id' =>11 
			 	
			]
		);
		
		//5
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>2,
			 	'occurence_id' =>9 
			 	
			]
		);

		//6 andrew ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>7,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>7,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>7,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>7,
			 	'occurence_id' =>6 			 	
			]
		);

		//10
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>7,
			 	'occurence_id' =>3 			 	
			]
		);

		//11 romario ---------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>3,
			 	'occurence_id' =>3 			 	
			]
		);

		//12
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>3,
			 	'occurence_id' =>13 			 	
			]
		);

		//13
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>3,
			 	'occurence_id' =>8 			 	
			]
		);

		//14
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>3,
			 	'occurence_id' =>6 			 	
			]
		);

		//15
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>3,
			 	'occurence_id' =>7 			 	
			]
		);

		//16 shenique ---------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>4,
			 	'occurence_id' =>3 			 	
			]
		);

		//17
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>4,
			 	'occurence_id' =>13 			 	
			]
		);

		//18
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>4,
			 	'occurence_id' =>8 			 	
			]
		);

		//19
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>4,
			 	'occurence_id' =>6 			 	
			]
		);

		//20
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>3,
			 	'occurence_id' =>7 			 	
			]
		);

		//21 shantel ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>5,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>5,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>5,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>5,
			 	'occurence_id' =>6 			 	
			]
		);

		//25
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>5,
			 	'occurence_id' =>7 			 	
			]
		);

		//26 corie -----------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>10,
			 	'occurence_id' =>1 
			 	
			]
		);

		//
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>10,
			 	'occurence_id' =>14 
			 	
			]
		);

		//
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>10,
			 	'occurence_id' =>13 
			 	
			]
		);

		//
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>10,
			 	'occurence_id' =>11 
			 	
			]
		);
		
		//
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>10,
			 	'occurence_id' =>9 
			 	
			]
		);

		//31 paul ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>11,
			 	'occurence_id' =>13 
			 	
			]
		);

		//32
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>11,
			 	'occurence_id' =>11 			 	
			]
		);

		//33
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>11,
			 	'occurence_id' =>8 			 	
			]
		);

		//34
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>11,
			 	'occurence_id' =>6 			 	
			]
		);

		//35
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>11,
			 	'occurence_id' =>7 			 	
			]
		);

		//36 fred ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>12,
			 	'occurence_id' =>13 
			 	
			]
		);

		//37
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>12,
			 	'occurence_id' =>11 			 	
			]
		);

		//38
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>12,
			 	'occurence_id' =>8 			 	
			]
		);

		//39
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>12,
			 	'occurence_id' =>6 			 	
			]
		);

		//40
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>12,
			 	'occurence_id' =>3 			 	
			]
		);

		//41 dyan ---------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>13,
			 	'occurence_id' =>3 			 	
			]
		);

		//12
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>13,
			 	'occurence_id' =>13 			 	
			]
		);

		//13
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>13,
			 	'occurence_id' =>8 			 	
			]
		);

		//14
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>13,
			 	'occurence_id' =>6 			 	
			]
		);

		//15
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>13,
			 	'occurence_id' =>7 			 	
			]
		);

		//46 donna ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>14,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>14,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>14,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>14,
			 	'occurence_id' =>6 			 	
			]
		);

		//50
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>14,
			 	'occurence_id' =>3 			 	
			]
		);

		//51 chris ---------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>15,
			 	'occurence_id' =>3 			 	
			]
		);

		//12
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>15,
			 	'occurence_id' =>13 			 	
			]
		);

		//13
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>15,
			 	'occurence_id' =>8 			 	
			]
		);

		//14
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>15,
			 	'occurence_id' =>6 			 	
			]
		);

		//55
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>15,
			 	'occurence_id' =>7 			 	
			]
		);

		//56 rick ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>16,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>16,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>16,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>16,
			 	'occurence_id' =>6 			 	
			]
		);

		//60
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>16,
			 	'occurence_id' =>7 			 	
			]
		);

		//61 rachel ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>17,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>17,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>17,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>17,
			 	'occurence_id' =>6 			 	
			]
		);

		//65
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>17,
			 	'occurence_id' =>7 			 	
			]
		);

		//66 chantoel ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>18,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>18,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>18,
			 	'occurence_id' =>8		 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>18,
			 	'occurence_id' =>6 			 	
			]
		);

		//70
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>18,
			 	'occurence_id' =>7 			 	
			]
		);

		//71 andrea ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>19,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>19,
			 	'occurence_id' =>11			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>19,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>19,
			 	'occurence_id' =>6			 	
			]
		);

		//75
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>19,
			 	'occurence_id' =>7 			 	
			]
		);

		//76 edna ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>20,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>20,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>20,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>20,
			 	'occurence_id' =>6 			 	
			]
		);

		//80
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>20,
			 	'occurence_id' =>3 			 	
			]
		);

		//81  andre------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>21,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>21,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>21,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>21,
			 	'occurence_id' =>6 			 	
			]
		);

		//85
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>21,
			 	'occurence_id' =>3 			 	
			]
		);

		//86  rachel------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>22,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>22,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' => 22,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>22,
			 	'occurence_id' =>6 			 	
			]
		);

		//90
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>22,
			 	'occurence_id' =>3 			 	
			]
		);

		//91 hally -------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>23,
			 	'occurence_id' =>1 
			 	
			]
		);

		//2
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>23,
			 	'occurence_id' =>14 
			 	
			]
		);

		//3
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>23,
			 	'occurence_id' =>13 
			 	
			]
		);

		//4
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>23,
			 	'occurence_id' =>11 
			 	
			]
		);
		
		//95
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>23,
			 	'occurence_id' =>9 
			 	
			]
		);

		//96 desrene -------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>24,
			 	'occurence_id' =>1 
			 	
			]
		);

		//2
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>24,
			 	'occurence_id' =>14 
			 	
			]
		);

		//3
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>24,
			 	'occurence_id' =>13 
			 	
			]
		);

		//4
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>24,
			 	'occurence_id' =>11 
			 	
			]
		);
		
		//100
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>24,
			 	'occurence_id' =>9 
			 	
			]
		);

		//101 phill -------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>25,
			 	'occurence_id' =>1 
			 	
			]
		);

		//2
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>25,
			 	'occurence_id' =>14 
			 	
			]
		);

		//3
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>25,
			 	'occurence_id' =>13 
			 	
			]
		);

		//4
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>25,
			 	'occurence_id' =>11 
			 	
			]
		);
		
		//105
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>25,
			 	'occurence_id' =>9 
			 	
			]
		);

		//106 phillip ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>26,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>26,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>26,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>26,
			 	'occurence_id' =>6 			 	
			]
		);

		//110
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>26,
			 	'occurence_id' =>7 			 	
			]
		);

		//111 dan ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>27,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>27,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>27,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>27,
			 	'occurence_id' =>6 			 	
			]
		);

		//115
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>27,
			 	'occurence_id' =>7 			 	
			]
		);

		//116 annie ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>28,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>28,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>28,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>28,
			 	'occurence_id' =>6 			 	
			]
		);

		//120
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>28,
			 	'occurence_id' =>7 			 	
			]
		);

		//121 ashely ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>29,
			 	'occurence_id' =>13 
			 	
			]
		);

		//22
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>29,
			 	'occurence_id' =>11 			 	
			]
		);

		//23
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>29,
			 	'occurence_id' =>8 			 	
			]
		);

		//24
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>29,
			 	'occurence_id' =>6 			 	
			]
		);

		//125
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>29,
			 	'occurence_id' =>7 			 	
			]
		);

		//126 danielle ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>30,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>30,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>30,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>30,
			 	'occurence_id' =>6 			 	
			]
		);

		//130
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>30,
			 	'occurence_id' =>3 			 	
			]
		);

		//131 dan ---------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>31,
			 	'occurence_id' =>3 			 	
			]
		);

		//12
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>31,
			 	'occurence_id' =>13 			 	
			]
		);

		//13
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>31,
			 	'occurence_id' =>8 			 	
			]
		);

		//14
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>31,
			 	'occurence_id' =>6 			 	
			]
		);

		//135
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>31,
			 	'occurence_id' =>7 			 	
			]
		);

		//136 annie -------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>32,
			 	'occurence_id' =>1 
			 	
			]
		);

		//2
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>32,
			 	'occurence_id' =>14 
			 	
			]
		);

		//3
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>32,
			 	'occurence_id' =>13 
			 	
			]
		);

		//4
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>32,
			 	'occurence_id' =>11 
			 	
			]
		);
		
		//140
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>32,
			 	'occurence_id' =>9 
			 	
			]
		);

		//141 ashely ------------------------------------------
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>33,
			 	'occurence_id' =>13 
			 	
			]
		);

		//7
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>33,
			 	'occurence_id' =>11 			 	
			]
		);

		//8
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>33,
			 	'occurence_id' =>8 			 	
			]
		);

		//9
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>33,
			 	'occurence_id' =>6 			 	
			]
		);

		//145
		DB::table('user_courses')->insert(
			[
			 	'user_id' =>33,
			 	'occurence_id' =>3 			 	
			]
		);

	}
}