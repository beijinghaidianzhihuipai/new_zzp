<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $result = iconv( "GB2312//IGNORE", "UTF-8",$result) ; //print_r($result);die;
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
            if(empty($rel_href) || empty($rel_title)){ return false;}
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
            $title = $rel_title[1] . ',PDF: ' . $short;
            //发送短信
            \sendMSG::baseInfo($title,$url);
        }
    }

    
}
