@extends('frontend.layout.master')
@section('title', __('My Wishlist'))

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
                            <li class="breadcrumb-item active" aria-current="page"> {{__('Dashboard')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.model.user-dashboard')
    <div class="">
        <div class="container">
            <div class="row">
                @include('frontend.model.user-sidebar')
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-title-tab">
                                    <h4><i class="uil uil-heart"></i> {{__('Shopping Wishlist')}} </h4>
                                </div>
                            </div>								
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="wishlist-body-dtt">
                                        @if (count($data['wishlist']) > 0)
                                            @foreach ($data['wishlist'] as $item)
                                                <div class="cart-item">
                                                    <div class="cart-product-img">
                                                        <img src="{{ $item->groceryItem->imagePath . $item->groceryItem->image }}" alt="">
                                                        <div class="offer-badge">{{$item->groceryItem->off}}% {{__('OFF')}}</div>
                                                    </div>
                                                    <div class="cart-text">
                                                        <h4> {{$item->groceryItem->name}} </h4>
                                                        <div class="cart-item-price"> {{$data['currency']}}{{$item->groceryItem->sell_price}} <span> {{$data['currency']}}{{$item->groceryItem->fake_price}} </span></div>
                                                        <button type="button" class="cart-close-btn" onclick="removeFromWishlist('{{$item->groceryItem->id}}')"><i class="uil uil-trash-alt"></i></button>
                                                    </div>		
                                                </div>
                                            @endforeach
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
                        </div>
                    </div>
                </div>
            </div>	
        </div>	
    </div>	
</div>
<!-- Body End -->

@endsection