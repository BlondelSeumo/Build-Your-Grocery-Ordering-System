<!DOCTYPE html>
<html lang="en">

	<head>
        @php
            $company = \App\CompanySetting::first(['logo','name','favicon','logo_dark','responsive_logo']);
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
		<title>{{$company->name}}  | {{__("Invoice")}}</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="{{ url('images/upload/'.$company->favicon) }}">
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href='{{ asset('frontend/css/unicons.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/style.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/responsive.css') }}' rel='stylesheet'>
		<link href='{{ asset('frontend/css/night-mode.css') }}' rel='stylesheet'>
		
		<!-- Vendor Stylesheets -->
		<link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/semantic.min.css') }}" rel="stylesheet">
		@if (session('direction') == "rtl")
			<link href="{{ asset('frontend/css/rtl.css') }}" rel="stylesheet">
		@endif
	</head>

<body>
	<!-- Header Start -->
	<header class="header clearfix">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="top-header-group">
						<div class="top-header">
							<div class="res_main_logo">
                                <a href="{{ url('/') }}"><img src="{{ url('images/upload/'.$company->responsive_logo) }}" alt=""></a>
							</div>
							<div class="main_logo ml-0" id="logo">
								<a href="{{ url('/') }}"><img src="{{ url('images/upload/'.$company->logo) }}" alt=""></a>
								<a href="{{ url('/') }}"><img class="logo-inverse" src="{{ url('images/upload/'.$company->logo_dark) }}" alt=""></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->
	<!-- Body Start -->
	<div class="bill-dt-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bill-detail">
                        <div class="bill-dt-step">
                            <div class="bill-title">
                                <h4>{{__('Items')}}</h4>
                            </div>
                            <div class="bill-descp">
                                <div class="itm-ttl">{{ count($order->orderItem) }} {{__('items')}}</div>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($order->orderItem as $item)
                                    <span class="item-prdct"> {{$item->itemName .' '. $item->unit_qty. $item->unit .' * '. $item->quantity}} </span>
                                    @php
                                        $subtotal = $subtotal + $item->price;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        <div class="bill-dt-step">
                            <div class="bill-title">
                                <h4>{{__('Delivery Address')}}</h4>
                            </div>
                            <div class="bill-descp">
                                <div class="itm-ttl">{{$order->address->address_type}}</div>
                                <p class="bill-address">{{$order->address['soc_name']}}, {{$order->address->street}}, {{$order->address->city}}, {{$order->address->zipcode}}</p>
                            </div>
                        </div>
                        <div class="bill-dt-step">
                            <div class="bill-title">
                                <h4>{{__('Payment')}}</h4>
                            </div>
                            <div class="bill-descp">
                                <div class="total-checkout-group p-0 border-top-0">
                                    <div class="cart-total-dil">
                                        <h4>{{__('Subtotal')}}</h4>
                                        <span> {{$data["currency"] }}{{ $subtotal }}</span>
                                    </div>
                                    <div class="cart-total-dil pt-3">
                                        <h4>{{__('Discount')}}</h4>
                                        <span>{{$data["currency"] . $order->discount }}</span>
                                    </div>
                                    <div class="cart-total-dil pt-3">
                                        <h4>{{__('Delivery Charges')}}</h4>
                                        <span>{{$data["currency"] . $order->delivery_charge }}</span>
                                    </div>
                                </div>
                                <div class="main-total-cart pl-0 pr-0 pb-0 border-bottom-0">
                                    <h2>{{__('Total')}}</h2>
                                    <span>{{$data["currency"] . $order->payment }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bill-dt-step">
                            <div class="bill-title">
                                <h4>{{__('Delivery Details')}}</h4>
                            </div>
                            <div class="bill-descp">
                                <p class="bill-dt-sl"><b>{{__('Location')}}</b> - <span class="dly-loc">{{$order->location->name}}</span></p>
                                <p class="bill-dt-sl">{{__('Order ID')}} - <span class="descp-bll-dt">{{$order->order_no}}</span></p>
                                <p class="bill-dt-sl">{{__('Items')}} - <span class="descp-bll-dt">{{ count($order->orderItem) }}</span></p>
                            </div>
                        </div>
                        <div class="bill-dt-step">
                            <div class="bill-title">
                                <h4>{{__('Payment Option')}}</h4>
                            </div>
                            <div class="bill-descp">
                                <p class="bill-dt-sl"><span class="dlr-ttl25 mr-1"><i class="uil uil-check-circle"></i></span>
                                    @if ($order->payment_type == "COD")
                                        {{__('Cash on Delivery')}}
                                    @elseif($order->payment_type == "WHATSAPP")
                                        {{__('Whatsapp (Cash on Delivery)')}}
                                    @else
                                        {{$order->payment_type}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="bill-dt-step">
                            <div class="bill-bottom">
                                <div class="thnk-ordr">{{__('Thanks for Ordering')}}</div>
                                <a class="print-btn hover-btn" id="printPageButton" href="javascript:window.print();">{{__('Print')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Body End -->
	
	<!-- Javascripts -->
	<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('frontend/js/semantic.min.js') }}"></script>
	<script src="{{ asset('frontend/js/night-mode.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
	<script src="{{ asset('frontend/js/frontend.js') }}"></script>
	
	
</body>
</html>