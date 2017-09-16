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

    public function addUser(Request $request){

       // Session::put('user_name','aaaa');
       // $val = Session::get('user_name');
       // echo $val;die;
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

        }
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

    public function login(){
        $data=array();
        return view('front.auth.login',$data);
    }



}
