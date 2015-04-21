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
Route::get('home', 'HomeController@index');
Route::get('record/user', 'HomeController@myRecords');
Route::post('record/download/{id}', 'HomeController@download');
/*Route::get('admin/', 'AdminController@index');
Route::get('admin/user/{id}', 'AdminController@user');
Route::get('myRecords', 'AdminController@myRecords');
Route::post('admin/user', 'AdminController@editUser');
Route::delete('admin/delete/{id}', 'AdminController@deleteUser');*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*Route::get('/addingRecord', 'HomeController@addingRecord');
Route::post('/record/add', 'HomeController@addRecord');
Route::get('/record/{id}', 'HomeController@record');
Route::post('/record/download', 'HomeController@download');
Route::post('/record/delete', 'HomeController@delete');
Route::post('/record/revision/add', 'HomeController@addRevision');*/

Route::resource('record', 'RecordController', ['except' => ['edit', 'update']]);
Route::resource('admin', 'AdminController', ['except' => ['create', 'store', 'show']]);
Route::resource('revision', 'RevisionController', ['except' => ['index', 'create', 'show']]);