<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockBonus;

use App\User;
use Illuminate\Support\Facades\Input;

class BonusHeraldController extends Controller
{

    public function index($type){
        $now_month = date('m', strtotime(' now '));
        $second_month = date('m', strtotime('+1 month'));
        $third_month = date('m', strtotime('+2 month'));
        $fourth_month = date('m', strtotime('+3 month'));
        $fifth_month = date('m', strtotime('+4 month'));
        $sixth_month = date('m', strtotime('+5 month'));

        $search_month = empty(Input::get('month')) ? $now_month : Input::get('month');

        $stock_bonus_info = ZzpStockBonus::getBonusHerald($type, $search_month);



        $month_preg = array(
            '01' => '一月份',   '02' => '二月份',
            '03' => '三月份',   '04' => '四月份',
            '05' => '五月份',   '06' => '六月份',
            '07' => '七月份',   '08' => '八月份',
            '09' => '九月份',   '10' => '十月份',
            '11' => '十一月份', '12' => '十二月份',
        );

        $month = array(
            $now_month    => $month_preg[$now_month],
            $second_month => $month_preg[$second_month],
            $third_month  => $month_preg[$third_month],
            $fourth_month => $month_preg[$fourth_month],
            $fifth_month  => $month_preg[$fifth_month],
            $sixth_month  => $month_preg[$sixth_month]
        );
       
        $rel_data = array(
            'stock_bonus_info' => $stock_bonus_info,
            'month' => $month,
            'type' => $type
        );
        return view('front.stockBonus')->with('rel_data', $rel_data);
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
