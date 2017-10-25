@include('front/public/header')
<div id="neirong">
    <div class="xinxi white">
        <a href="###>">首页</a>|
        <a href="/front/proclamation">最新公告</a>|
        <a href="/front/stock_grow">优股推荐</a>|
    </div>


<ul class="wei">
@foreach($stock_infos as $value)
    <li class="aa"><a href="{{$value->url}}">{{$value->title}} </a> &nbsp &nbsp &nbsp  {{$value->report_date}}</li>
@endforeach
</ul>
{!! $stock_infos->links() !!}
@include('front/public/footer')

