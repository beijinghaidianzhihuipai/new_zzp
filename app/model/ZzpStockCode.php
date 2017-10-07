<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpStockCode extends Model
{
    protected $table = 'stock_code';
    protected $dateFormat = 'U';
    protected $fillable = [
        'stock_name',
        'stock_code',
        'stock_type',
        'is_use',
        'updated_at',
        'created_at',
      ];

    public static function add($report_data){
        return $rel = self::create($report_data);
    }

    public static function getStockInfo($where){
        return self::select('stock_code')->where($where)->get();
    }

    public static function updateData($upWhere){
        return self::where('stock_code',$upWhere['stock_code'])
            ->update(array('stock_name' => $upWhere['stock_name']));
    }

}
