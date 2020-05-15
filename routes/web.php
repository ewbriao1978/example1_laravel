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

Route::get('/', 'HomeController@index');
Route::get('/registration','HomeController@registrationMethod');
Route::post('/loginuser','HomeController@loginAuth');
Route::post('/insertdatauser', 'HomeController@insertDataUser');
Route::get('/customersession/{id}','HomeController@customerSession')->name('customersession');
Route::get('/adminsession','AdminController@adminSession');
Route::get('/logout', 'HomeController@logout');
Route::get('/insertformorder/{id}', 'HomeController@insertOrder');
Route::post('/saveorder/{id}','HomeController@saveOrder');
Route::get('/delete/{id}', 'HomeController@removeOrder');
Route::get('/edit/{id}', 'HomeController@edit');
Route::post('/update/{id}', 'HomeController@update');
