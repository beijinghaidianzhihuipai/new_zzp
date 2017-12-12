<?php

namespace App\Console\Commands;

use App\model\ZzpStockBasic;
use App\model\ZzpStockCode;
use App\model\ZzpStockGrow;
use Illuminate\Console\Command;

class GetStockBasic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:stock_basic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取深圳股票基本面信息';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getInfo();
    }

    public function getInfo(){
        //获取上海证券code
        $where = array('is_use' => 1);
        $all_stock_code = ZzpStockCode::getStockInfo($where);

        foreach ($all_stock_code as $val){
            $stock_code = $val->stock_code;
           // $stock_code = 000018;
            $url = 'http://stockpage.10jqka.com.cn/'.$stock_code;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_AUTOREFERER,1);
            curl_setopt($ch,CURLOPT_HTTPPROXYTUNNEL,1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch,CURLOPT_HEADER,0);
            $result = curl_exec($ch);
            $encode = mb_detect_encoding($result, array("ASCII",'UTF-8','GB2312',"GBK",'BIG5'));
            $result = iconv( $encode, "UTF-8",$result) ;

            $prg = '/<dl class="company_details">([\s\S]+)?<\/dl>/';
            preg_match($prg,$result,$rel);
            if(!isset($rel[1])){
                continue;
            }

            $jianjie = '/经营分析<\/a><\/dd>[\s]+<dd title="([\s\S]+?)">/';
            preg_match($jianjie,$rel[1],$jianjie_rel);

            $shouyi = '/每股收益：<\/dt>[\s]+<dd>([\s\S]+?)元<\/dd>/';
            preg_match($shouyi,$rel[1],$shouyi_rel);

            $jlr = '/净利润：<\/dt>[\s]+<dd>([\s\S]+?)亿元<\/dd>/';
            preg_match($jlr,$rel[1],$jlr_rel);

            $jlrzz = '/净利润增长率：<\/dt>[\s]+<dd>([\s\S]+?)%<\/dd>/';
            preg_match($jlrzz,$rel[1],$jlrzz_rel);

            $yingshou = '/营业收入：<\/dt>[\s]+<dd>([\s\S]+?)亿元<\/dd>/';
            preg_match($yingshou,$rel[1],$yingshou_rel);

            $mgxjl = '/每股现金流：<\/dt>[\s]+<dd>([\s\S]+?)元<\/dd>/';
            preg_match($mgxjl,$rel[1],$mgxjl_rel);

            $mgjj = '/每股公积金：<\/dt>[\s]+<dd>([\s\S]+?)元<\/dd>/';
            preg_match($mgjj,$rel[1],$mgjj_rel);

            $wfplr = '/每股未分配利润：<\/dt>[\s]+<dd>([\s\S]+?)元<\/dd>/';
            preg_match($wfplr,$rel[1],$wfplr_rel);

            $zgb = '/总股本：<\/dt>[\s]+<dd>([\s\S]+?)亿<\/dd>/';
            preg_match($zgb,$rel[1],$zgb_rel);

            $ltg = '/流通股：<\/dt>[\s]+<dd>([\s\S]+?)亿<\/dd>/';
            preg_match($ltg,$rel[1],$ltg_rel);

            $basic_data = array();
            $basic_data['stock_code'] = $stock_code;
            $basic_data['stock_type'] = $val->stock_type;
            $basic_data['earnings_per_share'] = $shouyi_rel[1];
            $basic_data['net_profit'] = $jlr_rel[1];
            $basic_data['net_profit_grow_rate'] = $jlrzz_rel[1];
            $basic_data['business_income'] = $yingshou_rel[1];
            $basic_data['cash_flow_per_share'] = $mgxjl_rel[1];
            $basic_data['provident_fund_per_share'] = $mgjj_rel[1];
            $basic_data['undistributed_profit_per_share'] = $wfplr_rel[1];
            $basic_data['total_capital_stock'] = $zgb_rel[1];
            $basic_data['tradable_shares'] = $ltg_rel[1];
            $basic_data['company_info'] = $jianjie_rel[1];
            //print_r($basic_data);die;
            $sel_where = array('stock_code' => $stock_code);
            $check_rel = ZzpStockBasic::getBasicInfo($sel_where);
            //print_r($check_rel);die;
            if(!empty($check_rel)){
                if(($basic_data['business_income'] == $check_rel->business_income)  &&
                    ($basic_data['earnings_per_share'] == $check_rel->earnings_per_share)
                    && !empty($check_rel->company_info) ){
                    continue;
                }
                if(ZzpStockBasic::where('id',$check_rel->id)->update($basic_data)){
                    echo '股票编码'.$stock_code.'ID: '.$check_rel->id.' 更新成功'; echo "\n";
                }else{
                    echo '股票编码'.$stock_code.'ID: '.$check_rel->id.' 更新失败';die;
                }
            }else{
                if(ZzpStockBasic::add($basic_data)){
                    echo '股票编码'.$stock_code."新增信息成功"; echo "\n";
                }else{
                    echo '股票编码'.$stock_code."新增信息失败";die;
                }
            }

        }

    }
}
