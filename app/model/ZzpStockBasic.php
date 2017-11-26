<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpStockBasic extends Model
{
    protected $table = 'stock_basic';
    protected $dateFormat = 'U';
    protected $fillable = [
        'stock_code',
        'earnings_per_share',
        'net_profit',
        'net_profit_grow_rate',
        'business_income',
        'cash_flow_per_share',
        'provident_fund_per_share',
        'undistributed_profit_per_share',
        'total_capital_stock',
        'tradable_shares',
        'updated_at',
        'created_at',
      ];

    public static function add($report_data){
        return $rel = self::create($report_data);
    }

    public static function getBasicInfo($where){
        return self::where($where)->first();
    }

    public static function updateData($upWhere){
        return self::where('stock_code',$upWhere['stock_code'])
            ->update(array('stock_name' => $upWhere['stock_name']));
    }

}
