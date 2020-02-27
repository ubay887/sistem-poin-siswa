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
    Route::group(['namespace' => 'Dashboard'], function () {
        /*
         * Dashboard Routes
         */
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    });

    /*
     * Admin Only
     */
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['namespace' => 'References'], function () {
            /*
             * Options Routes
             */
            Route::get('options/page', 'OptionController@page')->name('options.page');
            Route::post('options/save', 'OptionController@save')->name('options.save');
            Route::post('options/uploadlogo', 'OptionController@uploadlogo')->name('options.uploadlogo');
        });

        /*
         * ClassNames Routes
         */
        Route::resource('class_names', 'Classes\ClassNameController');

        /*
         * Users Routes
         */
        Route::resource('users', 'Users\UserController');
    });
});
