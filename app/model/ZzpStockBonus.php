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
        $ch_year = $now_year - 1;
        $q_year = $now_year - 2;
        $year_moon = $ch_year.'-'.$search_month;
        $q_year_moon = $q_year.'-'.$search_month;

        $year_code = self::where([['bonus_total_money', '>', 0]])
            ->where('release_date', 'like', "%$year_moon%")
            ->pluck('stock_code' )->toArray();

        $q_year_code = self::where([['bonus_total_money', '>', 0]])
             ->Where('release_date', 'like', "%$q_year_moon%")
            ->pluck('stock_code' )->toArray();

        $now_year_code = self::where([['bonus_total_money', '>', 0]])
            ->Where('release_date', 'like', "%$now_year%")
            ->pluck('stock_code' )->toArray();

        //交集
        $intersection = array_intersect($year_code, $q_year_code);
        if($type == 1 ){
            //连续分红
            $diff = array_diff($intersection, $now_year_code );
            return self::where([['bonus_total_money', '>', 0]])
                ->where('release_date', 'like', "%$year_moon%")
                ->whereIn('stock_code', $diff)
                ->orderBy('bonus_money', 'DESC')
                ->paginate(25);
        }else{
            //隔年分红
            $diff = array_diff($q_year_code, $intersection, $now_year_code );
            return self::where([['bonus_total_money', '>', 0]])
                ->where('release_date', 'like', "%$q_year_moon%")
                ->whereIn('stock_code', $diff)
                ->orderBy('bonus_money', 'DESC')
                ->paginate(25);
        }

    }

}
