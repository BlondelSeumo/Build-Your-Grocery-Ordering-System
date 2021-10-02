<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{url('')}}" />
    <style>
            * {
            -webkit-box-sizing: border-box;
                    box-sizing: border-box;
            }

            body {
            padding: 0;
            margin: 0;
            }

            #notfound {
            position: relative;
            height: 100vh;
            }

            #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
            }

            .notfound {
            max-width: 520px;
            width: 100%;
            line-height: 1.4;
            text-align: center;
            }

            .notfound .notfound-404 {
            position: relative;
            height: 200px;
            margin: 0px auto 20px;
            z-index: -1;
            }

            .notfound .notfound-404 h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 236px;
            font-weight: 200;
            margin: 0px;
            color: #211b19;
            text-transform: uppercase;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
            }

            .notfound .notfound-404 h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 28px;
            font-weight: 400;
            text-transform: uppercase;
            color: #211b19;
            background: #fff;
            padding: 10px 5px;
            margin: auto;
            display: inline-block;
            position: absolute;
            bottom: 0px;
            left: 0;
            right: 0;
            }

            .notfound a {
            font-family: 'Montserrat', sans-serif;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            padding: 13px 23px;
            background: #172b4d;
            font-size: 18px;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
            }

            .notfound a:hover {
            color: #fff;
            background: #172b4d;
            }

            @media only screen and (max-width: 767px) {
            .notfound .notfound-404 h1 {
                font-size: 148px;
            }
            }

            @media only screen and (max-width: 480px) {
            .notfound .notfound-404 {
                height: 148px;
                margin: 0px auto 10px;
            }
            .notfound .notfound-404 h1 {
                font-size: 86px;
            }
            .notfound .notfound-404 h2 {
                font-size: 16px;
            }
            .notfound a {
                padding: 7px 15px;
                font-size: 14px;
            }
            }
        </style>
</head>
<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Oops!</h1>
				<h2>  @yield('code') -  @yield('message')</h2>
            </div>         
            @if(isset($err_code))
                <a href="{{url('active')}}">Activate Licence</a>
            @else 
                <a href="{{url('/')}}">Go TO Homepage</a>
            @endif
            
		</div>
	</div>

</body>

</html>













{{-- 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>
    </body>
</html> --}}
