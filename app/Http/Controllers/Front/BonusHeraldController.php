<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockBonus;

use App\User;

class BonusHeraldController extends Controller
{

    public function index($type){
        $stock_bonus_info = ZzpStockBonus::getBonusHerald($type);
        return view('front.stockBonus')->with('stock_bonus_info', $stock_bonus_info);

    }

    public function getBonusInfo($stock_code){
        $where = array('stock_code' => $stock_code);
        $stock_bonus_info = ZzpStockBonus::getBonusInfo($where);
        $rel_data = array(
            'stock_code' => $stock_code,
            'stock_name' => $stock_bonus_info[0]->stock_name,
            'stock_data' => $stock_bonus_info,
        );
        return view('front.yearlyBonus')->with('stock_bonus_info', $rel_data);
    }
    
}
