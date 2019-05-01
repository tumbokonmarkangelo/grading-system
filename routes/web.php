<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/laravel/welcome', function () {
    return view('welcome');
});

Route::get('/', array('as'=>'Login','uses'=>'AppController'))->middleware('guest');;

Route::post('/authenticate', array('as'=>'Authenticate','uses'=>'AppController@authenticate'));
Route::get('/logout', array('as'=>'Logout','uses'=>'AppController@logout'))->middleware('auth');

Route::post('/user/create', array('as'=>'CreateUser','uses'=>'UserController@create'))->middleware('auth');
Route::get('/user/edit/{id}', array('as'=>'EditUser','uses'=>'UserController@edit'))->middleware('auth');
Route::patch('/user/update/{id}', array('as'=>'UpdateUser','uses'=>'UserController@update'))->middleware('auth');
Route::post('/user/delete', array('as'=>'DeleteUser','uses'=>'UserController@delete'))->middleware('auth');
Route::get('/user/profile', array('as'=>'UserProfile','uses'=>'UserController@profile'))->middleware('auth');
Route::get('/user/profile/manage', array('as'=>'ManageProfile','uses'=>'UserController@manage_profile'))->middleware('auth');

Route::get('/panel', array('as'=>'User','uses'=>'AppController@index'))->middleware('auth');
Route::get('/panel/search', array('as'=>'Search','uses'=>'AppController@search'))->middleware('auth');
Route::get('/panel/users/management', array('as'=>'UsersManagement','uses'=>'AppController@users_management'))->middleware('auth');
Route::get('/panel/subjects/management', array('as'=>'SubjectsManagement','uses'=>'AppController@subjects_management'))->middleware('auth');
Route::get('/panel/classes/management', array('as'=>'ClassesManagement','uses'=>'AppController@classes_management'))->middleware('auth');
Route::get('/panel/grades/management', array('as'=>'GradesManagement','uses'=>'GradeController@index'))->middleware('auth');

// subject management routes 
Route::get('/subject/create', array('as'=>'CreateSubject','uses'=>'SubjectController@create'))->middleware('auth');
Route::post('/subject/store', array('as'=>'StoreSubject','uses'=>'SubjectController@store'))->middleware('auth');
Route::get('/subject/edit/{id}', array('as'=>'EditSubject','uses'=>'SubjectController@edit'))->middleware('auth');
Route::patch('/subject/update/{id}', array('as'=>'UpdateSubject','uses'=>'SubjectController@update'))->middleware('auth');
Route::post('/subject/delete', array('as'=>'DeleteSubject','uses'=>'SubjectController@delete'))->middleware('auth');

// classes management routes 
Route::get('/class/create', array('as'=>'CreateClass','uses'=>'ClassController@create'))->middleware('auth');
Route::post('/class/store', array('as'=>'StoreClass','uses'=>'ClassController@store'))->middleware('auth');
Route::get('/class/edit/{id}', array('as'=>'EditClass','uses'=>'ClassController@edit'))->middleware('auth');
Route::patch('/class/update/{id}', array('as'=>'UpdateClass','uses'=>'ClassController@update'))->middleware('auth');
Route::post('/class/delete', array('as'=>'DeleteClass','uses'=>'ClassController@delete'))->middleware('auth');
Route::get('/class/manage/{id}/subject', array('as'=>'ManageClassSubject','uses'=>'ClassController@manage_subject'))->middleware('auth');
Route::patch('/class/update/{id}/subject', array('as'=>'UpdateClassSubject','uses'=>'ClassController@update_subject'))->middleware('auth');
Route::get('/class/subject/manage/{id}/computation', array('as'=>'ManageClassSubjectComputaion','uses'=>'ClassController@manage_subject_computaion'))->middleware('auth');
Route::patch('/class/subject/update/{id}/computation', array('as'=>'UpdateClassSubjectComputaion','uses'=>'ClassController@update_subject_computaion'))->middleware('auth');
Route::get('/class/manage/{id}/student', array('as'=>'ManageClassStudent','uses'=>'ClassController@manage_student'))->middleware('auth');
Route::patch('/class/update/{id}/student', array('as'=>'UpdateClassStudent','uses'=>'ClassController@update_student'))->middleware('auth');

// grades management routes
Route::post('/grades/assign/{id}', array('as'=>'AssignGrades','uses'=>'GradeController@assign'))->middleware('auth');
Route::get('/grades/view', array('as'=>'ViewGrade','uses'=>'GradeController@view'))->middleware('auth');
Route::get('/grades/records/{username?}', array('as'=>'ViewGradeRecords','uses'=>'GradeController@overall'))->middleware('auth');
Route::get('/grades/class-record', array('as'=>'ViewClassRecords','uses'=>'GradeController@class_record'))->middleware('auth');


// activity routes
Route::get('/activities/log', array('as'=>'ActivitiesLogs','uses'=>'ActivityController@index'))->middleware('auth');