@extends('front/public/app')

@section('content')
    <link href="{{URL::asset('/css/front/stockbannes.css')}}" rel="stylesheet" type="text/css" />
<div id="grow_neirong">

    <div id="text_main" >
        <h2>
            <a href="/front/bonus_herald/1">连续分红股票预告</a> |
            <a href="/front/bonus_herald/2">隔年分红股票预告</a>
        </h2>
        <div>
            @foreach($rel_data['month'] as $key => $value)
                <a href="/front/bonus_herald/{{$rel_data['type']}}?month={{$key}}">{{$value}}</a>
            @endforeach
        </div>
            <table class="dataintable" >
                <tbody>
                <tr class="diyi">
                    <th style="width:80px;">股票号码</th>
                    <th style="width:80px;">股票名称</th>
                    <th style="width:80px;">公告日期</th>
                    <th style="width:80px;;">分红(每股)</th>
                    <th style="width:80px;;">送股(每股)</th>
                    <th style="width:80px;;">转股(每股)</th>
                    <th style="width:80px;;">登记日</th>
                    <th style="width:80px;">派现额度</th>
                    <th style="width:80px;;">除权日</th>
                </tr>
                @if(!empty($rel_data['stock_bonus_info']))
                @foreach($rel_data['stock_bonus_info'] as $value)

                    @if($value->stock_code >= 600000)
                        {{!$new_stock_code = "sh".$value->stock_code}}
                    @else
                        {{!$new_stock_code = "sz".$value->stock_code}}
                    @endif
                        <tr class="dier">
                            <td onclick="drawImg('{{$new_stock_code}}')">
                                {{$value->stock_code}}
                            </td>
                            <td><a href="/front/search_stock/{{$value->stock_code}}" target="_blank">
                                {{$value->stock_name}}
                                </a>
                            </td>
                            <td>{{$value->release_date}}</td>
                            <td>{{$value->bonus_money}}</td>
                            <td>{{$value->give_stock_num}}</td>
                            <td>{{$value->conversion_stock_num}}</td>
                            <td>{{$value->register_date}}</td>
                            <td>{{$value->bonus_total_money}}</td>
                            <td>{{$value->elimination_date}}</td>
                        </tr>
                @endforeach
                @endif
                </tbody>
            </table>

        {!! $rel_data['stock_bonus_info']->links() !!}
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

        function drawImg(codes){
        $("#f_main").removeClass("none");
        $("#f_main").addClass("show");
        var img = '<img src="http://image.sinajs.cn/newchart/daily/n/' + codes + '.gif"  />';
        $("#f_content").html('').append(img);
        }
    </script>


@endsection
