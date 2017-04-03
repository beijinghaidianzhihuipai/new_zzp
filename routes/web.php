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

Route::get('/indexc','Front\SonghaoController@indexc' );

Route::get('/indexb','Front\IndexController@indexb' );

Route::get('/indexa','Front\IndexController@indexa' );

Route::get('/','Front\IndexController@index' );

Route::get('/admin','Admin\AdminController@index' );


