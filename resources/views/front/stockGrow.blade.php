@extends('front/public/app')

@section('content')

<div id="neirong">
<div> <a class="thress_days" onclick="check_days(3)">连续三天下跌</a>
    <a onclick="check_days(4)">连续四天下跌</a>
    <a onclick="check_days(5)">连续五天下跌</a>
    <a onclick="check_days(6)">连续六天下跌</a>
    <a onclick="check_days(7)">连续七天下跌</a>
</div>

    <div class="draw" > </div>
    <style>
        .draw{
            background: #c2c2c2;
            z-index: 2;
            position:absolute;
            right:5%;
            margin-top:5%;
            width: 550px;
            float: right;
        }
        .grow {
            cursor: pointer;
        }
    </style>
<ul class="wei"></ul>
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
                    con += '<li class="grow" onclick="drawImg(' +code+ ')">' + data[i].stock_name +
                            "(" + data[i].stock_code + ")" +
                            "下跌金额：" + data[i].grow_price + "+" +
                            "当前价格：" + data[i].end_price + "</li>";
                }
                $(".wei").html('');
                $(".wei").append(con);
            }
        });
    }

    function drawImg(codes){

        var img = '<img src="http://image.sinajs.cn/newchart/daily/n/' + codes + '.gif"  />';
        $(".draw").html('').append(img);
    }
</script>

@endsection
