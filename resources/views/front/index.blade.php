<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>智者派官方网站</title>
    <link href="{{URL::asset('/css/front/index.css') }}" rel="stylesheet" type="text/css"  />
    <link href="{{URL::asset('/css/front/mainCss.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- baidu stat -->



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
        <a href="###>">软件介绍</a>|
        <a href="###>">优股推荐</a>|
        <a href="###>">关于我们</a>



    </div>

</div>
<div id="footer">底部</div>
</body>
</html>
