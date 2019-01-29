<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	<title>سیستم مدیریت جلسات آیریس</title>


	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
	<meta name="viewport" content="width=device-width"/>


	<!-- Bootstrap core CSS     -->
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>

	<!-- Animation library for notifications   -->
	<link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>

	<!--  Light Bootstrap Table core CSS    -->
	<link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="{{asset('css/demo.css')}}" rel="stylesheet"/>
	<link href="{{asset('css/custom.css')}}" rel="stylesheet"/>
	<link href="{{asset('css/persian.datepicker.css')}}" rel="stylesheet"/>


	<!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/datepicker/persian.date.js')}}"></script>
	<script src="{{asset('js/datepicker/persian.datepicker.js')}}"></script>
	<script src="{{asset('js/custom.js')}}"></script>
	<script src="{{asset('js/bootstrap-notify.js')}}"></script>
</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

		<!--

			Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
			Tip 2: you can also add an image using data-image tag

		-->

		<div class="sidebar-wrapper">
			<div class="logo">
				<a href="/" class="simple-text">
					سیستم مدیریت جلسات آیریس
				</a>
			</div>

			<ul class="nav">
				<li>
					<a href="{{route('statics')}}">
						<p>آمار</p>
					</a>
				</li>
				<li>
					<a href="{{route('meetings')}}">
						<p>جلسات</p>
					</a>
				</li>
				<li>
					<a href="table.html">
						<p>پیام ها</p>
					</a>
				</li>
				<li>
					<a href="typography.html">
						<p>اخبار</p>
					</a>
				</li>
{{--
				<li>
					<a href="{{route('register')}}">
						<p>ثبت نام کاربر جدید</p>
					</a>
				</li>--}}

			</ul>
		</div>
	</div>

	<div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#navigation-example-2">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					{{--todo dashborad link--}}
					<a class="navbar-brand" href="#">صفحه اصلی</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="">
								{{--todo create profile--}}
								<p>حساب کابری</p>
							</a>
						</li>
						<li>
							<a href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								{{ __('خروج از سیستم') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
						<li class="separator hidden-lg"></li>
					</ul>
				</div>
			</div>
		</nav>


		<div class="content">
			@yield('content')
		</div>


		<footer class="footer">
			<div class="container-fluid">
				<p class="copyright pull-right">
					&copy;
					<script>document.write(new Date().getFullYear());</script>
					تمامی حقوق مادی معنوی این سیستم متلعق به شرکت برق باختر می‌باشد
				</p>
			</div>
		</footer>

	</div>
</div>


</body>


<!--  Charts Plugin -->
<script src="{{asset('js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->


<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->




<script type="text/javascript">
	/*$(document).ready(function()
	{

		demo.initChartist();

		$.notify({
			icon: 'pe-7s-gift',
			message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

		}, {
			type: 'info',
			timer: 4000
		});

	});*/
</script>

</html>
