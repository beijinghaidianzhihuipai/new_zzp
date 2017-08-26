<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(){
echo 7878;die;
       // $rel = DB::table('tt')->select('*')->get(); print_r($rel);die;
       // $rel = Tt::find(1); print_r($rel);die;
       return view('front.index');
    }

    public function indexa(){
        echo '郭威';
    }
    public function indexb(){
        echo'松豪';
    }

}
