<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>智者派官方网站</title>
    <link href="{{URL::asset('/css/front/index.css') }}" rel="stylesheet" type="text/css"  />
    <link href="{{URL::asset('/css/front/mainCss.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- baidu stat -->
    <!--内容代码 -->
    <link href="{{URL::asset('/css/front/mainCss.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/front/swiper.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/front/animation.min.css')}}" />
    <script type="text/javascript" src="{{URL::asset('/js/front/jquery-core.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/front/jquery-ui-core.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/front/swiperAnimate.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/front/fai.min.js')}}"></script>
    <!--内容代码-->
    <style>
        ul.wei{height: 170px; width: 650px;border: 1px solid black;    margin: 0 auto; margin-top: 10px;}
        ul.wei li{  list-style-type:none; height:35px; width: 550px; }
        ul.wei  li a{text-decoration:none; line-height:25px; }
    </style>
    <style>
        ul.pagination {height:30px;width:210px;border: 1px solid black;  margin: 0 auto; margin-top: 10px;}
        ul.pagination li{float: left;margin-right: 10px; margin-left: 10px;  }
        ul.pagination li a{}
    </style>
</head>
<body>
<div id="tou">

    <div class="logo">logo</div>
    <div class="denglu">
        @if( Session::has('user_name') )
            <a href="###"> {{ Session::get('user_name') }}</a>
            <a href="/front/login_out">退出</a>
        @else
            <a href="/front/login">登录 </a><a href="/front/register">注册</a>
        @endif
    </div>
</div>
<div id="neirong">
    <div class="xinxi white">
        <a href="###>">首页</a>|
        <a href="###>">新闻资讯</a>|
        <a href="/front/proclamation">最新公告</a>|
        <a href="###">软件介绍</a>|
        <a href="/front/stock_grow">优股推荐</a>|
        <a href="###">关于我们</a>
    </div>

<div> <a class="thress_days" onclick="check_days(2)">连续三天下跌</a>
    <a>连续四天下跌</a>
    <a>连续五天下跌</a>
</div>

<ul class="wei">

</ul>

</body>
</html>
<script>

    //页面加载完后执行
    $(function(){
        check_days(2);
    }) ;

    //调用下跌数据
    function check_days(down_days){
        $.ajax({
            type:'post',
            url:'/front/down/stock_grow',
            data:{
                down_days : down_days,
            },
            cache:false,
            dataType:'json',
            success:function(data){
                var con = '';
                for(var i=0; i < data.length; i++){
                    con += "<li>" + data[i].stock_name +
                            "(" + data[i].stock_code + ")" +
                            "下跌金额：" + data[i].grow_price + "</li>";
                }
                $(".wei").html('');
                $(".wei").append(con);
            }
        });
    }
</script>

