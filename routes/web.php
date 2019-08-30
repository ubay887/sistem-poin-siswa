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

Route::view('/', 'auth.login')->middleware('guest');

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /*
     * Schools Routes
     */
    Route::get('schools/page', 'SchoolController@page')->name('schools.page');
    Route::post('schools/save', 'SchoolController@save')->name('schools.save');
    Route::post('schools/uploadlogo', 'SchoolController@uploadlogo')->name('schools.uploadlogo');

    /*
     * ClassNames Routes
     */
    Route::resource('class_names', 'ClassNameController');

    /*
     * Users Routes
     */
    Route::resource('users', 'UserController');
});
