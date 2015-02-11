<?php
/**
 * Created by PhpStorm.
 * User: Yondaimeku
 * Date: 09/02/15
 * Time: 23:08
 */

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder {

    public function run()
    {
//        DB::table('user_types')->delete();
        DB::table('users')->delete();


        DB::table('user_types')->insert([
            ['type' => 'teacher'],
            ['type' => 'student']
        ]);

        \App\User::create([
            'name' => 'mohamed',
            'email' => 'email@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 1,

        ]);
    }
} 