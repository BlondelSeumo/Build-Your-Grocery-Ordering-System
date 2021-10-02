@extends('frontend.layout.master')
@section('title', __('Checkout'))

@section('content')
@php
	$currency_code = \App\Setting::where('id',1)->first()->currency;
    $data['currency'] = \App\Currency::where('code',$currency_code)->first()->symbol;
	$company = \App\CompanySetting::first(['name']);
	$setting = \App\Setting::first(['delivery_charge']);
	$total = 0;
    $saving = 0;
	foreach ((array) session('cart') as $id => $details) {
		$total += $details['sell_price'];
        $saving += $details['fake_price'];
	}
	$saving = $saving - $total;
    $discount = 0;
    $coupon_code = "";
	if (session()->exists('coupon')) {
		$coupon = session('coupon');
        $coupon_code = $coupon->code;
		if ($coupon->type == 'amount') {
			$discount = $coupon->discount;
		}
        else {
            $discount = ($total * $coupon->discount) / 100;
        }
	}
@endphp
<!-- Body Start -->
<form action="{{url('/place-order')}}" method="POST" id="checkout-form">
    @csrf
    <div class="wrapper">
        <div class="gambo-Breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{__('Checkout')}} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="all-product-grid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div id="checkout_wizard" class="checkout accordion left-chck145">
                            <div class="checkout-step">
                                <div class="checkout-card" id="headingOne">
                                    <span class="checkout-step-number">1</span>
                                    <h4 class="checkout-step-title"> 
                                        <button class="wizard-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> {{__('Have a promocode?')}} </button>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="collapse in" data-parent="#checkout_wizard">
                                    <div class="checkout-step-body">
                                        <p>{{__('Enter a valid promocode and get amazing discounts')}}</p>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="checkout-login">
                                                    <div class="login-phone">
                                                        <input type="text" class="form-control" value="{{$coupon_code}}" placeholder="Enter Code" name="promocode" id="input-promocode">
                                                    </div>
                                                    <a class="chck-btn hover-btn code-apply-btn"> {{__('Apply')}} </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-step">
                                <div class="checkout-card" id="headingTwo">
                                    <span class="checkout-step-number">2</span>
                                    <h4 class="checkout-step-title">
                                        <button class="wizard-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> {{__('Delivery Address')}}</button>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse {{ count($data['address']) > 0 ? :'in show' }}" aria-labelledby="headingTwo" data-parent="#checkout_wizard">
                                    <div class="checkout-step-body">
                                        <div class="checout-address-step">
                                            <div class="row">
                                                <div class="col-lg-12">	
                                                    @if (count($data['address']) > 0)
                                                        <div class="form-group">
                                                            <div class="product-radio">
                                                                <ul class="product-now">
                                                                    @foreach ($data['address'] as $key => $item)
                                                                    @if ($key == 0)
                                                                        @php
                                                                            $ad = $item;
                                                                        @endphp
                                                                    @endif
                                                                        <li>
                                                                            <input type="radio" class="address-types" id="address-{{$item->id}}" value="{{$item->id}}" name="address_id" {{ $key == 0? 'checked':'' }}>
                                                                            <label for="address-{{$item->id}}"> {{$item->address_type}} </label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="address-fieldset">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label"> {{__('Flat / House / Office No.')}}* </label>
                                                                        <input id="soc_name_show" name="soc_name" value="{{$ad->soc_name}}" type="text" placeholder="Address" class="form-control input-md" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label"> {{__('Street / Society / Office Name')}}*</label>
                                                                        <input id="street_show" name="street" value="{{$ad->street}}" type="text" placeholder="Street Address" class="form-control input-md" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">{{__('Pincode')}}*</label>
                                                                        <input id="pincode_show" name="zipcode" value="{{$ad->zipcode}}" type="text" placeholder="Pincode" class="form-control input-md" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">{{__('City')}}*</label>
                                                                        <input id="city_show" name="city" value="{{$ad->city}}" type="text" placeholder="Enter City" class="form-control input-md" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="address-btns">
                                                                            <a class="collapsed ml-auto next-btn16 hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" href="#collapseThree"> {{__('Next')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="#" class="add-address hover-btn" data-toggle="modal" data-target="#address_model"> {{__('Add New Address')}} </a>
                                                    @endif					
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-step last-step">
                                <div class="checkout-card" id="headingThree"> 
                                    <span class="checkout-step-number">3</span>
                                    <h4 class="checkout-step-title">
                                        <button class="wizard-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> {{__('Payment')}} </button>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse {{ count($data['address']) > 0 ? 'in show':'display-none' }}" aria-labelledby="headingThree" data-parent="#checkout_wizard">
                                    <div class="checkout-step-body">
                                        <div class="payment_method-checkout">	
                                            <div class="row">	
                                                <div class="col-md-12">
                                                    <div class="rpt100">													
                                                        <ul class="radio--group-inline-container_1">
                                                            <input type="hidden" name="payment_token" id="payment_token">
                                                            <input type="hidden" id="razor_key" name="razor_key" value="{{ $data['payment_setting']->razorPublishKey }}">
                                                            <input type="hidden" id="paystack_public_key" name="paystack_public_key" value="{{ $data['payment_setting']->paystack_public_key }}">
                                                            <input type="hidden" id="auth_email" name="auth_email" value="{{ Auth::user()->email }}">

                                                            @if ($data['payment_setting']->whatsapp)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="Whatsapp" value="WHATSAPP" name="payment_type" class="payment_type" type="radio" checked>
                                                                        <label for="Whatsapp" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/whatsapp.png') }}" width="120" alt="">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif

                                                            @if ($data['payment_setting']->cod)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="COD" value="COD" name="payment_type" class="payment_type" type="radio">
                                                                        <label for="COD" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/cod.png') }}" width="80" alt="">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif

                                                            @if ($data['payment_setting']->paypal)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="Paypal" value="PAYPAL" name="payment_type" class="payment_type" type="radio">
                                                                        <label for="Paypal" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/paypal.png') }}" width="100" alt="">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if ($data['payment_setting']->razor)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="Razor" value="RAZOR" name="payment_type" class="payment_type" type="radio">
                                                                        <label for="Razor" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/razor.png') }}" width="140" alt="">
                                                                        </label>

                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if ($data['payment_setting']->stripe)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="Stripe" value="STRIPE" name="payment_type" class="payment_type" type="radio">
                                                                        <label for="Stripe" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/stripe.png') }}" width="80" alt="">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if ($data['payment_setting']->flutterwave)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="Flutterwave" value="FLUTTERWAVE" name="payment_type" class="payment_type" type="radio">
                                                                        <label for="Flutterwave" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/flutterwave.svg') }}" width="150" alt="">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            
                                                            @if ($data['payment_setting']->paystack)
                                                                <li>
                                                                    <div class="radio-item_1">
                                                                        <input id="Paystack" value="PAYSTACK" name="payment_type" class="payment_type" type="radio">
                                                                        <label for="Paystack" class="radio-label_1">
                                                                            <img src="{{ url('/frontend/images/payment/paystack.png') }}" width="125" alt="">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="form-group return-departure-dts" data-method="STRIPE">															
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group mt-1">
																	<label class="control-label">{{__('Name on Card')}}*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" type="text" name="holdername" value=""
                                                                            id="holdername" maxlength="64" placeholder="{{__('Name on Card')}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group mt-1">
																	<label class="control-label">{{__('Card Number')}}*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" type="text" name="cardnumber" value=""
                                                                            id="cardnumber" maxlength="64" size="20" placeholder="{{__('Card Number')}}">															
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group mt-1">																	
																	<label class="control-label">{{__('Expiration Month')}}*</label>
																	<select class="ui fluid search dropdown form-dropdown" name="expire_month" id="expire_month">
																		<option value="">Month</option>
																		<option value="1">January</option>
																		<option value="2">February</option>
																		<option value="3">March</option>
																		<option value="4">April</option>
																		<option value="5">May</option>
																		<option value="6">June</option>
																		<option value="7">July</option>
																		<option value="8">August</option>
																		<option value="9">September</option>
																		<option value="10">October</option>
																		<option value="11">November</option>
																		<option value="12">December</option>
																	  </select>	
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group mt-1">
																	<label class="control-label">{{__('Expiration Year')}}*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" type="text" name="expire_year" id="expire_year" maxlength="4" placeholder="{{__('Year')}}">															
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group mt-1">
																	<label class="control-label">{{__("CVV")}}*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" name="cvv" id="cvv" maxlength="3" placeholder="{{__('CVV')}}">															
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
                                                    <div class="paypal-button-section display-none mt-4"> 
                                                        <div id="paypal-button-container"> </div>
                                                    </div>
                                                    <button type="submit" id="form_submit" class="next-btn16 hover-btn"> {{__('Place Order')}} </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="pdpt-bg mt-0">
                            <div class="pdpt-title">
                                <h4> {{__('Order Summary')}} </h4>
                            </div>
                            <div class="right-cart-dt-body">
                                @if(session('cart'))
                                    @foreach((array) session('cart') as $id => $item)
                                        <div class="cart-item border_radius cart-item-{{$item['id']}}">
                                            <div class="cart-product-img">
                                                <img src="{{ $item['image'] }}" alt="">
                                                <div class="offer-badge"> <span class="off_{{$item['id']}}">{{ $item['off'] }}</span>% {{__('OFF')}}</div>
                                            </div>
                                            <div class="cart-text">
                                                <h4> {{$item['name']}} </h4>
                                                <div class="product-price text-left">
                                                    {{$data['currency']}}<span class="sell_price_{{$item['id']}}">{{$item['sell_price']}}</span> 
                                                    <span class="line-through">{{$data['currency']}}<span class="fake_price_{{$item['id']}}">{{$item['fake_price']}}</span></span>
                                                </div>
                                                <button type="button" class="cart-close-btn checkout-cart-close-btn" data-id="{{$item['id']}}">
                                                    <i class="uil uil-multiply"></i>
                                                </button>
                                            </div>	
                                        </div>
                                    @endforeach
                                @endif	

                            </div>
                            <div class="total-checkout-group">
                                <div class="cart-total-dil">
                                    <h4>{{$company->name}}</h4>
                                    <span>{{$data['currency']}}<span class="cart-main-total">{{$total}}</span></span>
                                </div>
                                <div class="cart-total-dil pt-3">
                                    <h4> {{__('Delivery Charges')}} </h4>
                                    <span>{{$data['currency']}}{{$setting->delivery_charge}}</span>
                                </div>
                                @if ($discount != 0)
                                    <div class="cart-total-dil pt-3">
                                        <h4>{{__('Discount')}}</h4>
                                        <span>{{$data['currency']}}<span class="cart-discount">{{$discount}}</span></span>
                                    </div>
                                @endif
                            </div>
                            <div class="cart-total-dil saving-total ">
                                <h4> {{__('Total Saving')}} </h4>
                                <span>{{$data['currency']}}<span class="cart-saving-total">{{$saving}}</span></span>
                            </div>
                            <div class="main-total-cart">
                                <h2> {{__('Total')}}</h2>
                                <span>{{$data['currency']}}<span class="cart-final-total">{{$total + $setting->delivery_charge - $discount}}</span></span>
                            </div>
                            <div class="payment-secure">
                                <i class="uil uil-padlock"></i> {{__('Secure checkout')}}
                            </div>
                        </div>
                        <a href="#" class="promo-link45"> {{__('Have a promocode?')}} </a>
                        <div class="checkout-safety-alerts">
                            <p><i class="uil uil-sync"></i> {{__('100% Replacement Guarantee')}} </p>
                            <p><i class="uil uil-check-square"></i> {{__('100% Genuine Products')}} </p>
                            <p><i class="uil uil-shield-check"></i> {{__('Secure Payments')}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</form>
<!-- Body End -->

@include('frontend.model.address-add')
@endsection