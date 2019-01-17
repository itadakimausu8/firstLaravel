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




//Route::get('hello/{name?}', 'ThreadsController@index');
Route::get('/', 'ThreadsController@index');
Route::get('threads/new/csv', 'ThreadsController@csv');
Route::get('threads/{keyword?}', 'ThreadsController@index');
