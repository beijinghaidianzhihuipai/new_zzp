<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpStockReport extends Model
{
    protected $table = 'stock_report';
    protected $dateFormat = 'U';
    protected $fillable = [
        'stock_code',
        'title',
        'only_key',
        'short_url',
        'report_date',
        'growth_ratio',
        'url',
        'updated_at',
        'created_at',
      ];

    public static function add($report_data){
        return $rel = self::create($report_data);
    }

    public static function check_key($only_key){ 
        return self::where('only_key', "$only_key")->first();
    }

    public static function getStockInfo(){
        $time = time()- 3*24*3600;
        $a = self::where('created_at','>',$time)->orderBy('id','DESC')->paginate(10);
        return $a;
    }

    public static function appGetStockInfo($start_num,$limit){
        return self::where('id','>','0')->orderBy('id','DESC')->offset($start_num)->limit($limit)->get();
    }


}
