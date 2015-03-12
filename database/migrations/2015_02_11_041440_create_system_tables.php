<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('type');
        });

        Schema::create('assessment_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('type');
        });

        Schema::create('submission_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('type');
        });


        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_type');
            $table->foreign('user_type')->references('id')->on('user_types');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('faculties', function( Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('code', 10);
            $table->timestamps();
        });

        Schema::create('schools', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('code', 10);
            $table->unsignedInteger('faculty_id');
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->timestamps();
        });


        Schema::create('courses', function(Blueprint $table){
            $table->increments('id');
            $table->text('description');
            $table->string('code', 10);
            $table->string('name');
            $table->unsignedInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->timestamps();
        });


        Schema::create('occurences', function(Blueprint $table){
            $table->increments('id');
            $table->string('code');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
        });

        Schema::create('assessments', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->text('filepath');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('assessment_type');
            $table->foreign('assessment_type')->references('id')->on('assessment_types');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
        });


        Schema::create('submissions', function(Blueprint $table){
            $table->increments('id');
            $table->text('filepath');
            $table->dateTime('time');
            $table->boolean('accepted');
            $table->unsignedInteger('submission_type');
            $table->foreign('submission_type')->references('id')->on('submission_types');
            $table->unsignedInteger('assessment_id');
            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->timestamps();
        });

        Schema::create('user_submissions', function(Blueprint $table){
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('submission_id');
            $table->foreign('submission_id')->references('id')->on('submissions');
            $table->integer('entered_test'); 
            $table->integer('paper_collected');
            $table->timestamps();
        });

        Schema::create('user_courses', function(Blueprint $table){
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::drop('user_submissions');
        Schema::drop('submissions');

       
        Schema::drop('assessments');
        Schema::drop('assessment_types');

        Schema::drop('user_courses');
        Schema::drop('occurences');
        Schema::drop('courses');




        Schema::drop('schools');
        Schema::drop('faculties');



        Schema::drop('users');
        Schema::drop('user_types');

    }

}
