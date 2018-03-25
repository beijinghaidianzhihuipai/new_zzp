@extends('front/public/app')

@section('content')
    <link href="{{URL::asset('/css/front/stockbannes.css')}}" rel="stylesheet" type="text/css" />
<div id="grow_neirong">

    <div id="text_main" >
        <h2>
            <a href="/front/bonus_herald/1">连续分红股票预告</a> |
            <a href="/front/bonus_herald/2">隔年分红股票预告</a>
        </h2>

            <table class="dataintable" >
                <tbody>
                <tr class="diyi">
                    <th style="width:100px;">股票号码</th>
                    <th style="width:100px;">股票名称</th>
                    <th style="width:100px;">公告日期</th>
                    <th style="width:100px;;">分红(每股)</th>
                    <th style="width:100px;;">送股(每股)</th>
                    <th style="width:100px;;">转股(每股)</th>
                    <th style="width:100px;;">登记日</th>
                    <th style="width:100px;">派现额度</th>
                    <th style="width:100px;;">除权日</th>
                    <th style="width:100px;">历年分红</th>
                </tr>

                @foreach($stock_bonus_info as $value)
                    @if(!empty($stock_bonus_info))
                        <tr class="dier">
                            <td>
                                <a href="/front/search_stock/{{$value->stock_code}}" target="_blank"> {{$value->stock_code}} </a>
                            </td>
                            <td>{{$value->stock_name}}</td>
                            <td>{{$value->release_date}}</td>
                            <td>{{$value->bonus_money}}</td>
                            <td>{{$value->give_stock_num}}</td>
                            <td>{{$value->conversion_stock_num}}</td>
                            <td>{{$value->register_date}}</td>
                            <td>{{$value->bonus_total_money}}</td>
                            <td>{{$value->elimination_date}}</td>
                            <td><a href="/front/search_stock/{{$value->stock_code}}" target="_blank">查阅</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        {!! $stock_bonus_info->links() !!}
    </div>
</div>




@endsection
