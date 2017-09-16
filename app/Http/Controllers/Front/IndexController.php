<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\User;

class IndexController extends Controller
{

    public function index(){
        return view('front.index');
    }

    public function admin(){
        $data=array();
        return view('admin.admin',$data);
    }

    
}
