@php
    $company = \App\CompanySetting::first(['email','phone','name']);
    $categories = \App\GroceryCategory::where('status',0)->orderBy('id','desc')->get();
    $locations = \App\Location::where('status',0)->orderBy('id','desc')->get();
@endphp
	<!-- Footer Start -->
	<footer class="footer">
		<div class="footer-first-row">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 contact">
						<ul class="call-email-alt">
							<li><a href="tel:{{$company->phone}}" class="callemail"><i class="uil uil-dialpad-alt"></i>{{$company->phone}}</a></li>
							<li><a href="mailto:{{$company->email}}" class="callemail"><i class="uil uil-envelope-alt"></i>{{$company->email}}</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="social-links-footer">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
								<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a href="#"><i class="fab fa-instagram"></i></a></li>
								<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
		<div class="footer-second-row">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4> {{__('Categories')}} </h4>
							<ul>
								@foreach ($categories as $item)
									<li><a href="{{url('category/'.$item->id.'/'.Str::slug($item->name))}}"> {{$item->name}} </a></li>
								@endforeach
								<li><a href="{{url('/all-categories')}}"> {{__('All Category')}} </a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4> {{__('Useful Links')}} </h4>
							<ul>
								<li><a href="{{url('/featured-products')}}"> {{__('Featured Products')}} </a></li>
								<li><a href="{{url('/offers')}}"> {{__('Offers')}} </a></li>
								<li><a href="{{url('/faq')}}">{{__('Faq')}}</a></li>
								<li><a href="{{url('/contact-us')}}"> {{__('Contact Us')}} </a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4> {{__('Top Cities')}} </h4>
							<ul>
								@foreach ($locations as $item)
									<li>{{$item->name}}</li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item-app">
							<h4> {{__('Download App')}} </h4>
							<ul>
								<li><a href="#"><img class="download-btn" src="{{ url('frontend/images/download-1.svg') }}" alt=""></a></li>
								<li><a href="#"><img class="download-btn" src="{{ url('frontend/images/download-2.svg') }}" alt=""></a></li>
							</ul>
						</div>
						<div class="second-row-item-payment">
							<h4> {{__('Payment Method')}} </h4>
							<div class="footer-payments">
								<ul id="paypal-gateway" class="financial-institutes">
									<li class="financial-institutes__logo">
									  <img alt="Visa" title="Visa" src="{{ url('frontend/images/footer-icons/pyicon-6.svg') }}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="Visa" title="Visa" src="{{ url('frontend/images/footer-icons/pyicon-1.svg') }}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="MasterCard" title="MasterCard" src="{{ url('frontend/images/footer-icons/pyicon-2.svg') }}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="American Express" title="American Express" src="{{ url('frontend/images/footer-icons/pyicon-3.svg') }}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="Discover" title="Discover" src="{{ url('frontend/images/footer-icons/pyicon-4.svg') }}">
									</li>
								</ul>
							</div>
						</div>
						@php
							$lang = \App\Language::where('status',1)->get();
							$local = \App\Language::where('name',session('locale'))->first();
							if($local){
								$lang_image="/images/upload/".$local->icon;
								$name= session('locale');
							}
							else{
								$name = \App\CompanySetting::first()->language;
								$icon = \App\Language::where('name',$name)->first();
								$lang_image="/images/upload/".$icon->icon;
							}
						@endphp
						<div class="second-row-item-payment">
							<h4>{{__('Languages')}}</h4>
							<div class="select_location">
								<div class="ui inline dropdown loc-title">
									<div class="text">
										<img alt="Image placeholder" src="{{asset($lang_image)}}" class="flag-icon mt-0">
										{{$name}}
									</div>
									<i class="uil uil-angle-down icon__14"></i>
									<div class="menu dropdown_loc">
										@foreach ($lang as $item)
											<a href="{{url('changeLanguage/'.$item->name)}}" class="item channel_item">
												<img alt="Image placeholder"  src="{{url('images/upload/'.$item->icon)}}" class="flag-icon" > 
												{{$item->name}}
											</a>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-last-row">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="footer-bottom-links">
							<ul>
								<li><a href="{{url('/contact-us')}}"> {{__('Contact')}} </a></li>
								<li><a href="#"> {{__('Privacy Policy')}} </a></li>
								<li><a href="#"> {{__('Term & Conditions')}} </a></li>
								<li><a href="#"> {{__('Refund & Return Policy')}} </a></li>
							</ul>
						</div>
						<div class="copyright-text">
							<i class="uil uil-copyright"></i> {{__('Copyright')}} @php echo date('Y'); @endphp <b > {{$company->name}} </b>. {{__('All rights reserved')}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer End -->