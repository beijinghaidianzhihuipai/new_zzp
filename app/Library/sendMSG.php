
<?php
class sendMSG{
    static public function baseInfo($title,$url){

        $apikey = "54cae413bd079b5fc80e601f70add178"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
        $mobile_array = array(
            "18600681925",
          //  "13602069161",
          //  "13904343290",
          //  "18500329188",
          //  "13621120036"
        );

        $ch = curl_init();
        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded',
            'charset=utf-8')
        );

        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // 取得用户信息
        $json_data = self::get_user($ch,$apikey);
        //$array = json_decode($json_data,true);

        // 发送模板短信
        // 需要对value进行编码
        foreach($mobile_array as $val){
            $data=array('tpl_id'=>'1933080',
                'tpl_value' => '#title#'.'='.urlencode($title),
                'apikey' => $apikey,
                'mobile' => $val);

            $json_data = self::tpl_send($ch,$data);
            $array = json_decode($json_data,true);
            echo '<pre>';print_r($array);
        }

       die;

    }

    //获得账户
    static public function get_user($ch,$apikey){
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/user/get.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('apikey' => $apikey)));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        self::checkErr($result,$error);
        return $result;
    }

    static public function tpl_send($ch,$data){
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/tpl_single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        self::checkErr($result,$error);
        return $result;
    }

    static function checkErr($result,$error) {
        if($result === false) {
            echo 'Curl error: ' . $error;die;
        }else {
            //echo '操作完成没有任何错误';
            }
    }
}
