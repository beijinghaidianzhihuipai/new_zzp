<html>
<header>
</header>
<body>
@foreach($user_data as $value)
    <li>{{$value->id}} &nbsp &nbsp &nbsp {{$value->name}} &nbsp &nbsp &nbsp {{$value->phone_num}} &nbsp &nbsp &nbsp {{$value->email}}</li>
@endforeach

</body>
</html>
