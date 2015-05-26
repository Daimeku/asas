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

Route::get('students/assessments/{assessment_id}', [
    'as' => 'students/assessment',
    'uses' => 'StudentsController@assessment'
]);


Route::get('students/assessments/{assessment_id}/upload', [
    'as' => 'students/uploadAssignment',
    'uses' => 'StudentsController@uploadAssignment'
]);

Route::post('students/assessments/{assessment_id}/upload',[
    'as' => 'students/upload',
    'uses' => 'StudentsController@upload'
]);

Route::get('students/assessments/{assessment_id}/addToQueue',[
    'as' => 'students/addToQueueView',
    'uses' => 'StudentsController@addToQueueView'
]);

Route::post('students/assessments/{assessment_id}/submitHardcopy',[
    'as' => 'students/addToQueue',
    'uses' => 'StudentsController@addToQueue'
]);

Route::get('students/submissions', [
    'as' => 'students/submissions',
    'uses' => 'studentsController@submissions'
]);

Route::get('students/submissions/{submission_id}', [
    'as' => 'students/submission',
    'uses' => 'studentsController@submission'
]);

Route::get('students/download',[
    'as' => 'students/download',
    'uses' => 'StudentsController@download'
]);

Route::get('students/error',[
    'as' => 'students/error',
    'uses' => 'StudentsController@showError'
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
Route::get('teachers/tests',[
    'as' => 'teachers/tests',
    'uses' => 'TeachersController@tests'
]);

Route::get('teachers/assessments/{assessment_id}', [
    'as' => 'teachers/assessment',
    'uses' => 'TeachersController@assessment'
]);

Route::get('teachers/assessments/{assessment_id}/edit', [
    'as' => 'teachers/assessment/edit',
    'uses' => 'TeachersController@editAssessment'
]);

Route::post('teachers/assessments/{assessment_id}/edit', [
    'as' => 'teachers/edit',
    'uses' => 'TeachersController@edit'
]);

Route::get('teachers/assessments/{assessment_id}/delete', [
    'as' => 'teachers/deleteAssessment',
    'uses' => 'TeachersController@deleteAssessment'
]);

Route::get('teachers/uploadAssignment',[
    'as' => 'teachers/uploadAssignment',
    'uses' => 'TeachersController@uploadAssignment'
]);

Route::post('teachers/createAssessment',[
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

Route::get('teachers/download',[
    'as' => 'teachers/download',
    'uses' => 'TeachersController@download'
]);

Route::get('teachers/error',[
    'as' => 'teachers/error',
    'uses' => 'TeachersController@showError'
]);

/*
 * INVIGILATOR ROUTES
 */

Route::get('invigilators/home',[
    'as' => 'invigilators/home',
    'uses' => 'InvigilatorsController@index'
]);


Route::get('invigilators/tests/{assessment_id}',[
    'as' => 'invigilators/test',
    'uses' => 'InvigilatorsController@test'
]);

Route::get('invigilators/tests/{assessment_id}/studentEntry/{user_id}',[
    'as' => 'invigilators/studentEntry',
    'uses' => 'InvigilatorsController@studentEntry'
]);

Route::get('invigilators/tests/{assessment_id}/studentEntry',[
    'as' => 'invigilators/studentEntryEmpty',
    'uses' => 'InvigilatorsController@studentEntryEmpty'
]);

Route::get('invigilators/student', [
    'as' => 'findStudent',
    'uses' => 'InvigilatorsController@findStudent'
]);

Route::get('invigilators/tests/{assessment_id}/studentEntry/{user_id}/enterTest',[
    'as' => 'invigilators/enterTest',
    'uses' => 'InvigilatorsController@enterTest'
]);

Route::post('invigilators/tests/{assessment_id}/studentEntry/searchStudent',[
    'as' => 'invigilators/searchStudent',
    'uses' => 'InvigilatorsController@searchStudent'
]);

Route::get('invigilators/tests/{assessment_id}/paperCollection',[
    'as' => 'invigilators/paperCollection',
    'uses' => 'InvigilatorsController@paperCollection'
]);

Route::post('invigilators/tests/{assessment_id}/paperCollection/verifyStudent',[
    'as' => 'invigilators/collectPaper',
    'uses' => 'InvigilatorsController@collectPaper'
]);

Route::get('invigilators/error',[
    'as' => 'invigilators/error',
    'uses' => 'InvigilatorsController@showError'
]);

/*
 * Student services routes
 */

Route::get('studentServices/home',[
    'as' =>'studentServices/home',
    'uses' => 'StudentServicesController@index'
]);

Route::post('studentServices/searchStudentSubmission',[
    'as' => 'studentServices/search',
    'uses' => 'StudentServicesController@findStudentSubmission'
]);

Route::get('studentServices/acceptStudentSubmission',[
    'as' => 'studentServices/accept',
    'uses' => 'studentServicesController@acceptStudentSubmission'
]);


