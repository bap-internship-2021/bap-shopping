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
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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