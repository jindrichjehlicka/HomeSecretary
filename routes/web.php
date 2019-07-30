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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


//Occasions
Route::get('/occasions', 'OccasionController@index')->name('occasions.index')->middleware('auth');
Route::get('/occasions/create', 'OccasionController@create')->name('occasions.create')->middleware('auth');
Route::post('/occasions/store', 'OccasionController@store')->name('occasions.store')->middleware('auth');
Route::get('/occasions/{occasion}', 'OccasionController@show')->name('occasions.show')->middleware('auth');
Route::get('/occasions/edit/{occasion}', 'OccasionController@edit')->name('occasions.edit')->middleware('auth');
Route::put('/occasions/update/{occasion}', 'OccasionController@update')->name('occasions.update')->middleware('auth');
Route::get('/occasions/destroy/{occasion}', 'OccasionController@destroy')->name('occasions.destroy')->middleware('auth');

//tasks
Route::get('/tasks', 'TaskController@index')->name('tasks.index')->middleware('auth');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create')->middleware('auth');
Route::post('/tasks/store', 'TaskController@store')->name('tasks.store')->middleware('auth');
Route::get('/tasks/{task}', 'TaskController@show')->name('tasks.show')->middleware('auth');

//groups
Route::get('/groups', 'GroupController@index')->name('groups.index')->middleware('auth');
Route::get('/groups/create', 'GroupController@create')->name('groups.create')->middleware('auth');
Route::post('/groups/store', 'GroupController@store')->name('groups.store')->middleware('auth');
Route::get('/groups/{group}', 'GroupController@show')->name('groups.show')->middleware('auth');

//user
Route::get('/users/search', 'UserController@search')->name('users.search')->middleware('auth');



