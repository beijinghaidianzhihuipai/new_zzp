<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
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

    public static function getUserMobile(){
        return self::select('id','phone_num')->where('id','>',0)->get();
    }
}
