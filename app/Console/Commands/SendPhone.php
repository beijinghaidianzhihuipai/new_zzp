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
        $this->handle_data($result);
    }

    function handle_data($result){
        $result = iconv( "GB2312//IGNORE", "UTF-8",$result) ; //print_r($result);die;
        $pre = '/<td align="left">([\s\S]+)<\/tbody><\/table><\/td><\/tr>/';
        preg_match($pre,$result,$res);

        $rel_arr = explode('</tr>',$res[1]);
        array_pop($rel_arr);

        foreach($rel_arr as $val){
            $pre_href = "/<a href='([\s\S]+)PDF'/";
            preg_match($pre_href,$val,$rel_href);
            $rel_href = $rel_href[1].'PDF';

            $pre_title = '/target="new">([\s\S]+)<\/a>/';
            preg_match($pre_title,$val,$rel_title);

            //发送短信
            $title = $rel_title[1];
            $url = 'http://disclosure.szse.cn/'.$rel_href;
            \sendMSG::baseInfo($title,$url);
        }
    }
    
    
    
    
}
