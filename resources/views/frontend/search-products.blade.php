@extends('frontend.layout.master')

@section('title', __('Search Products'))
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
                            <li class="breadcrumb-item active" aria-current="page"> {{__('Search Products')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid">
        <div class="container">
            <div class="product-list-view">
                <div class="contact-title">
                    <h3>{{__('Search result of : ')}} {{$query}}</h3>
                </div>
                <div class="row product-list">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Body End -->
@endsection