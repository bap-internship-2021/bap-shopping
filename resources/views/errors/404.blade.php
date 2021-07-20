<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>404</title>
    <link href="{{URL::asset('404/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('404/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('404/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{URL::asset('404/css/price-range.css')}}" rel="stylesheet">
    <link href="{{URL::asset('404/css/animate.css')}}" rel="stylesheet">
	<link href="{{URL::asset('404/css/main.css')}}" rel="stylesheet">
	<link href="{{URL::asset('404/css/responsive.css')}}" rel="stylesheet">  
</head><!--/head-->

<body>
	<div class="container text-center">
		<div class="logo-404" style="margin-top: 0px;">
            <img src="{{asset('admin/images/Bap-logo.jpg')}}" style="width:250px; height:250px;" alt=""/>
		</div>
		<div class="content-404">
			<img src="{{asset('admin/images/404.png')}}" class="img-responsive" alt="" />
			<h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
			<p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
            <h2><a href="{{route('/')}}">Bring me back Home</a></h2>
		</div>
	</div>
</body>
</html>