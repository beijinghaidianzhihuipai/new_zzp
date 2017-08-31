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

Route::get('/indexc','Front\SonghaoController@aaa' );

Route::get('/','Front\IndexController@index' );

Route::get('/user','Front\IndexController@user' );

Route::get('/admin','Front\IndexController@admin' );

