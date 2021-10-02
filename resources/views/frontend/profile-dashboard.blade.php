@extends('frontend.layout.master')
@section('title', __('Dashboard'))

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
                                    <h4><i class="uil uil-apps"></i> {{__('Overview')}} </h4>
                                </div>
                                <div class="welcome-text">
                                    <h2> {{__('Hi')}}! {{Auth::user()->name}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4>{{__('My Orders')}}</h4>
                                    </div>
                                    @if ($order != null)
                                        <div class="ddsh-body">
                                            <h2>{{__("Recent Order")}}</h2>
                                            <ul class="order-list-145">
                                                @php
                                                    $ar = array(); 
                                                    foreach ($order->orderItem as $item) {
                                                        $push = $item->itemName .' '. $item->unit_qty. $item->unit .' * '. $item->quantity;
                                                        array_push($ar, $push);
                                                    }
                                                @endphp
                                                <li>
                                                    <div class="smll-history">
                                                        <div class="order-title">{{count($order->orderItem)}} {{__('Items')}} <span data-inverted="" data-tooltip="{{ implode(', ', $ar)}}" data-position="top center">?</span></div>
                                                        <div class="order-status">{{$order->order_status}}</div>
                                                        <p>{{ $data['currency'].$order->payment }}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                    <div class="col-lg-12 col-md-12">
                                        <div class="how-order-steps">
                                            <div class="how-order-icon"><i class="uil uil-shopping-basket"></i></div>
                                            <h4>{{__('No Order Found')}}</h4>
                                        </div>
                                    </div>
                                    @endif
                                    <a href="{{url('/profile/orders')}}" class="more-link14">{{__("All Orders")}} <i class="uil uil-angle-double-right"></i></a>
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