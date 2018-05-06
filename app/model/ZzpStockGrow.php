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
        'brunt_control',
        'updated_at',
        'created_at',
      ];

    public static function addGrow($addInfo){
        return $rel = self::create($addInfo);
    }

    public static function getDownData($down_days){
        $last_rel = self::select()->orderby('id','DESC')->first();
        $last_stock_date = $last_rel->stock_date;
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
            array('start_price','>',0),
        );
        $code_rel = self::select( 'stock_code', DB::raw('count(id) as num'))
            ->where($where)->groupBy('stock_code')
            ->having('num', '>=', $down_days)
            ->pluck('stock_code')->toArray();

        $rel = self::select('stock_grow.stock_name', 'stock_grow.stock_code',
            'stock_grow.stock_type', 'end_price', 'earnings_per_share', 'brunt_control',
            'net_profit_grow_rate', 'undistributed_profit_per_share', 'change_ratio')
            ->leftJoin('stock_basic',array(array('stock_grow.stock_code','=','stock_basic.stock_code')))
            ->where('stock_date', $last_stock_date)
            ->having('change_ratio', '>=', 0)
            ->whereIn('stock_grow.stock_code', $code_rel)
            ->orderBy('change_ratio', 'asc')
            ->limit(35)->get();
        foreach ($rel as $key => $value){
            $where = array(
                array('stock_date', '>=', $ch_time),
                array('grow_type', '=', 2),
                array('start_price', '>', 0),
                array('stock_code', '=', $value->stock_code),
            );
            $grow_price = self::select(DB::raw('sum(grow_price) as grow_price'))
                ->where($where)
                ->first()
                ->toArray();
            $rel[$key]->grow_price = $grow_price['grow_price'];
        }

        return empty($rel) ? '' : $rel->toArray();
    }

    public static function getDownUpData($down_days){
        $last_rel = self::select()->orderby('id','DESC')->first();
        $stock_today = $last_rel->stock_date;
        $today_where = array(
            'stock_date' => $stock_today,
            'grow_type' => 1
        );
        $up_stock = self::where($today_where)
            ->pluck('stock_code')->toArray();

        $new_down_days = $down_days + 1;
        $more_rel = self::select()
            ->where('stock_code',$last_rel->stock_code)
            ->orderby('id','DESC')
            ->limit($new_down_days)
            ->get();

        $ch_time = $more_rel[$down_days]->stock_date;
        $end_ch_time = $more_rel[1]->stock_date;
        $where = array(
            array('grow_type','=',2),
            array('start_price','>',0),
        );
        $rel = self::select('stock_grow.stock_name', 'stock_grow.stock_code',
            'stock_grow.stock_type', 'end_price', 'earnings_per_share', 'brunt_control',
            'net_profit_grow_rate', 'undistributed_profit_per_share',
            DB::raw('sum(grow_price) as grow_price'), DB::raw('count(zzp_stock_grow.id) as num'),
            'change_ratio')
            ->leftJoin('stock_basic',array(array('stock_grow.stock_code','=','stock_basic.stock_code')))
            ->where($where)
            ->whereBetween('stock_date', [$ch_time, $end_ch_time])
            ->whereIn('stock_grow.stock_code',$up_stock)
            ->groupBy('stock_grow.stock_code')
            ->having('num', '>=', $down_days)
            ->having('change_ratio', '>=', 0)
            ->orderBy('change_ratio', 'asc')
            ->limit(35)->get();

        return empty($rel) ? '' : $rel->toArray();
    }


    //连续上涨
    public static function getUpData($up_days){
        $other_up_days = $up_days + 1;
        $last_rel = self::select()->orderby('id','DESC')->first();
        $more_rel = self::select()
            ->where('stock_code',$last_rel->stock_code)
            ->orderby('id','DESC')
            ->limit($other_up_days)
            ->get();

        $ch_num = $up_days-1;
        $ch_time = $more_rel[$ch_num]->stock_date;
        $other_ch_time = $more_rel[$up_days]->stock_date;
        $where = array(
            array('stock_date', '>=', $ch_time),
            array('grow_type', '=', 1),
            array('start_price', '>', 0),
            array('cash_flow_per_share', '>', 0),
        );

        $zhang_code_rel = self::select('stock_grow.stock_code',
          DB::raw('count(zzp_stock_grow.id) as num'))
            ->leftJoin('stock_basic',array(array('stock_grow.stock_code','=','stock_basic.stock_code')))
            ->where($where)->groupBy('stock_grow.stock_code')
            ->having('num', '>=', $up_days)
            ->pluck('stock_code')->toArray();

        $other_where = array(
            array('stock_date','=',$other_ch_time),
            array('grow_type','=',2),
            array('start_price','>',0),
        );

        $other_code_rel = self::where($other_where)->groupBy('stock_grow.stock_code')
            ->pluck('stock_code')->toArray();

        //交集
        $intersection = array_intersect($zhang_code_rel, $other_code_rel);

        $rel = self::select('stock_grow.stock_name', 'stock_grow.stock_code',
            'stock_grow.stock_type', 'end_price', 'earnings_per_share', 'brunt_control',
            'net_profit_grow_rate', 'undistributed_profit_per_share',
            DB::raw('sum(grow_price) as grow_price'), 'change_ratio')
            ->leftJoin('stock_basic',array(array('stock_grow.stock_code','=','stock_basic.stock_code')))
            ->where($where)->whereIn('stock_grow.stock_code', $intersection)
            ->groupBy('stock_grow.stock_code')
            ->having('change_ratio', '>=', 0)
            ->orderBy('change_ratio', 'asc')
            ->limit(35)->get();

        return empty($rel) ? '' : $rel->toArray();
    }

    public static function getInfo($where){
        return self::where($where)->first();
    }

}
