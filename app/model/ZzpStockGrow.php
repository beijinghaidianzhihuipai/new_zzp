<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getDownData(){
        $where = array(
            array('grow_type' , 2),
            array('stock_time','>',0),
            array('stock_type' , 1),
        );
        $rel = self::select('stock_name','stock_code',DB::raw('sum(grow_price) as grow_price'),DB::raw('count(id) as num'))
            ->where($where)->groupBy('stock_code')
            ->having('num', '>', 1)->orderBy('grow_price', 'asc')->get();
  
        return empty($rel) ? '' : $rel->toArray();
    }


}
