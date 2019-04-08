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
Route::get('/logout', array('as'=>'Logout','uses'=>'AppController@logout'));

Route::post('/user/create', array('as'=>'CreateUser','uses'=>'UserController@create'));
Route::get('/user/edit/{id}', array('as'=>'EditUser','uses'=>'UserController@edit'));
Route::patch('/user/update/{id}', array('as'=>'UpdateUser','uses'=>'UserController@update'));
Route::post('/user/delete', array('as'=>'DeleteUser','uses'=>'UserController@delete'));

Route::get('/panel', array('as'=>'User','uses'=>'AppController@index'))->middleware('auth');
Route::get('/panel/users/management', array('as'=>'UsersManagement','uses'=>'AppController@users_management'))->middleware('auth');
Route::get('/panel/subjects/management', array('as'=>'SubjectsManagement','uses'=>'AppController@subjects_management'))->middleware('auth');
Route::get('/panel/classes/management', array('as'=>'ClassesManagement','uses'=>'AppController@classes_management'))->middleware('auth');

// subject management routes 
Route::get('/subject/create', array('as'=>'CreateSubject','uses'=>'SubjectController@create'));
Route::post('/subject/store', array('as'=>'StoreSubject','uses'=>'SubjectController@store'));
Route::get('/subject/edit/{id}', array('as'=>'EditSubject','uses'=>'SubjectController@edit'));
Route::patch('/subject/update/{id}', array('as'=>'UpdateSubject','uses'=>'SubjectController@update'));
Route::post('/subject/delete', array('as'=>'DeleteSubject','uses'=>'SubjectController@delete'));

// classes management routes 
Route::get('/class/create', array('as'=>'CreateClass','uses'=>'ClassController@create'));
Route::post('/class/store', array('as'=>'StoreClass','uses'=>'ClassController@store'));
Route::get('/class/edit/{id}', array('as'=>'EditClass','uses'=>'ClassController@edit'));
Route::patch('/class/update/{id}', array('as'=>'UpdateClass','uses'=>'ClassController@update'));
Route::post('/class/delete', array('as'=>'DeleteClass','uses'=>'ClassController@delete'));