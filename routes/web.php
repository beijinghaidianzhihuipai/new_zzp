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

Route::get('/front/indexc','Front\SonghaoController@aaa' );

Route::get('/','Front\IndexController@index' );

Route::any('/front/register','Front\IndexController@register' );
Route::post('/front/add_user','Front\IndexController@addUser' );

Route::get('/front/login','Front\IndexController@login' );


Route::get('/front/user','Front\IndexController@user' );

Route::get('/front/admin','Front\IndexController@admin' );


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
