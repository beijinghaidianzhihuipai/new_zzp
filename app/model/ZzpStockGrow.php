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

    public static function getDownData($down_days){

        $last_rel = self::select()->orderby('id','DESC')->first();
        $more_rel = self::select()
            ->where('stock_code',$last_rel->stock_code)
            ->orderby('id','DESC')
            ->limit($down_days)
            ->get();

        $ch_num = $down_days-1;
        $ch_time = $more_rel[$ch_num]->stock_date;
        $where = array(
            array('stock_time','>=',$ch_time),
            array('grow_type','=',2),
        );
        $rel = self::select('stock_name','stock_code','stock_type','end_price',
            DB::raw('sum(grow_price) as grow_price'),DB::raw('count(id) as num'))
            ->where($where)->groupBy('stock_code')
            ->having('num', '>=', $down_days)
            ->orderBy('grow_price', 'asc')
            ->limit(25)->get();

        return empty($rel) ? '' : $rel->toArray();
    }

    public static function checkHaveInfo($where){
        return self::where($where)->first();
    }

}
