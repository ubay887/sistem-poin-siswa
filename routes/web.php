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
    // Route::patch('schools/{school}/update', 'SchoolController@update')->name('schools.update');
    // Route::delete('schools/{school}/destroy', 'SchoolController@destroy')->name('schools.destroy');

    // Route::post('schools/{school}/uploadlogo', 'SchoolController@uploadlogo')->name('schools.uploadlogo');
    // Route::delete('schools/{school}/deletelogo', 'SchoolController@destroylogo')->name('schools.destroylogo');
});

/*
 * ClassNames Routes
 */
Route::resource('class_names', 'ClassNameController');
