<?php

namespace App\Console\Commands;

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
            //print_r($result);die;
            $prg = '/<dl class="company_details">([\s\S]+)?<\/dl>/';
            preg_match($prg,$result,$rel);

            $shouyi = '/每股收益：<\/dt>[\s]+<dd>([\s\S]+?)元<\/dd>/';
            preg_match($shouyi,$rel[1],$shouyi_rel);

            $jlr = '/净利润：<\/dt>[\s]+<dd>([\s\S]+?)亿元<\/dd>/';
            preg_match($jlr,$rel[1],$jlr_rel);

            $lrzz = '/净利润增长率：<\/dt>[\s]+<dd>([\s\S]+?)%<\/dd>/';
            preg_match($lrzz,$rel[1],$lrzz_rel);

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

            print_r($ltg_rel);die;
            if($stock_info[3] == 0){continue;}
            $stock_time = strtotime($stock_info[30] . ' ' .$stock_info[31]); //年月日时分秒
            $stock_date = strtotime($stock_info[30]); //年月日
            $sel_where =array('stock_date' => $stock_date,'stock_code' => $stock_code,);
            $check_rel = ZzpStockGrow::checkHaveInfo($sel_where);
            if(!empty($check_rel)){continue;}

           /*
            0：”大秦铁路”，股票名字； 1：”27.55″，今日开盘价； 2：”27.25″，昨日收盘价；
            3：”26.91″，当前价格；   4：”27.55″，今日最高价； 5：”26.20″，今日最低价；
           */

            $grow_price = sprintf("%.3f",$stock_info[3] - $stock_info[1]);
            if($grow_price > 0){
                $grow_type = 1;
            }elseif ($grow_price < 0){
                $grow_type = 2;
            }else{
                $grow_type = 0;
            }


            $addInfo = array(
                'stock_name' => $stock_info[0],
                'stock_code' => $stock_code,
                'max_price' => $stock_info[4],
                'min_price' => $stock_info[5],
                'start_price' => $stock_info[1],
                'end_price' => $stock_info[3],
                'grow_type' => $grow_type,
                'grow_price' => $grow_price,
                'stock_time' => $stock_time,
                'stock_date' => $stock_date,
                'stock_type' => 2,
            );
           // $rel = ZzpStockGrow::addGrow($addInfo);
        }

    }
}
