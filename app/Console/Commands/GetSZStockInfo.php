<?php

namespace App\Console\Commands;

use App\model\ZzpStockBasic;
use App\model\ZzpStockCode;
use App\model\ZzpStockGrow;
use Illuminate\Console\Command;

class GetSZStockInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:sz_stock_info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取深圳股票信息';

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
        $where = array('stock_type' => 2, 'is_use' => 1);
        $all_stock_code = ZzpStockCode::getStockInfo($where);

        foreach ($all_stock_code as $val){
            $stock_code = $val->stock_code;
           // $stock_code = 000018;
            $url = 'http://hq.sinajs.cn/list=sz'.$stock_code;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_AUTOREFERER,1);
            curl_setopt($ch,CURLOPT_HTTPPROXYTUNNEL,1);
            curl_setopt($ch,CURLOPT_HEADER,0);
            $result = curl_exec($ch);
            $encode = mb_detect_encoding($result, array("ASCII",'UTF-8','GB2312',"GBK",'BIG5'));
            $result = iconv( $encode, "UTF-8",$result) ;
            //print_r($result);die;
            $prg = '/\"(.+)\"/';
            preg_match($prg,$result,$rel);
            //print_r($rel);die;
            if(empty($rel)){ continue;}
            $stock_info = explode(',',$rel[1]);
            //print_r($stock_info);die;
            if($stock_info[3] == 0){continue;}
            $stock_time = strtotime($stock_info[30] . ' ' .$stock_info[31]); //年月日时分秒
            $stock_date = strtotime($stock_info[30]); //年月日
            $sel_where =array('stock_date' => $stock_date,'stock_code' => $stock_code,);
            $check_rel = ZzpStockGrow::getInfo($sel_where);
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

            $control_stock_url = "http://data.eastmoney.com/stockcomment/$stock_code.html";
            $t_ch = curl_init();
            curl_setopt($t_ch,CURLOPT_URL,$control_stock_url);
            curl_setopt($t_ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($t_ch,CURLOPT_AUTOREFERER,1);
            curl_setopt($t_ch,CURLOPT_HTTPPROXYTUNNEL,1);
            curl_setopt($t_ch,CURLOPT_HEADER,0);
            $t_result = curl_exec($t_ch);
            $encode = mb_detect_encoding($t_result, array("ASCII",'UTF-8','GB2312',"GBK",'BIG5',"EUC-CN"));
            $t_result = iconv( $encode, "UTF-8", $t_result) ;
            $control_preg = '/机构参与度为(.+?)%/';
            preg_match($control_preg, $t_result, $control_value);
            if(isset($control_value[1])){
                $brunt_control= $control_value[1];
            }else{
                $brunt_control = '';
            }

            $basic_where = array('stock_code' => $stock_code);
            $stock_basic = ZzpStockBasic::getBasicInfo($basic_where);
            $earnings_per_share = $stock_basic->earnings_per_share;
            if($earnings_per_share == 0){
                $change_ratio = 0;
            }else{
                $change_ratio = round($stock_info[3] / $earnings_per_share);
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
                'brunt_control' => $brunt_control,
                'change_ratio' =>$change_ratio
            );
            $rel = ZzpStockGrow::addGrow($addInfo);
        }

    }
}
