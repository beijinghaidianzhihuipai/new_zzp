<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{

    public function getStockReport(){
       echo 899;die;
        $rel =  DB::table('user')->where('id','>',0)->get();
        print_r($rel);die;
        return view('front.index', $data);
    }

    public function user(){
      $data=array();
        return view('user.user',$data);
    }

    public function admin(){
        $data=array();
        return view('admin.admin',$data);
    }


}
