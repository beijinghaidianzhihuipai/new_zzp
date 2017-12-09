<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockBasic;
use App\model\ZzpStockGrow;
use App\User;

class SearchStockController extends Controller
{
    public function index(){
        return view('front.stockGrow');
    }

    //获取连续下跌的股票
    public function searchStock($data){
        if(empty($data)){
            return false;
        }
        if(is_numeric($data)){
            $where = array(array('stock_code',$data));
            $base_info = ZzpStockBasic::getBasicInfo($where);
            $new_info = ZzpStockGrow::getInfo($where);
           // print_r($new_info);die;
        }
        $data_rel = array('base_info' => $base_info,'new_info' => $new_info);
        return view('front.searchStock')->with('data_rel',$data_rel);
    }








    
    
}
