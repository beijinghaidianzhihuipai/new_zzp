<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

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

    public static function getBonusHerald(){
        $ch_year = date('Y', time()) - 1;
        $ch_moon = date('m', strtotime('+1 month'));
        $year_moon = $ch_year.'-'.$ch_moon;

        return self::where([['bonus_total_money', '>', 0]])
            ->where('release_date', 'like', "%$year_moon%")
            ->paginate(25);
    }

}
