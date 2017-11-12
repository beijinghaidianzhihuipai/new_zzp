@extends('front/public/app')

@section('content')





    <div id="neirong">
        <div id="text_main" >
            <div id="divLeft" >
                <h2>最新公告</h2>
                <ul class="wei">
                    @foreach($stock_infos as $value)
                        <li class="aa" >
                            <a  onclick="show_pdf('{{$value->url}}')" target="_blank">{{$value->title}} </a>
                            <br/>  <div class="f_date"> 发布时间: &nbsp  {{$value->report_date}} </div>
                        </li>
                    @endforeach
                </ul>
                {!! $stock_infos->links() !!}
            </div>
            <div id="divmain" >
                <iframe src="{{$stock_infos[0]->url}}"
                        width="100%" height="100%" frameborder="0"
                        border="0" marginwidth="0" marginheight="0" >

                </iframe>
            </div>

        </div>
</div>

    <script>
        function show_pdf(pdf){
            var pfd_info = '<iframe src="' +pdf+'"width="100%" height="100%" ' +
                    'frameborder="0"border="0" marginwidth="0" marginheight="0" > </iframe>'
            $("#divmain").html('').append(pfd_info);
        }
    </script>

@endsection

