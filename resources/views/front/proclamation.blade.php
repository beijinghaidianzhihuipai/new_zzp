@extends('front/public/app')

@section('content')
<div id="neirong">
<ul class="wei">
@foreach($stock_infos as $value)
    <li class="aa"><a href="{{$value->url}}" target="_blank">{{$value->title}} </a> &nbsp &nbsp &nbsp  {{$value->report_date}}</li>
@endforeach
</ul>
{!! $stock_infos->links() !!}
</div>
@endsection

