<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockGrow;
use App\User;
use Illuminate\Http\Request;

class StockGrowController extends Controller
{
    //获取连续下跌的股票
    public function getDownStock(Request $request){
        $messages = [
            'down_days.required' => '下跌天数不能为空',
        ];
        $this->validate($request,[
            'down_days' => 'required',
        ],$messages);
        
        $down_stock = ZzpStockGrow::getDownData();
        return $down_stock;
    }

    
    
}
