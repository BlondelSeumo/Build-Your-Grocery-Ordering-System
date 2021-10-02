@extends('frontend.layout.master')
@section('title', __('Order Placed'))

@section('content')


	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{__('Order Placed')}}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-8">
						<div class="order-placed-dt">
							<i class="uil uil-check-circle icon-circle"></i>
							<h2>{{__('Order Successfully Placed')}}</h2>
							<p>{{__('Thank you for your order! will received order soon')}}</p>
							<div class="delivery-address-bg">
								<div class="title585">
									<div class="pln-icon"><i class="uil uil-telegram-alt"></i></div>
									<h4>{{__('Your order will be sent to this address')}}</h4>
								</div>
								<ul class="address-placed-dt1">
									<li><p><i class="uil uil-map-marker-alt"></i>{{__('Address')}} :<span>{{$order->address['soc_name']}}, {{$order->address->street}}, {{$order->address->city}}, {{$order->address->zipcode}}
                                    </span></p></li>
									<li><p><i class="uil uil-phone-alt"></i>{{__('Phone Number')}} :<span>{{Auth::user()->phone_code . Auth::user()->phone}} </span></p></li>
									<li><p><i class="uil uil-envelope"></i>{{__('Email Address')}} :<span>{{Auth::user()->email}} </span></p></li>
									<li><p><i class="uil uil-card-atm"></i>{{__('Payment Method')}} :<span>
										@if ($order->payment_type == "COD")
											{{__('Cash on Delivery')}}
										@elseif($order->payment_type == "WHATSAPP")
											{{__('Whatsapp (Cash on Delivery)')}}
										@else
											{{$order->payment_type}}
										@endif
									</span></p></li>
								</ul>
								<div class="stay-invoice">
									<div class="st-hm">{{__('Stay Home')}}<i class="uil uil-smile"></i></div>
									<a href="{{url('invoice/'.$order->id)}}" target="_blank" class="invc-link hover-btn">{{__('invoice')}}</a>
								</div>
								<div class="placed-bottom-dt">
									{{__('The payment of')}} <span> {{ $data['currency'].$order->payment }} </span> {{__("you'll make when the deliver arrives with your order.")}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- Body End -->

@endsection