<html>
<head>
@section('css')
    {{ HTML::style('css/TableStyle') }}
@show
</head>
<body>
    <a href = "{{ URL::to('events/add') }}"> Add </a>
    @if (Session::has('message'))
        {{ Session::get('message') }}
    @endif
    <div id="wrapper">
        <table id="keywords" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th><span>Event Name</span></th>
                <th><span>Event Date</span></th>
                <th><span>Details</span></th>
              </tr>
            </thead>
            @foreach( $data as $data )
                <tbody>
                    <tr>
                        <td>{{ $data->event_name }}</td>
                        <td>{{ $data->event_date }}</td>
                        <td>{{ $data->event_detail }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>

@section('js')
    <script type="text/javascript" charset="utf-8">
      $(function(){
           $('#keywords').tablesorter();
         });
    </script>
@show
</body>
</html>