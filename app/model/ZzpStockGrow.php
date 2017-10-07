<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpStockGrow extends Model
{
    protected $table = 'stock_grow';
    protected $dateFormat = 'U';
    protected $fillable = [
        'stock_name',
        'stock_code',
        'max_price',
        'min_price',
        'start_price',
        'end_price',
        'grow_price',
        'grow_type',
        'stock_time',
        'stock_date',
        'stock_type',
        'updated_at',
        'created_at',
      ];

    public static function addGrow($addInfo){
       // print_r($addInfo);die;
        return $rel = self::create($addInfo);
    }




}
