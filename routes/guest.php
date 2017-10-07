<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->post('/user', function (Request $request) { //echo 8989;die;
    return $request->user();
});

Route::post('app_login','Guest\IndexController@appLogin' );
Route::post('get_stock_report','Guest\IndexController@getStockReport' ); // 获取股票公告