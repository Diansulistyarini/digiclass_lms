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

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['CheckRole:admin']], function () {
    // Admin
    Route::get('/dashboardadmin', 'AdminController@dashboardadmin')->name('dashboardadmin');
  
    // Data User
    Route::get('/user', 'AdminController@user');
    Route::post('/user/create', 'AdminController@create');
    Route::put('/user/update/{id}', 'AdminController@update');
    Route::delete('/user/destroy/{id}', 'AdminController@destroy');
    Route::get('/user/updatepw', 'AdminController@updatepw');
    Route::get('/data_ins/cetak_pdf', 'AdminController@cetak_pdfIns');

    // Classes
    Route::get('/class', 'AdminController@classes');
    Route::post('/class/create', 'AdminController@create_class');
    Route::delete('/class/delete/{id}', 'AdminController@delete_class');
    Route::put('/class/update/{id}', 'AdminController@update_class');
    Route::get('/siswa{category}', 'AdminController@show');
    Route::get('/data_member/cetak_pdf{category}', 'AdminController@cetak_pdfMember');

    // Moduls
    Route::get('/moduls', 'ModulController@index');

    // ass
    Route:: get('/assignment', 'AssignmentController@index');
   
    // schedule
    Route::get('/schedule', 'ScheduleController@index');
    Route::post('/schedule/create', 'ScheduleController@create');
    Route::delete('/schedule/delete/{id}', 'ScheduleController@delete');
    Route::put('/schedule/update/{id}', 'ScheduleController@update');
    
    // Instansi 
    Route::get('/instansi','InstansiController@index');
    Route::delete('/instansi/delete/{id}','InstansiController@delete');
    Route::post('/int/create', 'InstansiController@create');

    // Data Lesson
    // Route::get('/lesson', 'AdminController@lesson');
    // Route::post('/lesson/create', 'AdminController@create_lesson');
    // Route::put('/lesson/update/{id}', 'AdminController@update_lesson');
    // Route::get('/lesson/destroy/{id}', 'AdminController@destroy_lesson');

    // Route::get('/updatepw', 'AdminController@updateview');
});

Route::group(['middleware' => ['CheckRole:instructor']], function () {
    // Ins
    Route::get('/dashboardins', 'InsController@dashboardins')->name('dashboardins');

    // Classes
    Route::get('/classes', 'InsController@class');
    Route::get('/data', 'InsController@selectClass');
    Route::get('/student{category}', 'InsController@show');

     // schedule
     Route::get('/scheduls', 'InsController@schedule');
     Route::post('/scheduls/create', 'InsController@createSchedule');
     Route::delete('/scheduls/delete/{id}', 'InsController@deleteSchedule');
     Route::put('/scheduls/update/{id}', 'InsController@updateSchedule');

      // Moduls
    Route::get('/moduled', 'ModulController@index');
    Route::post('/moduled/create', 'ModulController@create');
    Route::delete('/module/delete/{id}', 'ModulController@delete');
    Route::put('/moduled/update/{id}', 'ModulController@update');

     // assignment
     Route:: get('/assignments', 'AssignmentController@index');
     Route:: delete('/ass/delete/{id}', 'AssignmentController@delete');
     Route:: post('/ass/create', 'AssignmentController@create');
     Route:: put('ass/update/{id}', 'AssignmentController@update');
});

Route::group(['middleware' => ['CheckRole:student']], function () {
    // Student
    Route::get('/dashstudent', 'MemberController@index')->name('dashstudent');

    // User modul
    Route::get('/viewmodul', 'ModulController@list');
    Route::get('/reading{id}', 'ModulController@listdetail');

    // User Sand Ass
    Route::get('/up{id}', 'AssignmentController@formsand');
    Route::get('listass', 'AssignmentController@listuser');
    
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

// Notificaton alert
Route::get('/pesan','NotifController@index');
Route::get('/pesan/adding','NotifController@adding');
Route::get('/pesan/update','NotifController@update');
Route::get('/pesan/gagal','NotifController@gagal');

// Test Midtrans
Route::get('/payment', 'MidtransController@getSnapToken')->name('payment');
Route::get('/pay', 'paymentController@payment');


