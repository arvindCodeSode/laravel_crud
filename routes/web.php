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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource("student","StudentController");
Route::post('student/store_profile',"StudentController@store_profile")->name('store_profile');
Route::patch('student/update_profile/{id}',"StudentController@update_profile")->name('update_profile');
