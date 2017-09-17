<html>
<header>
</header>
<body>
@foreach($stock_info as $value)
    <li><a href="{{$value->url}}">{{$value->title}} </a> &nbsp &nbsp &nbsp  {{$value->report_date}}</li>
@endforeach

</body>
</html>


.
.
