<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Event System</title>
@section('css')
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/FormStyle.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Engagement') }}
@show
</head>
<body>
@yield('contents')
@section('js')
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::script('js/jquery.uniform.min.js') }}
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js') }}
    <script type="text/javascript" charset="utf-8">
      $(function(){
        $("input:checkbox, input:radio, input:file, select").uniform();
        });
    </script>
@show
</body>
</html>