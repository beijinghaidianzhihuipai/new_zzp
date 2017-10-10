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

