<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('test', function(){
    return "test string";
});

Route::get('login',[
   'as' => 'login',
    'uses' => 'Auth\AuthController@showLogin'
]);

//Route::post('login',[
//    'uses' => 'Auth\AuthController@login'
//]);


Route::get('students/home', [
	'as' => 'students/home',
	'uses' => 'StudentsController@index'
]);

Route::get('students/assignments', [
    'as' => 'students/assignments',
    'uses' => 'studentsController@assignments'
]);

Route::get('students/assignments/{assessment_id}', [
    'as' => 'students/assignment',
    'uses' => 'studentsController@assignment'
]);


Route::get('students/assessments/{assessment_id}/upload', [
    'as' => 'students/uploadAssignment',
    'uses' => 'StudentsController@uploadAssignment'
]);

Route::post('students/assessments/{assessment_id}/upload',[
    'as' => 'students/upload',
    'uses' => 'StudentsController@upload'
]);
Route::get('courses',[
    'uses'  => 'CoursesController@index'
]);
