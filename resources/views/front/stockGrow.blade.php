@extends('front/public/app')

@section('content')
    <link href="{{URL::asset('/css/front/stockGrow.css')}}" rel="stylesheet" type="text/css" />
<div id="grow_neirong">

    <div id="text_main" >
        <h2>连续下跌股票</h2>
    <div class="down_check">
        <div class="down_stock"><a  onclick="check_days(3)" > 连续三天下跌 </a></div>
        <div class="down_stock"><a  onclick="check_days(4)" > 连续四天下跌 </a></div>
        <div class="down_stock"><a  onclick="check_days(5)" > 连续五天下跌 </a></div>
        <div class="down_stock"><a  onclick="check_days(6)" > 连续六天下跌 </a></div>
        <div class="down_stock"><a  onclick="check_days(7)" > 连续七天下跌 </a></div>
    </div>
    <div class="draw" > </div>
    <ul class="stock_data"></ul>
    </div>
</div>


    <div id="f_main" class="none">
        <div id="f_title">
            <div id="f_ten"></div>
            <div id="f_img" title="close"></div>
        </div>
        <div id="f_content">
        </div>
    </div>


    <style>
        #f_main{position: absolute; top: 30%;right: 10%;}
        #f_title{width: 500px;height: 20px;border-top: #85ABE4 1px solid;
            border-right: #222 1px solid;border-left: #85ABE4 1px solid;
            border-bottom: none;background: #5B8BD9;}
        #f_content{border: #85ABE4 1px solid;border-top: none;
            background:#fff; width: 500px;height: 300px;}
        #f_content img{width: 500px;height: 300px;}
        .none{display: none;}
        .show{display: block;}
        #f_ten{float: left;width: 440px;height:20px;}
        #f_img{background: url({{URL::asset('/images/front/s.jpg')}}) no-repeat;float: right;
            width: 60px;
            height: 20px;
        }
        #f_img:hover{background: url({{URL::asset('/images/front/sh.jpg')}}) no-repeat;
            float: right;
            cursor:pointer;
            width: 60px;
            height: 20px;}

    </style>

    <script type="text/javascript">
        $(document).ready(function(){

            //窗口的关闭
            $("#f_img").click(function() {
                $("#f_main").removeClass("show");
                $("#f_main").addClass("none");
                 });

             //窗口的拖动
            var bool=false;
            var offsetX=0;
            var offsetY=0;
            $("#f_ten").mousedown(function(){
                bool=true;
                offsetX = event.offsetX;
                offsetY = event.offsetY;
                $("#f_main").css('cursor','move');
            })

            $("#f_main").mouseup(function(){
                        bool=false;
                    })
            $(document).mousemove(function(e){
                if(!bool)
                    return;
                var x = event.clientX-offsetX;
                var y = event.clientY-offsetY;
                $("#f_main").css("left", x);
                $("#f_main").css("top", y);
            })

        });
    </script>

<script>
    //页面加载完后执行
    $(function(){
        check_days(3);
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
                    if(data[i].stock_type == 1){
                        var code = "'sh" + data[i].stock_code + "'";
                    }else{
                        var code = "'sz" + data[i].stock_code + "'";
                    }
                    con += '<li id="grow" onclick="drawImg(' +code+ ')"><a>' + data[i].stock_name +
                            "(" + data[i].stock_code + ")" +
                            '&nbsp;&nbsp;&nbsp;<img src="'+'{{URL::asset("/images/front/xia.png")}}' +'" />：' + data[i].grow_price +"元"+
                            "&nbsp; &nbsp;&nbsp; 价格：" + data[i].end_price +"元"+
                            "&nbsp;&nbsp;&nbsp;市盈率：" + data[i].shiying +"%"+
                            "&nbsp; &nbsp;&nbsp; 每股收益：" + data[i].earnings_per_share +"元"+
                            "&nbsp; &nbsp;&nbsp; 增长率：" + data[i].net_profit_grow_rate +"%"+
                            "&nbsp; &nbsp;&nbsp; 每股未分配利润：" + data[i].undistributed_profit_per_share +"元"+
                            "</a></li>";
                }
                $(".stock_data").html('');
                $(".stock_data").append(con);
            }
        });
    }

    function drawImg(codes){
        $("#f_main").removeClass("none");
        $("#f_main").addClass("show");
        var img = '<img src="http://image.sinajs.cn/newchart/daily/n/' + codes + '.gif"  />';
        $("#f_content").html('').append(img);
    }
</script>
@endsection
