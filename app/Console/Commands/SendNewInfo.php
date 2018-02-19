<?php

namespace App\Console\Commands;

use App\model\ZzpStockReport;
use App\model\ZzpUser;
use Illuminate\Console\Command;


class SendNewInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '短信发送最新信息';

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
        header("Content-Type:text/html;charset=utf-8");
        $url = 'http://disclosure.szse.cn/disclosure/fulltext/plate/szlatest_24h.js';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        $header = array();
        $header[] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8';
        $header[] = 'Accept-Encoding:gzip, deflate';
        $header[] = 'Accept-Language:zh-CN,zh;q=0.8';
        $header[] = 'Cookie:JSESSIONID=BAA32CCE66BBE4B688E934EFB9CD7EA1';
        $header[] = 'Host:disclosure.szse.cn';
        $header[] = 'Upgrade-Insecure-Requests:1';

        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_AUTOREFERER,1);
        curl_setopt($ch,CURLOPT_HTTPPROXYTUNNEL,1);
        curl_setopt($ch,CURLOPT_HEADER,0);


        $result = curl_exec($ch);
        $encode = mb_detect_encoding($result, array("ASCII",'UTF-8','GB2312',"GBK",'BIG5'));
        $result = iconv( $encode, "UTF-8",$result) ;

        if(!empty($result)){
            $this->handle_data($result);
        }

    }


    function handle_data($result){

        $rel_arr = explode('],',$result);
        $val_all = array();
        if(empty($rel_arr)){ return false;}

        foreach($rel_arr as $val){
            $val_all = explode(',',$val);

            $f_title = $val_all[2];
            $preg_zhongbiao = '/中标/';
            preg_match($preg_zhongbiao , $f_title , $zhongbiao_title);
            $preg_yeji = '/业绩/';
            preg_match($preg_yeji , $f_title , $yeji_title);
            $preg_yugao = '/预告/';
            preg_match($preg_yugao , $f_title , $yugao_title);
            if(empty($zhongbiao_title) && empty($yeji_title) && empty($yugao_title) ){
                continue;
            }

            // 获取链接
            $pre_info = '/"([\s\S]+)"/';
            preg_match($pre_info,$val_all[1],$rel_href);
            if(empty($rel_href)){ return false;}
            $url = 'http://disclosure.szse.cn/'.$rel_href[1];

            //处理日期
            preg_match($pre_info,$val_all[5],$rel_date);
            if( empty($rel_date)){ return false;}
            $report_date = $rel_date[1];


            $get_url = "http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long=".$url;
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
