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
	if (session()->exists('coupon')) {
		$coupon = session('coupon');
		if ($coupon->type == 'amount') {
			$discount = $coupon->discount;
		}
		else {
			$discount = ($total * $coupon->discount) / 100;
		}
	}
@endphp
<!-- Cart Sidebar Offset Start-->
<div class="bs-canvas bs-canvas-left position-fixed bg-cart h-100" id="cart">
	<div class="bs-canvas-header side-cart-header p-3 ">
		<div class="d-inline-block  main-cart-title">
			{{__("My Cart")}}<span>(<span class="cart-item-count m-0">{{count((array) session('cart'))}}</span> Items)</span>
		</div>
		<button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
	</div> 
	<div class="bs-canvas-body">
		<div class="cart-top-total">
			<div class="cart-total-dil">
				<h4>{{$company->name}}</h4>
				<span>{{$data['currency']}}<span class="cart-main-total">{{$total}}</span></span>
			</div>
			<div class="cart-total-dil pt-2">
				<h4>{{__('Delivery Charges')}}</h4>
				<span>{{$data['currency']}}{{$setting->delivery_charge}}</span>
			</div>
		</div>
		<div class="side-cart-items">
			@if(session('cart'))
                @foreach((array) session('cart') as $id => $item)
					<div class="cart-item">
						<div class="cart-product-img">
							<img src="{{ $item['image'] }}" alt="">
							<div class="offer-badge"> <span class="off_{{$item['id']}}">{{ $item['off'] }}</span>% {{__('OFF')}}</div>
						</div>
						<div class="cart-text">
							<h4> {{$item['name']}} </h4>
							<div class="cart-radio">
								<input type="hidden" name="cart-item-id" value="{{$item['id']}}" class="cart-item-id">
								<input type="hidden" name="cart-item-detail-index-id" value="1" class="cart-item-detail-index-{{$item['id']}} ">
								<ul class="kggrm-now">
									@foreach (json_decode($item['details']) as $key => $detail)
										<li>
											<input type="radio" id="{{$item['id'] .'_'.$key}}" data-id="{{$item['id']}}" data-index-id="{{$key}}" class="cart-item-detail" name="detail_{{$item['id']}}" {{ $item['detail_index'] == $key? 'checked':'' }}>
											<label for="{{$item['id'] .'_'.$key}}"> {{$detail->qty}}{{$detail->unit}} </label>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="qty-group">
								<div class="quantity buttons_added">
									<input type="button" value="-" class="minus minus-btn">
									<input type="number" step="1" name="quantity" min="1" value="{{$item['qty']}}" class="input-text qty cart-qty text qtyOf-{{$item['id']}}">
									<input type="button" value="+" class="plus plus-btn">
								</div>
								<div class="product-price ml-auto">
									{{$data['currency']}}<span class="sell_price_{{$item['id']}}">{{$item['sell_price']}}</span> 
									<span class="line-through">{{$data['currency']}}<span class="fake_price_{{$item['id']}}">{{$item['fake_price']}}</span></span>
								</div>
							</div>
							<button type="button" class="cart-close-btn" data-id="{{$item['id']}}"><i class="uil uil-multiply"></i></button>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
	<div class="bs-canvas-footer">
		@if ($discount != 0)
			<div class="cart-total-dil saving-total">
				<h4>{{__('Discount')}}</h4>
				<span>{{$data['currency']}}<span class="cart-discount">{{$discount}}</span></span>
			</div>
		@endif
		<div class="cart-total-dil saving-total">
			<h4>{{__('Total Saving')}}</h4>
			<span>{{$data['currency']}}<span class="cart-saving-total">{{$saving}}</span></span>
		</div>
		<div class="main-total-cart">
			<h2> {{__('Total')}}</h2>
			<span>{{$data['currency']}}<span class="cart-final-total">{{$total + $setting->delivery_charge - $discount}}</span></span>
		</div>
		<div class="checkout-cart">
			<a href="{{url('/checkout')}}" class="cart-checkout-btn hover-btn"> {{__('Proceed to Checkout')}} </a>
		</div>
	</div>
</div>
<!-- Cart Sidebar Offsetl End-->