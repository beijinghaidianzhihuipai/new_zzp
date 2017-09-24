<?php

namespace App\model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ZzpUser extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'user';
    protected $dateFormat = 'U';
    protected $fillable = [
        'name',
        'phone_num',
        'password',
        'email',
        'updated_at',
        'created_at'];

    //获取全部手机号
    public static function getUserMobile(){
        return self::select('id','phone_num')->where('status',1)->get();
    }

    //获取账户信息
    public static function getUserByMobile($phone_num){
        return self::select('*')->where('phone_num',$phone_num)->first();
    }

    public static function GetUserInfo(){
        return self::select('*')->where('id','>',0)->get();
    }


}
