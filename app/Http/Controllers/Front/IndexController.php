<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\model\ZzpUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class IndexController extends Controller
{

    public function index(){
        $data =  DB::table('user')->where('id','>',0)->get();
        return view('front.index', $data);
    }

    public function admin(){
        $data=array();
        return view('admin.admin',$data);
    }

    
}
