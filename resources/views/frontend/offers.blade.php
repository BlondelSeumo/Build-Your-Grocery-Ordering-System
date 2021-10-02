@extends('frontend.layout.master')
@section('title', __('Offers'))

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
                            <li class="breadcrumb-item active" aria-current="page">{{__('Offers')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid mb-14">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="default-title mt-4">
                        <h2> {{__('Offers')}} </h2>
                        <img src="{{url('/frontend/images/line.svg')}}" alt="">
                    </div>
                </div>
                @if (count($coupons) > 0)
                    @foreach ($coupons as $item)
                        <div class="col-lg-4">
                            <div class="offers-item">
                                <div class="offer-img">
                                    <img src="{{$item->imagePath . $item->image}}" alt="">
                                </div>
                                <div class="offers-text">
                                    <h4>📢 {{$item->name}}</h4>
                                    <h5>{{$item->code}}</h5>
                                    <p>{{$item->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="how-order-steps">
                            <div class="how-order-icon">
                                <i class="uil uil-gift"></i>
                            </div>
                            <h4> {{__('No Offers Available')}} </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>	
</div>
<!-- Body End -->

@endsection