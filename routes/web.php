<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::delete('/user/destroy/{id}', 'AdminController@destroy');
    Route::get('/user/updatepw', 'AdminController@updatepw');

    // Classes
    Route::get('/class', 'AdminController@classes');
    Route::post('/class/create', 'AdminController@create_class');
    Route::delete('/class/delete/{id}', 'AdminController@delete_class');
    Route::put('/class/update/{id}', 'AdminController@update_class');

    // Moduls
    Route::get('/moduled', 'ModulController@index');
    Route::post('/moduled/create', 'ModulController@create');
    Route::delete('/module/delete/{id}', 'ModulController@delete');
    Route::put('/moduled/update/{id}', 'ModulController@update');

    // ass
    Route:: get('/assignment', 'AssignmentController@index');
    Route:: delete('/ass/delete/{id}', 'AssignmentController@delete');
    Route:: post('/ass/create', 'AssignmentController@create');
    Route:: put('ass/update/{id}', 'AssignmentController@update');

    // schedule
    Route::get('/schedule', 'ScheduleController@index');
    Route::post('/schedule/create', 'ScheduleController@create');
    Route::delete('/schedule/delete/{id}', 'ScheduleController@delete');
    Route::put('/schedule/update/{id}', 'ScheduleController@update');
    
    // Instansi 
    Route::get('/instansi','InstansiController@index');
    Route::delete('/instansi/delete/{id}','InstansiController@delete');
    Route::post('/int/create', 'InstansiController@create');

    // User modul
    Route::get('/viewmodul', 'ModulController@list');
    Route::get('/reading{id}', 'ModulController@listdetail');

    // User Sand Ass
    Route::get('/up{id}', 'AssignmentController@formsand');
    Route::get('listass', 'AssignmentController@listuser');


    // Data Lesson
    Route::get('/lesson', 'AdminController@lesson');
    Route::post('/lesson/create', 'AdminController@create_lesson');
    Route::put('/lesson/update/{id}', 'AdminController@update_lesson');
    Route::get('/lesson/destroy/{id}', 'AdminController@destroy_lesson');

    Route::get('/updatepw', 'AdminController@updateview');
});

Route::group(['middleware' => ['CheckRole:instructor']], function () {
    // Ins
    Route::get('/dashboardins', 'InsController@dashboardins')->name('dashboardins');

    // Classes
    Route::get('/classes', 'InsController@class');
});

Route::group(['middleware' => ['CheckRole:student']], function () {
    // Student
    Route::get('/dashstudent', 'MemberController@index')->name('dashstudent');
});

// Route Change Password
Route::get('password', 'AdminController@changeview')->name('change.password');
Route::patch('password', 'AdminController@updatepw')->name('change.password');

// Update Profile
Route::get('/viewprofile', 'AdminController@view_profile')->name('viewprofile');
Route::put('/setprofile/{id}', 'AdminController@update_profile');


Route::get('/upload', function () {
    return view('user.upload_ass');
});
Route::get('/read', function () {
    return view('user.read_modul');
});

// Test Midtrans
Route::get('/payment', 'MidtransController@getSnapToken')->name('payment');

