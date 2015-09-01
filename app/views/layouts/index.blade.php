<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Event Manager</title>

@section('css')
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/AdminLTE.min.css') }}
    {{ HTML::style('css/all-skins.min.css') }}
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}
    {{ HTML::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}

@show
</head>

<body class="hold-transition skin-blue sidebar-mini">
@yield('container')

@section('js')
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::script('js/jquery.slimscroll.min.js') }}
    {{ HTML::script('js/fastclick.min.js') }}
    {{ HTML::script('js/app.min.js') }}
    {{ HTML::script('js/demo.js') }}
    {{ HTML::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}
    {{ HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
@show
</body>
</html>