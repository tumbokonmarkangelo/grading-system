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
Route::post('/create/user', array('as'=>'CreateUser','uses'=>'UserController@create'));

Route::get('/panel', array('as'=>'User','uses'=>'AppController@index'))->middleware('auth');
Route::get('/panel/users-management', array('as'=>'UsersManagement','uses'=>'AppController@users_management'))->middleware('auth');