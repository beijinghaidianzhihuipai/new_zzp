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
//注册
Route::any('/front/register','Front\User\LoginController@register' );

//登录
Route::any('/front/login','Front\User\LoginController@login' );
Route::any('/front/login_out','Front\User\LoginController@loginOut' );

Route::get('/front/user','Front\User\LoginController@user' );
Route::get('/front/admin','Front\LoginController@admin' );

Route::get('/front/proclamation','Front\ProclamationController@index' );

Route::get('/admin/user_management','Admin\UserManagementController@index' );

//股票趋势
Route::get('/front/stock_grow','Front\StockGrowController@index' );
//获取连续下跌股票
Route::post('/front/down/stock_grow','Front\StockGrowController@getDownStock' );

//全新头部
Route::get('/front/header','Front\IndexController@header' );

//全新尾部
Route::get('/front/footer','Front\IndexController@footer' );

