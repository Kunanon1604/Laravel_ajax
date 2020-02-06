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

//Load View Index
Route::get('/','Home_Controller@index');

//Insert
Route::post('/save','Home_Controller@store');

//Delelte
Route::post('/delete','Home_Controller@delete');


