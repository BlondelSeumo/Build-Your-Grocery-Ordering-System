@extends('frontend.layout.master')
@section('title', __('Home'))

@section('content')
	<!-- Body Start -->
	<div class="wrapper">
		<!-- Banner Start -->
		<div class="main-banner-slider">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel offers-banner owl-theme">
							@foreach ($data['banner'] as $item)
								<a href="{{$item->url}}" target="_blank">
									<div class="item">
										<div class="offer-item">								
											<div class="offer-item-img">
												<div class="gambo-overlay"></div>
												<img src="{{ $item->imagePath . $item->image }}" alt="">
											</div>
											<div class="offer-text-dt">
												<div class="offer-top-text-banner">
													<p>{{$item->off}} {{__('Off')}}</p>
													<div class="top-text-1"> {{$item->title2}} </div>
													<span> {{$item->title1}} </span>
												</div>
											</div>
										</div>
									</div>
								</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Banner End -->

		<!-- Categories Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span> {{__('Shop By')}} </span>
								<h2>{{__('Categories')}}</h2>
							</div>
						</div>
					</div>
					@if (count($data['category']) >= 1)
						<div class="col-md-12">
							<div class="owl-carousel cate-slider owl-theme">
								@foreach ($data['category'] as $item)
									<div class="item">
										<a href="{{url('category/'.$item->id.'/'.Str::slug($item->name))}}" class="category-item">
											<div class="cate-img">
												<img src="{{ $item->imagepath .	 $item->image}}" alt="">
											</div>
											<h4> {{$item->name}} </h4>
										</a>
									</div>
								@endforeach
							</div>
						</div>
					@else
						<div class="col-lg-12 col-md-12">
							<div class="how-order-steps">
								<div class="how-order-icon">
									<i class="uil uil-apps"></i>
								</div>
								<h4> {{__('No Category Available')}} </h4>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
		<!-- Categories End -->

		@if (count($data['top_featured']) >= 1)
			<!-- Featured Products Start -->
			<div class="section145">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="main-title-tt">
								<div class="main-title-left">
									<span> {{__('For You')}} </span>
									<h2> {{__('Top Featured Products')}} </h2>
								</div>
								<a href="{{url('/featured-products')}}" class="see-more-btn"> {{__('See All')}} </a>
							</div>
						</div>
						<div class="col-md-12">
							<div class="owl-carousel featured-slider owl-theme">
								@foreach ($data['top_featured'] as $item)
									<div class="item">
										@include('frontend.model.product')
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Featured Products End -->
		@endif

		@if (count($data['coupon']) >= 1)
			<!-- Best Values Offers Start -->
			<div class="section145">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="main-title-tt">
								<div class="main-title-left">
									<span> {{__('Offers')}} </span>
									<h2> {{__('Best Values')}} </h2>
								</div>
							</div>
						</div>
						@foreach ($data['coupon'] as $item)
							<div class="col-lg-4 col-md-6">
								<div class="best-offer-item">
									<img src="{{ $item->imagePath . $item->image }}" alt="">
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- Best Values Offers End -->
		@endif

		@if (count($data['fruits_veg']) >= 1)
			<!-- Vegetables and Fruits Start -->
			<div class="section145">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="main-title-tt">
								<div class="main-title-left">
									<span>{{__('For You')}}</span>
									<h2>{{__('Fresh Vegetables & Fruits')}}</h2>
								</div>
								<a href="{{url('/all-products')}}" class="see-more-btn">{{__('See All')}}</a>
							</div>
						</div>
						<div class="col-md-12">
							<div class="owl-carousel featured-slider owl-theme">
								@foreach ($data['fruits_veg'] as $item)
									<div class="item">
										@include('frontend.model.product')
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Vegetables and Fruits Products End -->
		@endif

		<!-- New Products Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>{{__('For You')}}</span>
								<h2>{{__('Added New Products')}}</h2>
							</div>
							<a href="{{url('/all-products')}}" class="see-more-btn">{{__('See All')}}</a>
						</div>
					</div>
					@if (count($data['new_product']) >= 1)
						<div class="col-md-12">
							<div class="owl-carousel featured-slider owl-theme">
								@foreach ($data['new_product'] as $item)
									<div class="item">
										@include('frontend.model.product')
									</div>
								@endforeach
							</div>
						</div>
					@else
						<div class="col-lg-12 col-md-12">
							<div class="how-order-steps">
								<div class="how-order-icon">
									<i class="uil uil-shopping-basket"></i>
								</div>
								<h4> {{__('No Product Available')}} </h4>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
		<!-- New Products End -->
	</div>
	<!-- Body End -->

@endsection