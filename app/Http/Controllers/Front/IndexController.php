<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function index(){

        $rel = DB::table('zzp_user')->select('*')->get(); print_r($rel);die;
        $rel = Tt::find(1); print_r($rel);die;
       $data = array('高松豪');
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
