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

//display all drives
Route::get('drives', "DriveController@index")->name('drives.index');
// go to create page(add page)
Route::get('drive/create' , "DriveController@create")->name('drives.create');
// to insert database
Route::post('drive/create','DriveController@store')->name('drives.store');
// display one itim
Route::get('drive/show/{id}','DriveController@show')->name('drives.show');
//edit page
Route::get('drive/edit/{id}','DriveController@edit')->name('drives.edit');
// update in database
Route::post('drive/edit/{id}','DriveController@update')->name('drives.update');
// delete item from database
Route::get('drive/delete/{id}','DriveController@destroy')->name('drives.destroy');


Route::get('drive/download/{id}','DriveController@download')->name('drives.download');
