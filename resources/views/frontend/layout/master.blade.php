<!DOCTYPE html>
<html lang="en">

	<head>
		@php
			$company = \App\CompanySetting::first(['name','favicon']);
			$color = \App\Setting::first()->color;
		@endphp
		
		<!-- Dynamic color -->
		@php
			$rgb = $color;
			$darker = 1.2;
			$hash = (strpos($rgb, '#') !== false) ? '#' : '';
			$rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
			if(strlen($rgb) != 6) return $hash.'000000';
			$darker = ($darker > 1) ? $darker : 1;

			list($R16,$G16,$B16) = str_split($rgb,2);

			$R = sprintf("%02X", floor(hexdec($R16)/$darker));
			$G = sprintf("%02X", floor(hexdec($G16)/$darker));
			$B = sprintf("%02X", floor(hexdec($B16)/$darker));
			$hover_color =  $hash.$R.$G.$B;
		@endphp
		
		<style>
			:root{
				--primary_color : <?php echo $color ?>;
				--primary_color_hover : <?php echo $hover_color ?>;
				--primary_color_opacity_1 : <?php echo $color.'1a' ?>;
				--primary_color_opacity_2 : <?php echo $color.'33' ?>;
				--primary_color_opacity_9 : <?php echo $color.'e6' ?>;
			}
		</style>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base_url" content="{{ url('/') }}">
		<meta name="direction" content="{{session('direction')}}">
		<title> {{$company->name}}  | @yield('title') </title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="{{ url('images/upload/'.$company->favicon) }}">
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link href='{{ asset('frontend/css/unicons.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/style.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/responsive.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/night-mode.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/step-wizard.css') }}' rel='stylesheet'>
		
		<!-- Vendor Stylesheets -->
		<link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/semantic.min.css') }}" rel="stylesheet">
		@if (session('direction') == "rtl")
			<link href="{{ asset('frontend/css/rtl.css') }}" rel="stylesheet">
		@endif

	</head>

<body>
	@php
		if(Auth::check())
		{
			if(Auth::user()->role != 0)
				Auth::logout();
		}
	@endphp
	<!-- start per-loader -->
	<div class="loader-container">
		<div class="loader-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
	<!-- end per-loader -->

	@include('frontend.layout.header')

	@yield('content')

	@include('frontend.model.cart')
	@include('frontend.model.category')
	
	@include('frontend.layout.footer')

	
	<!-- Javascripts -->
	<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
	<script src="{{ asset('frontend/js/semantic.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('frontend/js/product.thumbnail.slider.js') }}"></script>
	<script src="{{ asset('frontend/js/offset_overlay.js') }}"></script>
	<script src="{{ asset('frontend/js/night-mode.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	 <?php 
		$key = \App\Setting::find(1)->map_key;
		$paypal_on = \App\PaymentSetting::find(1)->paypal;
		$sendbox = \App\PaymentSetting::find(1)->paypalSendbox;
		$cur = \App\Setting::find(1)->currency;
	?>
	@if($paypal_on)
		<script src="https://www.paypal.com/sdk/js?client-id={{$sendbox}}&currency={{$cur}}"  data-namespace="paypal_sdk"></script>
	@endif
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script src="https://js.paystack.co/v1/inline.js"></script> 
	<script src="{{ asset('frontend/js/custom.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{$key}}" async defer></script>
	<script src="{{ asset('frontend/js/frontend.js') }}"></script>
</body>
</html>