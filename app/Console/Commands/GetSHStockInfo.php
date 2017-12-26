<?php

namespace App\Console\Commands;

use App\model\ZzpStockCode;
use App\model\ZzpStockGrow;
use Illuminate\Console\Command;

class GetSHStockInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:sh_stock_info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取上海股票信息';

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
        $where = array('stock_type' => 1, 'is_use' => 1);
        $all_stock_code = ZzpStockCode::getStockInfo($where);

        foreach ($all_stock_code as $val){
            $stock_code = $val->stock_code;
           // $stock_code = 600349;
            $url = 'http://hq.sinajs.cn/list=sh'.$stock_code;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
           // curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
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
                'stock_type' => 1,
            );
            $rel = ZzpStockGrow::addGrow($addInfo);

        }

    }
}
