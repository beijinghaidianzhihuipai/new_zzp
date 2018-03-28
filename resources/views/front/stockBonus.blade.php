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
                <a href="/front/bonus_herald/2?month={{$key}}">{{$value}}</a>
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
                        <tr class="dier">
                            <td>
                                <a href="/front/search_stock/{{$value->stock_code}}" target="_blank">
                                    {{$value->stock_code}}
                                </a>
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




@endsection
