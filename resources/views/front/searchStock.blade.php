@extends('front/public/app')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/css/front/searchStock.css')}}" />
@section('content')
<div id="neirong">

    <div class="stock_info">
        <div class="stock_mid">
            @if(!empty($data_rel['new_info']))
                @if($data_rel['new_info']->stock_type == 1)
                    {{ $code = "sh".$data_rel['new_info']->stock_code}}
                @else
                    {{ $code = "sz".$data_rel['new_info']->stock_code}}
                @endif
            <div class="stock_img"><img src="http://image.sinajs.cn/newchart/daily/n/{{$code}}.gif"/></div>
                <div><p>公司业绩</p>
                    每股收益： {{$data_rel['base_info']->earnings_per_share}}元
                    净利润： {{$data_rel['base_info']->net_profit}}亿元
                    净利润增长率： {{$data_rel['base_info']->net_profit_grow_rate}}%
                    营业收入： {{$data_rel['base_info']->business_income}} 亿元
                    每股现金流： {{$data_rel['base_info']->cash_flow_per_share}}元
                    每股公积金： {{$data_rel['base_info']->provident_fund_per_share}}元
                    每股未分配利润： {{$data_rel['base_info']->undistributed_profit_per_share}}元
                    总股本： {{$data_rel['base_info']->total_capital_stock}}亿
                    流通股： {{$data_rel['base_info']->tradable_shares}}亿

                </div>
            <div class="comp_info">
                    <p> <span style="color:#f01b2f;font-size:20px;">
                                <strong>公司介绍</strong></span></p>
                {{$data_rel['base_info']->company_info}}

            </div>
            @else
                <div class="no_stock"><a>没有该股票无数据</a></div>
            @endif
        </div>
    </div>
</div>
@endsection

