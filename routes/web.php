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


Route::get('/','Front\IndexController@index' );

Route::any('/front/register','Front\User\LoginController@register' );
Route::post('/front/add_user','Front\User\LoginController@addUser' );
Route::get('/front/login','Front\User\LoginController@login' );


Route::get('/front/user','Front\User\LoginController@user' );
Route::get('/front/admin','Front\LoginController@admin' );

