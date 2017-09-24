<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\model\ZzpOauthRefreshTokens;
use App\model\ZzpStockReport;
use App\model\ZzpUser;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class IndexController extends Controller
{
    use HasApiTokens, Notifiable;
    public function appLogin( Request $request){
        //$this->validate()
        $phone_num = $request->phone_num;
        $password = $request->password;
        $user_info = ZzpUser::getUserByMobile($phone_num);
        $data = array();

        if(!empty($user_info) && $password ==decrypt($user_info->password)){
            $token_info= ZzpOauthRefreshTokens::checkToken($user_info->id);
            $token = csrf_token();
            $token_data = array(
                'user_id' => $user_info->id,
                'access_token_id' => $token,
                'revoked' => 0,
                'expires_at' => time()+24*3600,
            );
            if(empty($token_info)){
                ZzpOauthRefreshTokens::add($token_data);
            }else{
                $expires_at = $token_info->expires_at;
                if($expires_at <time()){
                    $up_token = array(
                        'access_token_id' => $token,
                        'expires_at' => time()+24*3600,
                    );
                    ZzpOauthRefreshTokens::where('id',$token_info->id)->update($up_token);
                }else{
                    $token = $token_info->access_token_id;
                }
            }

            $data['id'] = $user_info->id;
            $data['name'] = $user_info->name;
            $data['phone_num'] = $user_info->phone_num;
            $data['email'] = $user_info->email;
            $data['token'] = $token;
            return array('error_code'=>0,'msg'=>'登录成功','data'=>$data);
        }else{
            return array('error_code'=>1,'msg'=>'用户或密码错误','data'=>$data);
        }
    }

    public function getStockReport(Request $request){
        $this->validate($request,[
            'page' => 'required|integer',
            'limit' => 'required|integer',
        ],[
            'page.required' => '请输入页码',
            'limit.required' => '请输入获取数量',
        ]);
        $page = $request->page;
        $limit = $request->limit;
        $start_num = ($page-1)*$limit;
        $stock = ZzpStockReport::appGetStockInfo($start_num,$limit);
        if(empty($stock)){print_r($stock);die;
            return array('error_code'=>0,'msg'=>'无数据','data'=>'');
        }
        $stock = $stock->toArray();
        return array('error_code'=>0,'msg'=>'查询成功','data'=>$stock);
    }


}
