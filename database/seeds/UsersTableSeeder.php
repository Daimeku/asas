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
            'email' => 'mohamed@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1
            //'image_file_path' => '' 
        ]);

        //2
        User::create([
            'name' => 'ashani',
            'email' => 'ashani@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/ashani.jpg'
        ]);

        //3
        User::create([
            'name' => 'romario',
            'email' => 'romario@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/ro.jpg'
        ]);

        //4
        User::create([
            'name' => 'shenique',
            'email' => 'shenique@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/shen.jpg'
        ]);

        //5
        User::create([
            'name' => 'shantel',
            'email' => 'shantel@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/shan.jpg'
        ]);

        //6
        User::create([
            'name' => 'tyron',
            'email' => 'tyron@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1
            //'image_file_path' => 
        ]);

        //7
        User::create([
            'name' => 'andrew',
            'email' => 'andrew@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/andrew.jpg'
        ]);

        //8
        User::create([
            'name' => 'tanisha',
            'email' => 'tanisha@utech.edu.jm',
            'password' => bcrypt('password'),
            'user_type' => 3
            //'image_file_path' => '' 
        ]);

        //9
        User::create([
            'name' => 'john',
            'email' => 'john@utech.edu.jm',
            'password' => bcrypt('password'),
            'user_type' => 4
            //'image_file_path' => '' 
        ]);



                //10
        User::create([
            'name' => 'bob',
            'email' => 'bob@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/bob.jpg'
        ]);

                //11
        User::create([
            'name' => 'usain',
            'email' => 'bolt@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/bolt.jpg'
        ]);

                //12
        User::create([
            'name' => 'christopher',
            'email' => 'christopher@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/christopher.jpg'
        ]);

                //13
        User::create([
            'name' => 'lisa',
            'email' => 'lisa@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/lisa.jpg'
        ]);

                //14
        User::create([
            'name' => 'veronica',
            'email' => 'vcb@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/veronica.jpg'
        ]);

                //15
        User::create([
            'name' => 'gavin',
            'email' => 'gavin@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/gavs.jpg'
        ]);

                //16
        User::create([
            'name' => 'asafa',
            'email' => 'asafa@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/asafa.jpg'
        ]);

                //17
        User::create([
            'name' => 'shelly',
            'email' => 'pocketrocket@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '/files/shelly.jpg'
        ]);

                //18
        User::create([
            'name' => 'tessanne',
            'email' => 'tessanne@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/tessanne.jpg'
        ]);

                //19
        User::create([
            'name' => 'yendi',
            'email' => 'yendi@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/yendi.jpg'
        ]);

                //20
        User::create([
            'name' => 'etana',
            'email' => 'etana@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/etana.jpg'
        ]);

                 //21
        User::create([
            'name' => 'alfred',
            'email' => 'alfred@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/alfred.jpg'
        ]);

                //22
        User::create([
            'name' => 'alia',
            'email' => 'alia@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/alia.jpg'
        ]);

                //23
        User::create([
            'name' => 'merlene',
            'email' => 'merlene@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/merlene.jpg'
        ]);

                //24
        User::create([
            'name' => 'brigitte',
            'email' => 'brigitte@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/brigitte.jpg'
        ]);

                //25
        User::create([
            'name' => 'yohan',
            'email' => 'beast@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/yohan.jpg'
        ]);

                 //26
        User::create([
            'name' => 'nicholas',
            'email' => 'axeman@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/nicholas.JPG'
        ]);

                //27
        User::create([
            'name' => 'michael',
            'email' => 'michael@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/michael.jpg'
        ]);

                //28
        User::create([
            'name' => 'melaine',
            'email' => 'melaine@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/melaine.jpg'
        ]);

                //29
        User::create([
            'name' => 'kerron',
            'email' => 'kerron@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/kerron.jpg'
        ]);

                //30
        User::create([
            'name' => 'sherone',
            'email' => 'sherone@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/sherone.jpg'
        ]);

                 //31
        User::create([
            'name' => 'warren',
            'email' => 'warren@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/warren.jpg'
        ]);

                //32
        User::create([
            'name' => 'novlene',
            'email' => 'novlene@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/novlene.jpg'
        ]);

                //33
        User::create([
            'name' => 'christine',
            'email' => 'christine@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 2,
            'image_file_path' => '../files/christine.jpg'
        ]);

        //34
        User::create([
            'name' => 'david',
            'email' => 'david@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1
            //'image_file_path' => '' 
        ]);

        //35
        User::create([
            'name' => 'denise',
            'email' => 'denise@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1
            //'image_file_path' => '' 
        ]);
    }
} 