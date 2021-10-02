@extends('frontend.layout.master')
@section('title', $product->name)

@section('content')

<!-- Body Start -->
<div class="wrapper">
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"> {{__('Home')}} </a></li>
                            <li class="breadcrumb-item"><a href="{{url('/all-categories')}}"> {{__('Categories')}} </a></li>
                            <li class="breadcrumb-item"><a href="{{url('category/'.$data['category']->id.'/'.Str::slug($data['category']->name))}}"> {{$data['category']['name']}} </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{$product->name}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-dt-view">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                @php
                                    $imgs = null;
                                    if($product->gallery != "" || $product->gallery != null){
                                        $imgs = explode(", ",$product->gallery);
                                    }
                                @endphp
                                <div id="sync1" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="{{$product->imagePath . $product->image}}" alt="">
                                    </div>
                                    @if ($imgs != null)
                                        @foreach ($imgs as $item)
                                            <div class="item">
                                                <img src="{{$product->imagePath . $item}}" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div id="sync2" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="{{$product->imagePath . $product->image}}" alt="">
                                    </div>
                                    @if ($imgs != null)
                                        @foreach ($imgs as $item)
                                            <div class="item">
                                                <img src="{{$product->imagePath . $item}}" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
                            <div class="col-lg-8 col-md-8">
                                <div class="product-dt-right">
                                    <h2> {{$product->name}} </h2>
                                    <div class="no-stock">
                                        @if ($product->stock <= 0)
                                            <p class="stock-qty">{{__('Not Available')}}<span>{{__('(Out Of Stock)')}}</span></p>
                                        @else
                                            <p class="stock-qty">{{__('Available')}}<span>{{__('(Instock)')}}</span></p>
                                        @endif
                                    </div>
                                    <div class="product-radio">
                                        <ul class="product-now">
                                            @foreach (json_decode($product->detail) as $key => $item)
                                                <li>
                                                    <input type="radio" id="{{$key}}" name="detail" class="item-detail" {{ $key == 0? 'checked':'' }}>
                                                    <label for="{{$key}}"> {{$item->qty}}{{$item->unit}} </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <p class="pp-descp">
                                        {{$product->description}}
                                    </p>
                                    <div class="product-group-dt">
                                        <ul id="product-price">
                                            <li class="li-sell-price"><div class="main-price color-discount"> {{__('Discount Price')}} <span id="price"> {{$data['currency']}}<span class="product-sell_price">{{$product->sell_price}}</span></span></div></li>
                                            <li class="li-fake-price"><div class="main-price mrp-price"> {{__('MRP Price')}} <span id="fake_price"> {{$data['currency']}}<span class="product-fake_price">{{$product->fake_price}}</span> </span></div></li>
                                        </ul>
                                        <ul class="gty-wish-share">
                                            <li>
                                                <div class="qty-product">
                                                    <div class="quantity buttons_added">
                                                        <input type="hidden" value="0" name="item-index-id" class="item-index-id">
                                                        <input type="button" value="-" class="minus minus-btn">
                                                        <input type="number" step="1" name="quantity" min="1" value="{{$product->qtyCount}}" class="input-text item-qty qty text qtyOf-{{$product->id}}">
                                                        <input type="button" value="+" class="plus plus-btn">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="like-icon save-icon like-{{$product->id}} {{ $product->isWishlist == 1? 'liked':'' }}" data-id="{{$product->id}}" title="wishlist"></span>
                                            </li>
                                        </ul>
                                        <ul class="ordr-crt-share">
                                            <input type="hidden" id="addcart-lang" value="{{__('Remove from Cart')}}">
                                            <input type="hidden" id="removecart-lang" value="{{__('Add to Cart')}}">
                                            <li>
                                                <button class="add-cart-btn single-page-product add-to-cart hover-btn {{$product['isCart'] == 1? 'remove-cart':'add-cart'}} " data-id="{{$product->id}}">
                                                    <i class="uil uil-shopping-cart-alt"></i>
                                                    <span class="text-cart"> {{$product['isCart'] == 1? __('Remove from Cart'):__('Add to Cart')}} </span>
                                                </button>
                                            </li>
                                            @if (Auth::check())
                                                @php $url = url('/checkout') @endphp
                                            @else
                                                @php $url = url('/signin') @endphp
                                            @endif
                                            <li><button onclick="location.href =  '{{$url}}';" class="order-btn hover-btn"> {{__('Order Now')}} </button></li>
                                        </ul>
                                    </div>
                                    <div class="pdp-details">
                                        <ul>
                                            <li>
                                                <div class="pdp-group-dt">
                                                    <div class="pdp-icon"><i class="uil uil-usd-circle"></i></div>
                                                    <div class="pdp-text-dt">
                                                        <span> {{__('Lowest Price Guaranteed')}} </span>
                                                        <p> {{__('Get difference refunded if you find it cheaper anywhere else.')}} </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="pdp-group-dt">
                                                    <div class="pdp-icon"><i class="uil uil-cloud-redo"></i></div>
                                                    <div class="pdp-text-dt">
                                                        <span> {{__('Easy Returns & Refunds')}} </span>
                                                        <p> {{__('Return products at doorstep and get refund in seconds.')}} </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="pdpt-bg">
                        <div class="pdpt-title">
                            <h4> {{__('More Like This')}} </h4>
                        </div>
                        <div class="pdpt-body scrollstyle_4">
                            @if (count($data['like_this']) > 0)
                                @foreach ($data['like_this'] as $item)
                                    <div class="cart-item border_radius">
                                        <a href="{{url('product/'.$item->id .'/'.Str::slug($item->name))}}" class="cart-product-img">
                                            <img src="{{ $item->imagePath . $item->image }}" alt="">
                                            <div class="offer-badge">{{$item->off}}% {{__('OFF')}}</div>
                                        </a>
                                        <div class="cart-text">
                                            <h4> {{$item->name}} </h4>
                                           
                                            <div class="product-price text-left">
                                                {{$data['currency']}}<span class="sell_price">{{$item->sell_price}}</span>
                                                <span class="line-through">{{$data['currency']}}<span class="fake_price">{{$item->fake_price}}</span></span>
                                            </div>
                                            <div class="qty-group">
                                                <div class="quantity buttons_added">
                                                    <input type="button" value="-" class="minus minus-btn">
                                                    <input type="number" step="1" name="quantity" min="1" value="{{$item['qtyCount']}}" class="input-text qty text qtyOf-{{$item['id']}}">
                                                    <input type="button" value="+" class="plus plus-btn">
                                                </div>
												<span class="cart-icon single-page add-to-cart cart-{{$item['id']}} {{$item['isCart'] == 1? 'pri-color':''}}" data-id="{{$item['id']}}"><i class="uil uil-shopping-cart-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="how-order-steps">
                                    <div class="how-order-icon">
                                        <i class="uil uil-shopping-basket"></i>
                                    </div>
                                    <h4> {{__('No Product Available')}} </h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="pdpt-bg">
                        <div class="pdpt-title">
                            <h4> {{__('Product Details')}} </h4>
                        </div>
                        {!! html_entity_decode($product->detail_desc) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Products Start -->
    <div class="section145">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title-tt">
                        <div class="main-title-left">
                            <span>{{__('For You')}}</span>
                            <h2>{{__('Top Featured Products')}}</h2>
                        </div>
                        <a href="{{url('/featured-products')}}" class="see-more-btn">{{__('See All')}}</a>
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
</div>
<!-- Body End -->

@endsection