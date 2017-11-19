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
                    con += '<li class="grow" onclick="drawImg(' +code+ ')"><a>' + data[i].stock_name +
                            "(" + data[i].stock_code + ")" +
                            "&nbsp;&nbsp;&nbsp;下跌金额：" + data[i].grow_price +
                            "&nbsp; &nbsp;&nbsp; 当前价格：" + data[i].end_price + "</a></li>";
                }
                $(".stock_data").html('');
                $(".stock_data").append(con);
            }
        });
    }

    function drawImg(codes){

        var img = '<img src="http://image.sinajs.cn/newchart/daily/n/' + codes + '.gif"  />';
        $(".draw").html('').append(img);
    }
</script>
@endsection
