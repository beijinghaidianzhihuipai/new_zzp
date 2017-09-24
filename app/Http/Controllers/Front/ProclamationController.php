<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpStockReport;
use App\User;

class ProclamationController extends Controller
{

    public function index(){
        $stock_info =ZzpStockReport::getStockInfo();

        return view('front.proclamation')->with('stock_infos',$stock_info);
    }

    public function admin(){
        $data=array();
        return view('admin.admin',$data);
    }

    
}
