@extends('front/public/app')

@section('content')
    <link href="{{URL::asset('/css/front/stockGrow.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('/css/front/stockGrowww.css')}}" rel="stylesheet" type="text/css" />
<div id="grow_neirong">

    <div id="text_main" >
        <h2>下跌反弹股票</h2>
    <div class="down_check">
        <div class="down_stock"><a  onclick="check_days(3)" > 三天连涨 </a></div>
        <div class="down_stock"><a  onclick="check_days(4)" > 四天连涨 </a></div>
        <div class="down_stock"><a  onclick="check_days(5)" > 五天连涨 </a></div>
        <div class="down_stock"><a  onclick="check_days(6)" > 六天连涨 </a></div>
        <div class="down_stock"><a  onclick="check_days(7)" > 七天连涨 </a></div>
    </div>
    <div class="draw" > </div>
    <table class="stock_data"></table>
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
    function check_days(up_days){
        $.ajax({
            type:'post',
            url:'/front/get_up_stock',
            data:{
                up_days : up_days,
            },
            cache:false,
            dataType:'json',
            success:function(data){
                var con = "<tr class='diyi'><th>股票号码</th>" +
                "<th>股票名称</th>" +
                "<th>累计上涨</th>" +
                "<th>实际价格</th>" +
                "<th>市盈率</th>" +
                "<th>每股收益</th>" +
                "<th>增长率</th>" +
                "<th>每股未分配利润</th>" +
                "</tr>"
                for(var i=0; i < data.length; i++){
                    if(data[i].stock_type == 1){
                        var code = "'sh" + data[i].stock_code + "'";
                    }else{
                        var code = "'sz" + data[i].stock_code + "'";
                    }
                    con +='<tr class="dier"> <td id="grow" onclick="drawImg(' +code+ ')">' + data[i].stock_code  + "</td>" +
                            "<td><a href='/front/search_stock/" + data[i].stock_code+ "' target='_blank'>" + data[i].stock_name + "</a></td>" +
                            '<td><img src="'+'{{URL::asset("/images/front/zhang.png")}}' +'" />' + data[i].grow_price +"元</td>"+
                            " <td> " + data[i].end_price +"元 </td>"+
                            " <td>" + data[i].shiying +"%</td>"+
                            " <td> " + data[i].earnings_per_share +"元</td>"+
                            " <td>" + data[i].net_profit_grow_rate +"%</td>"+
                            " <td>" + data[i].undistributed_profit_per_share +"元</td></tr>"
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
