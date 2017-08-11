<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') | Woobe Blog</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>
	<link rel="stylesheet/less" type="text/css" href="{{asset('css/admin.less')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('trumbowyg/ui/trumbowyg.min.css')}}"/>
	<script type="text/javascript" src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/less.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
	<script type="text/javascript" src="{{asset('trumbowyg/trumbowyg.js')}}"></script>
</head>
<body>
@yield('facebook-api', '')
@yield('content')
</body>
</html>