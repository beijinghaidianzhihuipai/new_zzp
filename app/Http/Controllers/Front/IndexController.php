<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{

    public function index(){
       //echo 899;die;
        $data =  DB::table('user')->where('id','>',0)->get();
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

    public function register(){
        $data=array();
        return view('front.auth.register',$data);
    }

    public function login(){
        $data=array();
        return view('front.auth.login',$data);
    }



}
