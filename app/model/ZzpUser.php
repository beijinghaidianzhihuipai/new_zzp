<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpUser extends Model
{
    protected $table = 'user';
    protected $fillable = [
        'name',
        'icon',
        'phone_num',
        'email',
        'updated_at',
        'created_at'];

    public static function getUserMobile(){
        return self::select('id','phone_num')->where('id','<',2)->get();
    }
}
