<?php

namespace App\Console\Commands;

use App\model\ZzpStockReport;
use App\model\ZzpUserPhoneMsg;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class SendPhone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:phone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '短信发送公告';

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

        $url = 'http://disclosure.szse.cn/m/search0425.jsp';
        $data = array(
            'leftid' => 1,
            'lmid' => 'drgg',
            'pageNo' => 1,
            'stockCode' => '000018',
            'keyword' => '',
            'noticeType' => '',
            'startTime' => '2017-08-24',
            'endTime' => '2017-08-26',
            'imageField.x' => 40,
            'imageField.y' => 14,
            'tzy' => ''
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
        if (!empty($data)) {
            if (is_array($data)) {
                $data = http_build_query($data);
            }
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            $header['Content-type:'] = 'application/x-www-form-urlencoded';
        }
        if (!empty($header)) {
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER,false);
        $result = curl_exec($ch);
        curl_close($ch);
        if(!empty($result)){
            $this->handle_data($result);
        }

    }

    function handle_data($result){
        $result = iconv( "GB2312//IGNORE", "UTF-8",$result) ;
        $pre = '/<td align="left">([\s\S]+)<\/tbody><\/table><\/td><\/tr>/';
        preg_match($pre,$result,$res);

        $rel_arr = explode('</tr>',$res[1]);
        array_pop($rel_arr);
        if(empty($rel_arr)){ return false;}
        foreach($rel_arr as $val){
            $pre_href = "/<a href='([\s\S]+)PDF'/";
            preg_match($pre_href,$val,$rel_href);
            if(empty($rel_href)){ return false;}
            $rel_href = $rel_href[1].'PDF';
            //处理匹配标题
            $pre_title = '/target="new">([\s\S]+)<\/a>/';
            preg_match($pre_title,$val,$rel_title);
            if( empty($rel_title)){ return false;}

            //处理日期
            $pre_date = "/class=\'link1\'>\[([\s\S]+)\]<\/span>/";
            preg_match($pre_date,$val,$rel_date);
            if( empty($rel_date)){ return false;}
            $report_date = $rel_date[1];

            //转换短连接
            $url = 'http://disclosure.szse.cn/'.$rel_href;
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
            $only_key = MD5($rel_title[1].$report_date);
            $data_rel = ZzpStockReport::check_key($only_key);
            if(!$data_rel){
                $report_data = array(
                    'title'=>$rel_title[1],
                    'only_key'=>$only_key,
                    'short_url'=>$short,
                    'report_date'=>$report_date,
                    'url'=>$url,
                );
                $data_rel = ZzpStockReport::add($report_data);
            }
            $report_id = $data_rel->id;
          if(!$report_id){ return false;}
            $mobile_array = array(
                "18600681925",
                //  "13602069161",
                //  "13904343290",
                //  "18500329188",
                //  "13621120036"
            );
            
            
            //发送短信
            $title = $rel_title[1] . ',PDF: ' . $short;
            \sendMSG::baseInfo($report_id,$mobile_array,$title,$url);
        }
    }

    
}
