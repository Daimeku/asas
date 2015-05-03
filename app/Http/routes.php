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

/*
 * STUDENT ROUTES
 */

Route::get('students/home', [
	'as' => 'students/home',
	'uses' => 'StudentsController@index'
]);

Route::get('students/assignments', [
    'as' => 'students/assignments',
    'uses' => 'StudentsController@assignments'
]);

Route::get('students/tests',[
    'as' => 'students/tests',
    'uses' => 'StudentsController@tests'
]);

Route::get('students/assignments/{assessment_id}', [
    'as' => 'students/assignment',
    'uses' => 'StudentsController@assignment'
]);


Route::get('students/assessments/{assessment_id}/upload', [
    'as' => 'students/uploadAssignment',
    'uses' => 'StudentsController@uploadAssignment'
]);

Route::post('students/assessments/{assessment_id}/upload',[
    'as' => 'students/upload',
    'uses' => 'StudentsController@upload'
]);

Route::get('students/submissions', [
    'as' => 'students/submissions',
    'uses' => 'studentsController@submissions'
]);

/*
 * TEACHER ROUTES
 */

Route::get('teachers/home', [
    'as' => 'teachers/home',
    'uses' => 'TeachersController@index'
]);

Route::get('teachers/assignments', [
    'as' => 'teachers/assignments',
    'uses' => 'TeachersController@assignments'
]);

Route::get('teachers/uploadAssignment',[
    'as' => 'teachers/uploadAssignment',
    'uses' => 'TeachersController@uploadAssignment'
]);

Route::post('teachers/createAssignment',[
    'as' => 'teachers/create',
    'uses' => 'TeachersController@createAssessment'
]);

Route::get('teachers/submissions',[
    'as' => 'teachers/submissions',
    'uses' => 'teachersController@submissions'
]);

Route::get('teachers/submissions/{submission_id}',[
    'as' => 'teachers/submission',
    'uses' => 'TeachersController@submission'
]);

Route::get('teachers/submissions/{submission_id}/edit',[
    'as' => 'teachers/submission/editSubmission',
    'uses' => 'TeachersController@editSubmission'
]);

Route::post('teachers/submissions/{submission_id}/edit',[
    'as' => 'teachers/submission/edit',
    'uses' => 'TeachersController@editSub'
]);