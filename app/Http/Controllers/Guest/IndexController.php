<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\model\ZzpOauthRefreshTokens;
use App\model\ZzpUser;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class IndexController extends Controller
{   use HasApiTokens, Notifiable;
    public function appLogin( Request $request){

        $phone_num = $request->phone_num;
        $password = $request->password;
        $user_info = ZzpUser::getUserByMobile($phone_num);
       // echo $user_info->password;die;

        if(!empty($user_info) && $password ==decrypt($user_info->password)){
           // echo 8985559;die;
            $token_info= ZzpOauthRefreshTokens::checkToken($user_info->id);

            $token = csrf_token();
            $token_data = array(
                'user_id' => $user_info->id,
                'access_token_id' => $token,
                'revoked' => 0,
                'expires_at' => time()+24*3600,
            );//print_r($token_data);die;
            //print_r($token_info->fill($token_data));die;
            if(empty($token_info)){
                ZzpOauthRefreshTokens::add($token_data);
            }else{
                print_r($token_info);die;
            }

                print_r($token_data);die;
           //echo 7888;die;
        }else{
            echo "用户或密码错误";die;
        }

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
