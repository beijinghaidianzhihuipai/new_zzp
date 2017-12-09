@extends('front/public/app')

@section('content')

    <div id="pdf_neirong">
        <div id="text_main" >
            <div id="divLeft" >
                <h2>最新公告</h2>
                <ul class="wei">

                        @foreach($stock_infos as $value)
                            @if(!empty($stock_infos))
                            <li class="aa" >
                                <a  onclick="show_pdf('{{$value->url}}')" target="_blank">{{$value->title}} </a>
                                <br/>  <div class="f_date"> 发布时间: &nbsp  {{$value->report_date}} </div>
                            </li>
                        @endif
                        @endforeach

                </ul>
                {!! $stock_infos->links() !!}
            </div>
            <div id="divmain" >
                @if(isset($stock_infos[0]))
                <iframe src="{{$stock_infos[0]->url}}"
                        width="100%" height="100%" frameborder="0"
                        border="0" marginwidth="0" marginheight="0" >

                </iframe>
                    @endif
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

