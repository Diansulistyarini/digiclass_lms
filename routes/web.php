<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['CheckRole:admin']], function () {
    // Admin
    Route::get('/dashboardadmin', 'AdminController@dashboardadmin')->name('dashboardadmin');
    // Data User
    Route::get('/user', 'AdminController@user');
    Route::post('/user/create', 'AdminController@create');
    Route::put('/user/update/{id}', 'AdminController@update');
    Route::get('/user/destroy/{id}', 'AdminController@destroy');
    // Data Lesson
    Route::get('/lesson', 'AdminController@lesson');
    Route::post('/lesson/create', 'AdminController@create_lesson');
    Route::put('/lesson/update/{id}', 'AdminController@update_lesson');
    Route::get('/lesson/destroy/{id}', 'AdminController@destroy_lesson');
});

Route::group(['middleware' => ['CheckRole:instructor']], function () {
    // Ins
    Route::get('/dashboardins', 'InsController@dashboardins')->name('dashboardins');
});
