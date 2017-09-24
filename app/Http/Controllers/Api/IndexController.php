<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{

 

    public function user(){
      $data=array();
        return view('user.user',$data);
    }

    public function admin(){
        $data=array();
        return view('admin.admin',$data);
    }


}
