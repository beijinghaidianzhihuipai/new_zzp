<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZzpStockBonus extends Model
{
    protected $table = 'stock_bonus';
    protected $dateFormat = 'U';
    protected $fillable = [
        'stock_code',
        'stock_name',
        'release_date',
        'bonus_money',
        'give_stock_num',
        'conversion_stock_num',
        'register_date',
        'bonus_total_money',
        'elimination_date',
        'only_key',
        'updated_at',
        'created_at',
      ];

    public static function add($report_data){
        return $rel = self::create($report_data);
    }

    public static function getBonusInfo($where){
        return self::where($where)->orderBy('id','ASC')->paginate(25);
    }

    public static function check_key($only_key){
        return self::where('only_key', "$only_key")->first();
    }

    public static function getBonusHerald($type = 1, $search_month){
        $now_year = date('Y', time());
        $qunian = $now_year - 1;
        $qiannian = $now_year - 2;
        $qunian_moon = $qunian.'-'.$search_month;
        $qiannian_moon = $qiannian.'-'.$search_month;


        $qunian_code = self::where([['bonus_total_money', '>', 0]])
            ->where('release_date', 'like', "%$qunian_moon%")
            ->pluck('stock_code' )->toArray();

        //前年已分红的工票
        $qiannian_code = self::where([['bonus_total_money', '>', 0]])
             ->Where('release_date', 'like', "%$qiannian_moon%")
            ->pluck('stock_code' )->toArray();

        //今年已经分红的股票
        $now_year_code = self::where([['bonus_total_money', '>', 0]])
            ->Where('release_date', 'like', "%$now_year%")
            ->pluck('stock_code' )->toArray();

        //交集两年内斗分红的股票
        $intersection = array_intersect($qunian_code, $qiannian_code);
        if($type == 1 ){
            //连续分红 并去除今年已分红的股票
            $diff = array_diff($intersection, $now_year_code );
            $rel = self::where([['bonus_total_money', '>', 0]])
                ->where('release_date', 'like', "%$qunian_moon%")
                ->whereIn('stock_code', $diff)
                ->orderBy('bonus_money', 'DESC')
                ->paginate(28);
            return $rel;
        }else{
            //隔年分红
            $diff = array_diff($qiannian_code, $intersection, $now_year_code );
            $diff2 = array_diff($qunian_code, $intersection, $now_year_code );
            $diff_all = array_merge($diff,$diff2);
            $rel = self::where([['bonus_total_money', '>', 0]])
                ->whereIn('stock_code', $diff_all)
                ->where('release_date', 'like', "%$qiannian_moon%")
                ->Orwhere('release_date', 'like', "%$qunian_moon%")
                ->groupBy('stock_code')
                ->orderBy('bonus_money', 'DESC')
                ->paginate(28);

            return $rel;
        }

    }

}
