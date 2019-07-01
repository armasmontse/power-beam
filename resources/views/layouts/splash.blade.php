<!DOCTYPE html>
<html lang="{{ $current_lang_iso }}" >
    <head>

		<meta name=viewport content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

        <title>
			@if(View::hasSection('title'))
				@yield('title'):
			@else
				{{ config('app.name') }} by El cultivo
			@endif
		</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100, 500" rel="stylesheet" type="text/css">
        <style>
			html {
				height: 100%;
				width: 100%;
			}

			body {
				height: calc(100% - 16px) ;
				width: calc(100% - 8px) ;
				/*background: #B48D2F;*/
				background-image: url(images/circuito.jpg);
				color: #000;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
                
			}
			.container{
				text-align: center;
			    display: table-cell;
			    vertical-align: middle;
			    /*height: 100vh;*/
			}
			header{
				height: 100px;
			    width: 600px;
			    margin: 0px auto;
			    background-image: url(images/powerbeamwhite.svg);
			    background-position: center;
			    background-repeat: no-repeat;
			    padding: 0px;
			}
			.splash {
				height: 500px;
				width: auto;
				object-fit: cover;
				margin: 0px auto;
				background-image: url("images/aboutus-portada.svg");
				background-position: center;
				background-repeat: no-repeat;

			}
			.splash__svg {
				z-index: 1;
			}
			.container {
				text-align: center;
				display: block;
				vertical-align: middle;
				background-size: 90%;
				margin: 6% 0 0 0;
			}
			.content {
				text-align: center;
				display: inline-block;
				background: #FFF;
				padding: 70px 50px;
				box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
			}
			.title {
				font-size: 100px;
				margin-bottom: 40px;
				text-align: center;
				color: #DC3848;
				font-weight: 400;
			}

			.sub-ttl {
				font-size: 35px;
				margin-bottom: 40px;
				text-align: center;
				color: #DC3848;
			}

			@media screen and (max-width:768px) {
			    header {
					width: 480px;
					margin: 25% auto 20px;
			    }
			    .title {
					font-size: 60px;
					
				}
				.sub-ttl {
					font-size: 20px;
				}
				.content {
					padding: 40px 70px;
				}
				.container {
					margin: 3% 0 0 0;
				}
			}
			@media screen and (max-width:500px) {
			    header {
					width: 280px;
			    }
			    .content {
					padding: 30px 40px;
				}
			}
			@media screen and (max-width:500px) {
			    
			    .content {
					width: 50%;
				}
			}
        </style>
    </head>
    <body>
    	<div class="container">
	    	<header></header>
			@yield('content')
		</div>
    </body>
</html>
