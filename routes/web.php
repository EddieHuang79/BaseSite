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

Route::resource('/', 'IndexController');
Route::get('index', ['as'=>'index','uses'=>'IndexController@index']);

Route::resource('user', 'UserController');

Route::resource('role', 'RoleController');

Route::resource('service', 'ServiceController');

Route::get('login', ['as'=>'login.index','uses'=>'Auth\LoginController@index']);

Route::get('logout', ['as'=>'login.index','uses'=>'Auth\LoginController@logout']);

Route::post('login', ['as'=>'login.process','uses'=>'Auth\LoginController@process']);

// Route::get('refresh', ['as'=>'login.refresh','uses'=>'Auth\LoginController@refresh']);
Route::post('refresh', ['as'=>'login.refresh','uses'=>'Auth\LoginController@refresh']);

Route::get('record', ['as'=>'record.index','uses'=>'RecordController@index']);

// Route::get('service', ['as'=>'service.index','uses'=>'Service@index']);