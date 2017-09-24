<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\ZzpUser;
use App\User;

class UserManagementController extends Controller
{

    public function index(){

        $user_data =ZzpUser::getUserInfo();
      //  print_r($user_data);die;
        return view('admin.userManagement')->with('user_data',$user_data);
    }

    public function admin(){
        $data=array();
        return view('admin.admin',$data);
    }

    
}
