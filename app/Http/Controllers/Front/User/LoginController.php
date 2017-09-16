<?php

namespace App\Http\Controllers\Front\User;
use App\Http\Controllers\Controller;
use App\model\ZzpUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{

    public function user(){
      $data=array();
        return view('front.user.user',$data);
    }
    
    //注册
    public function register(Request $request){
        $aa= Input::all();
        if($aa){
            $messages = [
                'name.required'        => 'The :attribute already been registered.',
                'email.required'   => 'The :attribute number is invalid , accepted format: xxx-xxx-xxxx',
                'password.required' => 'The :attribute format is invalid.',
                'phone_num.required' => 'The :attribute format is invalid.',
            ];
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'phone_num' => 'required',
            ],$messages);
            $password = encrypt($request->password);
            $add_data = request(['name','phone_num','email'])+array('password'=>$password);
            $user = ZzpUser::create($add_data);

            if($user){
                Session::put('user_name',$user->name);
                Session::put('user_id',$user->id);
                return  Redirect::to('/');
            }else{
                echo '注册失败';die;
            }
        }
        return view('front.auth.register');
    }

    //登录
    public function login(){
        $aa = Input::all();
        if($aa){
            $phone_num = $aa['phone_num'];
            $password = $aa['password'];
            $user_info = ZzpUser::getUserByMobile($phone_num);
            if(!empty($user_info) && $password == decrypt($user_info->password)){
                Session::put('user_name',$user_info->name);
                Session::put('user_id',$user_info->id);
                return  Redirect::to('/');
            }else{
                echo "用户或密码错误";die;
            }
        }
        return view('front.auth.login');
    }

    //退出登录
    public function loginOut(){
        Session::flush();
        return  Redirect::to('/');
    }



}
