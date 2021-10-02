@extends('frontend.layout.master')
@php
    $curr_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
@endphp

@if ($curr_url == url('/all-products'))
    @section('title', __('All Products'))
@else
    @section('title', __('Featured Products'))
@endif
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
                            @if ($curr_url == url('/all-products'))
                                <li class="breadcrumb-item active" aria-current="page"> {{__('All Products')}} </li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page"> {{__('Featured Products')}} </li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid">
        <div class="container">
            <div class="row">
                @if($default_cat != null)
                    <div class="col-lg-12">
                        <div class="product-top-dt">
                            <div class="product-left-title">
                                <h2 class="cat_name"> {{$default_cat->name}} </h2>
                            </div>
                            <div class="product-sort">
                                <div class="ui selection dropdown vchrt-dropdown">
                                    <input name="sort" type="hidden" value="new" id="sort" class="filter-data">
                                    <i class="dropdown icon d-icon"></i>
                                    <div class="text">{{__('New Arrival')}}</div>
                                    <div class="menu">
                                        <div class="item" data-value="new">{{__('New Arrival')}}</div>
                                        <div class="item" data-value="price-asc"> {{__('Price - Low to High')}} </div>
                                        <div class="item" data-value="price-desc"> {{__('Price - High to Low')}} </div>
                                        <div class="item" data-value="alphabetical"> {{__('Alphabetical')}} </div>
                                        <div class="item" data-value="off-desc"> {{__('Saving - High to Low')}} </div>
                                        <div class="item" data-value="off-asc"> {{__('Saving - Low to High')}} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-sort">
                                <div class="ui selection dropdown vchrt-dropdown">
                                    <input name="category" type="hidden" value="{{$default_cat->id}}" id="category" class="filter-data">
                                    <i class="dropdown icon d-icon"></i>
                                    <div class="text"> {{$default_cat->name}} </div>
                                    <div class="menu">
                                        @foreach ($data['category'] as $item)
                                            <div class="item" data-value="{{$item->id}}"> {{$item->name}} </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
            <div class="product-list-view">
                <input type="hidden" id="no-product" value="{{__('No Product Available')}}">
                <div class="row product-list">
                    @if (isset($data['products']))
                        @if (count($data['products']) > 0)
                            @include('frontend.model.product2')
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
                    @endif
                </div>
                @if (isset($data['products']))
                    @if ($data['products']->currentPage() != $data['products']->lastPage())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="more-product-btn">
                                    <button class="show-more-btn hover-btn" id="load-more"> {{__('Show More')}} </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Body End -->
@endsection