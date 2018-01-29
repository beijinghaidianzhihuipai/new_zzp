<?php

namespace App\Console\Commands;

use App\model\ZzpStockReport;
use App\model\ZzpUser;
use Illuminate\Console\Command;


class SendShPDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:shpdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '上海证券最新信息';

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
        $this->mypost();
    }

    function mypost(){
        $result = file_get_contents('http://www.sse.com.cn/disclosure/listedinfo/announcement/s_docdatesort_desc_2016openpdf.htm');

        $encode = mb_detect_encoding($result, array("ASCII",'UTF-8','GB2312',"GBK",'BIG5'));
        $result = iconv( $encode, "UTF-8",$result) ;

        if(!empty($result)){
            $this->handle_data($result);
        }

    }


    function handle_data($result){

        $preg_first = '/<em data-toggle="modal"  data-target=".bs-pdf-modal-lg" class="pdf-first"  >[\s\S]+?<\/em>/';
        preg_match_all($preg_first , $result , $rel_arr);

        $val_all = array();
        if(empty($rel_arr[0])){ return false;}
        $rel_arr = $rel_arr[0];
        foreach($rel_arr as $val){

            $preg_zhongbiao = '/中标/';
            preg_match($preg_zhongbiao , $val , $zhongbiao_title);
            $preg_yeji = '/业绩/';
            preg_match($preg_yeji , $val , $yeji_title);
            $preg_yugao = '/预告/';
            preg_match($preg_yugao , $val , $yugao_title);
            if(empty($zhongbiao_title) && empty($yeji_title) && empty($yugao_title) ){
                continue;
            }

            // 获取链接
            $pre_info = '/<a  href="(.+?)"/';
            preg_match($pre_info,$val,$rel_href);
            $url = $rel_href[1];

            // 获取标题
            $pre_title = '/title="(.+?)"/';
            preg_match($pre_title,$val,$rel_title);
            $f_title = $rel_title[1];

            //处理日期
            $pre_date = '/c\/(.+?)\//';
            preg_match($pre_date,$url,$rel_date);
            if( empty($rel_date[1])){ return false;}
            $report_date = $rel_date[1];


            $get_url = "http://api.t.sina.com.cn/short_url/shorten.json?source=5786724301&url_long=".$url;
            $gch = curl_init();
            curl_setopt($gch,CURLOPT_URL,$get_url);
            curl_setopt($gch,CURLOPT_HEADER,0);
            curl_setopt($gch,CURLOPT_RETURNTRANSFER,1);
            $short_info = curl_exec($gch);
            curl_close($gch);
            if(empty($short_info)){ return false;}
            $short = json_decode($short_info)[0]->url_short;
            if(empty($short)){ return false;}

            //公告入库
            $only_key = MD5($f_title.$report_date);
            $data_rel = ZzpStockReport::check_key($only_key);
            if(!$data_rel){
                $report_data = array(
                    'title'=>$f_title,
                    'only_key'=>$only_key,
                    'short_url'=>$short,
                    'report_date'=>$report_date,
                    'url'=>$url,
                );
                $data_rel = ZzpStockReport::add($report_data);
            }
            $report_id = $data_rel->id;
          if(!$report_id){ return false;}

           // $user_info = ZzpUser::getUserMobile();

           // if(!empty($user_info)){
           //     $mobile_all = $user_info->toArray();
            }
          //  if(empty($mobile_all)){
         //       return false;
          //  }
            
            //发送短信
           // $title = $f_title . ',PDF: ' . $short;
           // \sendMSG::baseInfo($report_id,$mobile_all,$title,$url);
       // }
    }

    
}
