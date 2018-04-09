<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockGrow;
use App\User;
use Illuminate\Http\Request;

class StockGrowController extends Controller
{
    public function index(){
        return view('front.stockGrow');
    }

    //获取连续下跌的股票
    public function getDownStock(Request $request){
        $messages = [
            'down_days.required' => '下跌天数不能为空',
        ];
        $this->validate($request,[
            'down_days' => 'required',
        ],$messages);
        $down_days = $request->down_days;
        $down_stock = ZzpStockGrow::getDownData($down_days);
        return $down_stock;
    }

    public function downUpIndex(){
        return view('front.downUpGrow');
    }
    
    //获取连续下跌并反弹的股票
    public function getDownUpStock(Request $request){
        $messages = [
            'down_days.required' => '下跌天数不能为空',
        ];
        $this->validate($request,[
            'down_days' => 'required',
        ],$messages);
        $down_days = $request->down_days;
        $down_stock = ZzpStockGrow::getDownupData($down_days);
        return $down_stock;
    }

    public function upStock(){
        return view('front.upGrow');
    }

    //获取连续下跌的股票
    public function getUpStock(Request $request){
        $messages = [
            'up_days.required' => '下跌天数不能为空',
        ];
        $this->validate($request,[
            'up_days' => 'required',
        ],$messages);
        $up_days = $request->up_days;
        $up_stock = ZzpStockGrow::getUpData($up_days);
        return $up_stock;
    }
    
}
