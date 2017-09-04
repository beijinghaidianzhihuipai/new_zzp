<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpUserPhoneMsg extends Model
{
    protected $table = 'user_phone_msg';
    protected $dateFormat = 'U';
    protected $fillable = [
        'user_id',
        'report_id',
        'updated_at',
        'created_at',
    ];

    public static function check_send_report($send_check){
        return self::where($send_check)->first();
    }

    public static function add($send_data){
        return $rel = self::create($send_data);
    }
}
