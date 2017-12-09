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
            array('stock_date','>=',$ch_time),
            array('grow_type','=',2),
        );
        $rel = self::select('stock_grow.stock_name', 'stock_grow.stock_code',
            'stock_grow.stock_type', 'end_price', 'earnings_per_share',
            'net_profit_grow_rate', 'undistributed_profit_per_share',
            DB::raw('sum(grow_price) as grow_price'), DB::raw('count(zzp_stock_grow.id) as num'),
            DB::raw('round(end_price / earnings_per_share) as shiying'))
            ->leftJoin('stock_basic',array(array('stock_grow.stock_code','=','stock_basic.stock_code')))
            ->where($where)->groupBy('stock_grow.stock_code')
            ->having('num', '>=', $down_days)
            ->having('shiying', '>', 1)
            ->orderBy('shiying', 'asc')
            ->limit(25)->get();

        return empty($rel) ? '' : $rel->toArray();
    }

    public static function getInfo($where){
        return self::where($where)->first();
    }

}
