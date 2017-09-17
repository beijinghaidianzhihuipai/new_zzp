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
<div id="neirong">
    <div class="xinxi white">
        <a href="###>">首页</a>|
        <a href="###>">新闻资讯</a>|
        <a href="/front/proclamation">最新公告</a>|
        <a href="###>">软件介绍</a>|
        <a href="###>">优股推荐</a>|
        <a href="###>">关于我们</a>
    </div>



    <div id="jzProContainer" class="hideBody">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide " id="swiperPage1">
                    <div class="page page1 ">
                        <div class="fkHeader">
                            <div class="headerMid">
                                <div class="faisco_logo"></div><div class="logo_tx"></div><div class="clearfloat"></div>
                            </div>
                        </div>
                        <div class="pageContent">
                            <div class="ani pageContent_1" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                <div class="page1_headline">3000套模板永久免费</div>
                                <div class="page1_subtitle_bg"></div>
                                <div class="btn_reg btn_1" onClick="jumpToReg();">免费注册</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide " id="swiperPage2">
                    <div class="page page2">
                        <div class="pageContent">
                            <div class="ani containerTxt" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                <div class="page_headline">一套模板 = 三个网站</div>
                                <div class="page_subtitle">电脑网站+手机网站+微网站</div>
                            </div>

                            <div class="Mac_phone">
                                <div class="macBg">
                                    <div class="content_pc scrollBox"><div class="content_pcBg scrollImg" for="Mac"></div></div>
                                </div>
                                <div class="phoneBg">
                                    <div class="content_phone scrollBox"><div class="content_phoneBg scrollImg" for="Phone"></div></div>
                                </div>
                                <div class="wxBg"></div>
                            </div>

                            <div class="ani btn_reg btn2" onClick="jumpToReg();" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.7s">免费注册</div>
                        </div>
                    </div>
                </div>


                <div class="swiper-slide " id="swiperPage3">
                    <div class="page page3">
                        <div class="pageContent">

                            <div class="ani containerTxt" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                <div class="stepJZ" style="display: inline-block;"></div>
                                <div style="display: inline-block;">
                                    <div class="page_headline">企业官网模板</div>
                                    <div class="page_subtitle">高端大气的企业门面</div>
                                </div>
                            </div>

                            <div class="fkjzCase">
                                <div class="knowMore" onClick="jumpToReg();">了解更多</div>
                                <div class='fk_caseItem' style='background-image:url(images/monitors_1_1.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_1_2.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_1_3.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_1_4.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_1_5.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_1_6.png)' ></div>
                            </div>
                            <div class="ani btn_regCase btn_reg btn3" onClick="jumpToReg();" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.7s">免费下载</div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide " id="swiperPage4">
                    <div class="page page4">
                        <div class="pageContent">

                            <div class="ani containerTxt" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                <div class="stepJZ" style="display: inline-block;"></div>
                                <div style="display: inline-block;">
                                    <div class="page_headline">营销型网站模板</div>
                                    <div class="page_subtitle">轻松获取更多订单</div>
                                </div>
                            </div>

                            <div class="fkjzCase">
                                <div class="knowMore" onClick="jumpToReg();">了解更多</div>
                                <div class='fk_caseItem' style='background-image: url(images/monitors_2_1.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_2_2.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_2_3.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_2_4.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_2_5.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_2_6.png)' ></div>
                            </div>
                            <div class="ani btn_regCase btn_reg btn4" onClick="jumpToReg();" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.7s">免费下载</div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide " id="swiperPage5">
                    <div class="page page5">
                        <div class="pageContent">

                            <div class="ani containerTxt" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                <div class="stepJZ" style="display: inline-block;"></div>
                                <div style="display: inline-block;">
                                    <div class="page_headline">在线商城模板</div>
                                    <div class="page_subtitle">在线交易一站式全搞定</div>
                                </div>
                            </div>

                            <div class="fkjzCase">
                                <div class="knowMore" onClick="jumpToReg();">了解更多</div>
                                <div class='fk_caseItem' style='background-image: url(images/monitors_3_1.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_3_2.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_3_3.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_3_4.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_3_5.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_3_6.png)' ></div>
                            </div>
                            <div class="ani btn_regCase btn_reg btn5" onClick="jumpToReg();" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.7s">免费下载</div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide " id="swiperPage6">
                    <div class="page page6">
                        <div class="pageContent">

                            <div class="ani containerTxt" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                <div class="stepJZ" style="display: inline-block;"></div>
                                <div style="display: inline-block;">
                                    <div class="page_headline">通用型网站模板</div>
                                    <div class="page_subtitle">只为找到适合你的那一款</div>
                                </div>
                            </div>

                            <div class="fkjzCase">
                                <div class="knowMore" onClick="jumpToReg();">了解更多</div>
                                <div class='fk_caseItem' style='background-image: url(images/monitors_4_1.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_4_2.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_4_3.png)' ></div><div class='fk_caseItem' style='background-image: url(images/monitors_4_4.png)' ></div><div class='fk_caseItem fk_caseItem_mid' style='background-image: url(images/monitors_4_5.png)' ></div><div class='fk_caseItem' style='background-image:url(images/monitors_4_6.png)' ></div>
                            </div>
                            <div class="ani btn_regCase btn_reg btn6" onClick="jumpToReg();" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.7s">更多免费模板</div>
                        </div>
                    </div>
                </div>


                <div class="swiper-slide " id="swiperPage7">
                    <div class="page page7" id="page7">
                        <div class="pageContent" id="pageContent7">
                            <div class="ani headline7" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">一键获取属于您的网站</div>
                            <font class="comedownTime_jz day7">
                                <div class="limitTip">限时免费</div>
                                <span class="timeEle RemainH_decade" _timeEle="0"></span>
                                <span class="timeEle RemainH_unit" _timeEle="0"></span>
                                <div class="timeEle timeInt"></div>
                                <span class="timeEle RemainM_decade" _timeEle="0"></span>
                                <span class="timeEle RemainM_unit" _timeEle="0"></span>
                                <div class="timeEle timeInt"></div>
                                <span class="timeEle RemainS_decade" _timeEle="0"></span>
                                <span class="timeEle RemainS_unit" _timeEle="0"></span>				    		</font>
                            <div class="faiscoStep">
                                <ul class="stepUl">
                                    <li class="stepLi">
                                        <div class="icon_Li icon_account"></div>
                                        <div class="content_li">
                                            <div class="headline_big">注册账号</div>
                                            <div class="headline_small">10秒注册，即拥有免费域名，<br>免费空间，免费网站</div>
                                        </div>
                                    </li>
                                    <li class="stepLi stepLiMid">
                                        <div class="icon_Li_arrow icon_Li_arrow_left"></div>
                                        <div class="icon_Li_arrow icon_Li_arrow_right"></div>

                                        <div class="icon_Li icon_document"></div>
                                        <div class="content_li">
                                            <div class="headline_big">选择模板</div>
                                            <div class="headline_small">全行业覆盖，3000套成品<br>模板，一站式免费</div>
                                        </div>
                                    </li>
                                    <li class="stepLi">
                                        <div class="icon_Li icon_pc"></div>
                                        <div class="content_li">
                                            <div class="headline_big">生成网站</div>
                                            <div class="headline_small">自由拖拽功能模板，随时修<br>改网站内容</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn_reg btn7 ani" onClick="jumpToReg();" swiper-animate-effect="fadeInUp " swiper-animate-duration="0.6s" swiper-animate-delay="1s">免费获取</div>
                        </div>

                        <div class="footer">
                            <div style="position: relative;">
                                <span>Copyright ? 2010-2017 广州凡科互联网科技股份有限公司   <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow" style="color:rgb(149,177,222);">粤ICP备10235580号</a>  股票代码：832828</span>
                                <a target="_blank" style="position:relative;top:0;" href="###">
                                    <span class="anbeiIcon"></span>
                                    <span style="color:rgb(149,177,222);">粤公网安备 44010502000281号</span>	            				</a>
                                <a  class="wangxinImg" target="_blank" href="http://www.itrust.org.cn/Home/Index/itrust_certifi?wm=1639937559"></a>	            			</div>
                            <div class="dropDown">
                                <div class="icon_Down" onClick="showBlog();"></div>

                                <div class="icon_Up" onClick="closeBlog();"></div>


                                <div class="item item_border_top">
                                    <div class="item_tip"> <a href="###">如何设计英文网站的文本输入框</a></div>
                                    <div class="middle"></div>
                                    <div class="item_tip"><a href="###">模板网站怎么设计出浪漫的地中海风格</a></div>
                                </div>


                                <div class="item item_border_bottom">
                                    <div class="item_tip" ><a href="###">网站设计中选择插画有哪些好处</a></div>
                                    <div class="middle"></div>
                                    <div class="item_tip" ><a href="###">如何在创建网站调整设计的平衡感</a></div>
                                </div>

                                <div class="item item_border_bottom">
                                    <div class="item_tip" ><a href="###">网站制作中要重视简洁清晰的设计</a></div>
                                    <div class="middle"></div>
                                    <div class="item_tip" ><a href="###">网站制作过程中用户体验有哪些要求</a></div>
                                </div>

                                <div class="item item_border_bottom">
                                    <div class="item_tip" ><a href="###">网站设计采用图片作为背景提升视觉感</a></div>
                                    <div class="middle"></div>
                                    <div class="item_tip" ><a href="###">手机网站首页制作的要点</a></div>
                                </div>

                                <div class="item item_border_bottom">
                                    <div class="item_tip" ><a href="####">2017网站设计流行的大趋势</a></div>
                                    <div class="middle"></div>
                                    <div class="item_tip" ><a href="###">手机网站制作的5个基础知识点</a></div>
                                </div>

                                <div class="readMore"><a href="##">查看更多>></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

</div>


<div id="footer">底部</div>
</body>
</html>
