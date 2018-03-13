@extends('front/public/app')

@section('content')
    <link href="{{URL::asset('/css/front/stockGrow.css')}}" rel="stylesheet" type="text/css" />
<div id="grow_neirong">

    <div id="text_main" >
        <h2>公司分红预告</h2>
            <table class="dataintable" style="width: 1100px;">
                <tbody>
                <tr>
                    <th style="width:10%;">股票号码</th>
                    <th style="width:10%;">股票名称</th>
                    <th style="width:10%;">公告日期</th>
                    <th style="width:10%;">分红(每股)</th>
                    <th style="width:10%;">送股(每股)</th>
                    <th style="width:10%;">转股(每股)</th>
                    <th style="width:15%;">登记日</th>
                    <th style="width:10%;">派现额度</th>
                    <th style="width:15%;">除权日</th>
                </tr>

                @foreach($stock_bonus_info as $value)
                    @if(!empty($stock_bonus_info))
                        <tr>
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

                        </tr>
                    @endif
                @endforeach
                </tbody></table>

        {!! $stock_bonus_info->links() !!}
    </div>
</div>




@endsection
