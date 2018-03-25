<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockBasic;
use App\model\ZzpStockBonus;
use App\model\ZzpStockCode;
use App\model\ZzpStockGrow;
use App\User;

class SearchStockController extends Controller
{
    public function index(){
        return view('front.stockGrow');
    }

    //搜索股票
    public function searchStock($data){
        if(empty($data)){
            return false;
        }
        $base_info = array();
        $new_info = array();
        if(is_numeric($data)){
            $where = array(array('stock_code',$data));
            $base_info = ZzpStockBasic::getBasicInfo($where);
            $new_info = ZzpStockGrow::getInfo($where);
           // print_r($new_info);die;
        }else{
            $where = array(array('stock_name',$data));
            $stock_info = ZzpStockCode::getStockInfo($where)->first();
            if(!empty($stock_info)){
                $stock_code = $stock_info->stock_code;
                $where = array(array('stock_code',$stock_code));
                $base_info = ZzpStockBasic::getBasicInfo($where);
                $new_info = ZzpStockGrow::getInfo($where);
            }

        }
        $bonus_rel = array();
        if(isset($base_info->stock_code)){
            $bonus_where = array('stock_code' => $base_info->stock_code);
            $bonus_rel = ZzpStockBonus::getBonusInfo($bonus_where);
        }
  
        $data_rel = array(
            'base_info' => $base_info,
            'new_info' => $new_info,
            'bonus_rel' => $bonus_rel,
        );
        return view('front.searchStock')->with('data_rel',$data_rel);
    }








    
    
}
