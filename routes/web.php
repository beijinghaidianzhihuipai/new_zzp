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
//公告接口
Route::get('/front/proclamation','Front\ProclamationController@index' );
//分红预告接口
Route::get('/front/bonus_herald/{type}','Front\BonusHeraldController@index' );


//分红详情接口
Route::get('/front/get_bonus_info/{stock_code}','Front\BonusHeraldController@getBonusInfo' );

Route::get('/admin/user_management','Admin\UserManagementController@index' );

//股票下跌趋势
Route::get('/front/stock_grow','Front\StockGrowController@index' );
//获取连续下跌股票
Route::post('/front/down/stock_grow','Front\StockGrowController@getDownStock' );

//股票下跌反弹
Route::get('/front/get_down_up','Front\StockGrowController@downUpIndex' );
//获取反弹股票
Route::post('/front/down/stock_down_up','Front\StockGrowController@getDownUpStock' );

//连续上涨股票
Route::get('/front/up_stock','Front\StockGrowController@upStock' );
//连续下跌股票
Route::post('/front/get_up_stock','Front\StockGrowController@getUpStock' );

//全新头部
Route::get('/front/header','Front\IndexController@header' );

//全新尾部
Route::get('/front/footer','Front\IndexController@footer' );

Route::get('front/search_stock/{data}','Front\SearchStockController@searchStock' );

