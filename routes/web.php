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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

//Occasions

Route::get('/occasions', 'OccasionController@index')->name('occasions.index')->middleware('auth');
Route::get('/occasions/create', 'OccasionController@create')->name('occasions.create')->middleware('auth');
Route::post('/occasions/store', 'OccasionController@store')->name('occasions.store')->middleware('auth');



