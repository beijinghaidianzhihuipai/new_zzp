@extends('front.public.app')

@section('content')
    <link href="{{URL::asset('/css/front/stockbannes.css')}}" rel="stylesheet" type="text/css" />
<div id="grow_neirong">

    <div id="text_main" >
        <h2><a class="linian"> {{$stock_bonus_info['stock_name']}} ({{$stock_bonus_info['stock_code']}}) </a> 历年分红信息</h2>
        <br/>
            <table class="dataintable" >
                <tbody>
                <tr class="diyi">
                    <th style="width:10%;">股票号码</th>
                    <th style="width:10%;">股票名称</th>
                    <th style="width:10%;">公告日期</th>
                    <th style="width:10%;">分红(每股)</th>
                    <th style="width:10%;">送股(每股)</th>
                    <th style="width:10%;">转股(每股)</th>
                    <th style="width:15%;">登记日</th>
                    <th style="width:10%;">派现额度</th>
                    <th style="width:10%;">除权日</th>
                </tr>

                @foreach($stock_bonus_info['stock_data'] as $value)
                    @if(!empty($stock_bonus_info['stock_data']))
                        <tr class="dier">
                            <td>{{$value->stock_code}}</td>
                            <td>{{$value->stock_name}}</td>
                            <td>{{$value->release_date}}</td>
                            <td>{{$value->bonus_money}}</td>
                            <td>{{$value->give_stock_num}}</td>
                            <td>{{$value->conversion_stock_num}}</td>
                            <td>{{$value->register_date}}</td>
                            <td>{{$value->bonus_total_money}}</td>
                            <td>{{$value->elimination_date}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody></table>

        {!! $stock_bonus_info['stock_data']->links() !!}
    </div>
</div>




@endsection
