<?php
/**
 * Created by PhpStorm.
 * User: Yondaimeku
 * Date: 09/02/15
 * Time: 23:08
 */

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder {

    public function run()
    {
//        DB::table('user_types')->delete();
        DB::table('users')->delete();


        DB::table('user_types')->insert([
            ['type' => 'teacher'],
            ['type' => 'student'],
            ['type' => 'student_services'],
            ['type'=> 'invigilator']
        ]);
		
		DB::table('assessment_types')->insert([
			['type' => 'assignment'],
			['type' => 'test']
		]);

        DB::table('submission_types')->insert([
            ['type' => 'hard copy'],
            ['type' => 'soft copy'],
            ['type' => 'hard and soft copy']
        ]);

  //*********************Users***************************************************************************************************     
       
        /*Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_type');
            $table->foreign('user_type')->references('id')->on('user_types');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('image_file_path')->unique();
            $table->rememberToken();
            $table->timestamps();
        });*/

        //1
        User::create([
            'name' => 'mohamed',
            'email' => 'email@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1,
            'image_file_path' => 
        ]);

        //2
        User::create([
            'name' => 'ashani',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

        //3
        User::create([
            'name' => 'romario',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

        //4
        User::create([
            'name' => 'shenique',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

        //5
        User::create([
            'name' => 'shantel',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

        //6
        User::create([
            'name' => 'tyron',
            'email' => '@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1,
            'image_file_path' => 
        ]);

        //7
        User::create([
            'name' => 'andrew',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

        //8
        User::create([
            'name' => 'tanisha',
            'email' => 'tanisha@utech.edu.jm',
            'password' => bcrypt('password'),
            'user_type' => 3,
            'image_file_path' => 
        ]);

        //9
        User::create([
            'name' => 'john',
            'email' => 'john@utech.edu.jm',
            'password' => bcrypt('password'),
            'user_type' => 4,
            'image_file_path' => 
        ]);



                //10
        User::create([
            'name' => 'corie',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //11
        User::create([
            'name' => 'paul',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //12
        User::create([
            'name' => 'fred',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //13
        User::create([
            'name' => 'dyan',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //14
        User::create([
            'name' => 'donna',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //15
        User::create([
            'name' => 'chris',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //16
        User::create([
            'name' => 'rick',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //17
        User::create([
            'name' => 'rachel',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //18
        User::create([
            'name' => 'chantol',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //19
        User::create([
            'name' => 'andrea',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //20
        User::create([
            'name' => 'edna',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                 //21
        User::create([
            'name' => 'andre',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //22
        User::create([
            'name' => 'rachel',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //23
        User::create([
            'name' => 'hally',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //24
        User::create([
            'name' => 'desrene',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //25
        User::create([
            'name' => 'phill',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                 //26
        User::create([
            'name' => 'phillip',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //27
        User::create([
            'name' => 'dan',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //28
        User::create([
            'name' => 'annie',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //29
        User::create([
            'name' => 'ashely',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //30
        User::create([
            'name' => 'danielle',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                 //31
        User::create([
            'name' => 'dan',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //32
        User::create([
            'name' => 'annie',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

                //33
        User::create([
            'name' => 'ashely',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../oastas/database/files/'
        ]);

        //34
        User::create([
            'name' => 'david',
            'email' => '@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1,
            'image_file_path' => 
        ]);

        //35
        User::create([
            'name' => 'denise',
            'email' => '@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1,
            'image_file_path' => '' 
        ]);
    }
} 