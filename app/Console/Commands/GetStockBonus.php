<?php

namespace App\Console\Commands;

use App\model\ZzpStockBasic;
use App\model\ZzpStockBonus;
use App\model\ZzpStockCode;
use App\model\ZzpStockGrow;
use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\This;

class GetStockBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:stock_bonus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取股票分红信息';

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

        foreach ($all_stock_code as $stock_val){
            $stock_code = $stock_val->stock_code;
            $stock_name = $stock_val->stock_name;
            $url = "http://stockdata.stock.hexun.com/2009_fhzzgb_$stock_code.shtml";  //603102 603101
            $result = file_get_contents($url);
            $encode = mb_detect_encoding($result, array("ASCII",'UTF-8','GB2312',"GBK",'BIG5'));
            $result = iconv( $encode, "UTF-8",$result) ;

            $error_img = '/http:\/\/img.hexun.com\/error404/';
            preg_match($error_img, $result, $error_rel);
            if(!empty($error_rel)){
                continue;
            }

            $bonus_preg = '/分红转增股本<\/div>([\s\S]+?)<\/table>/';
            preg_match($bonus_preg,$result,$bonus_rel);
            if(empty($bonus_rel)){
                continue;
            }
            $rel_preg = explode('<tr>', $bonus_rel[1]);

            foreach ($rel_preg as $val){
                $shouyi = '/<td class="dotborder"><span class="font10">([\s\S]+?)<\/span><\/td>/';
                preg_match_all($shouyi,$val,$shouyi_rel);
                if(!empty($shouyi_rel[1])){
                    $only_key = MD5($stock_code.$shouyi_rel[1][0]);
                    $key_rel = ZzpStockBonus::check_key($only_key);

                    if(empty($key_rel)){
                        $basic_data = array();
                        $basic_data['stock_code'] = $stock_code;
                        $basic_data['stock_name'] = $stock_name;
                        $basic_data['release_date'] = $shouyi_rel[1][0];
                        $basic_data['bonus_money'] = $shouyi_rel[1][1];
                        $basic_data['give_stock_num'] = $shouyi_rel[1][2];
                        $basic_data['conversion_stock_num'] = $shouyi_rel[1][3];
                        $basic_data['register_date'] = $shouyi_rel[1][4];
                        $basic_data['bonus_total_money'] = $shouyi_rel[1][5];
                        $basic_data['elimination_date'] = $shouyi_rel[1][6];
                        $basic_data['only_key'] = $only_key;
                        $add_rel = ZzpStockBonus::add($basic_data);
                        if($add_rel){
                            echo $stock_code . ' 分红信息获取成功';
                            echo "\r\n";
                        }

                    }
                }
            }
        }

    }
}
