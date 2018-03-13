<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockBonus;

use App\User;

class BonusHeraldController extends Controller
{

    public function index(){
        $stock_bonus_info =ZzpStockBonus::getBonusHerald();

        return view('front.stockBonus')->with('stock_bonus_info', $stock_bonus_info);
    }

    
}
