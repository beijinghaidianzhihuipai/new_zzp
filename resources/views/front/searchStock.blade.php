@extends('front/public/app')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/css/front/searchStock.css')}}" />
<link href="{{URL::asset('/css/front/stockbannes.css')}}" rel="stylesheet" type="text/css" />
@section('content')
<div id="neirong">
    <div class="stock_mid">
        <div class="achievement">
            <h3 style="color:#f01b2f;font-size:20px;">
                {{$data_rel['new_info']->stock_name}}
                ({{$data_rel['base_info']->stock_code}})
            </h3>
            <table>
                <tr>
                    <td>每股收益： {{$data_rel['base_info']->earnings_per_share}}元</td>
                    <td>净利润： {{$data_rel['base_info']->net_profit}}亿元</td>
                </tr>
                <tr>
                    <td>净利润增长率： {{$data_rel['base_info']->net_profit_grow_rate}}%</td>
                    <td>营业收入： {{$data_rel['base_info']->business_income}} 亿元</td>
                </tr>
                <tr>
                    <td>每股现金流： {{$data_rel['base_info']->cash_flow_per_share}}元</td>
                    <td>每股公积金： {{$data_rel['base_info']->provident_fund_per_share}}元</td>
                </tr>
                <tr>
                    <td>每股未分配利润： {{$data_rel['base_info']->undistributed_profit_per_share}}元</td>
                    <td>总股本： {{$data_rel['base_info']->total_capital_stock}}亿</td>
                </tr>
                <tr>
                    <td>流通股： {{$data_rel['base_info']->tradable_shares}}亿</td>
                </tr>

            </table>

        </div>
        <div class="comp_info">
            公司介绍：{{trim($data_rel['base_info']->company_info, '　　')}}
        </div>
    </div>
    @if(!empty($data_rel['new_info']))
        @if($data_rel['new_info']->stock_type == 1)
            {{!$code = "sh".$data_rel['new_info']->stock_code}}
        @else
            {{!$code = "sz".$data_rel['new_info']->stock_code}}
        @endif
    <div class="stock_img"><img src="http://image.sinajs.cn/newchart/daily/n/{{$code}}.gif"/></div>

            <div id="text_main" >
                <h2><a class="linian">  </a> 历年分红信息</h2>
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
                    @if(!empty($data_rel['bonus_rel']))
                    @foreach($data_rel['bonus_rel'] as $value)
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
                    @endforeach
                    @endif
                    </tbody></table>


            </div>
    @else
        <div class="no_stock"><a>没有该股票无数据</a></div>
    @endif


</div>
@endsection

