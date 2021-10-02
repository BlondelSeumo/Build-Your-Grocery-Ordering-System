@extends('frontend.layout.master')
@section('title', __('Orders'))

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
                                    <h4><i class="uil uil-box"></i>{{__('My Orders')}}</h4>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                @foreach ($orders as $order)
                                    <div class="pdpt-bg">
                                        <div class="pdpt-title">
											<h6> {{__("Order Placed : ")}} {{ $order->date. ' '. $order->time }} </h6>
										</div> 
                                        <div class="order-body10">
                                            @php
                                                $ar = array(); 
                                                foreach ($order->orderItem as $item) {
                                                    $push = $item->itemName .' '. $item->unit_qty. $item->unit .' * '. $item->quantity;
                                                    array_push($ar, $push);
                                                }
                                            @endphp
                                            <ul class="order-dtsll">
                                                <li>
                                                    <div class="order-dt-img">
                                                        <img src="{{url('/frontend/images/groceries.svg')}}" alt="">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="order-dt47">
                                                        <h4>{{$company->name}} - {{$order->location->name}}</h4>
                                                        <div class="order-title">{{count($order->orderItem)}} {{__('Items')}} <span data-inverted="" data-tooltip="{{ implode(', ', $ar)}}" data-position="top center">?</span></div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="total-dt">
                                                <div class="total-checkout-group">
                                                    <div class="cart-total-dil">
                                                        <h4>{{__('Sub Total')}}</h4>
                                                        <span>{{$data["currency"] }}{{ $order->payment - $order->delivery_charge - $order->discount}}</span>
                                                    </div>
                                                    @if ($order->discount > 0)
                                                        <div class="cart-total-dil pt-3">
                                                            <h4>{{__("Discount")}}</h4>
                                                            <span>{{$data["currency"] . $order->discount }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($order->delivery_charge > 0)
                                                        <div class="cart-total-dil pt-3">
                                                            <h4>{{__("Delivery Charges")}}</h4>
                                                            <span>{{$data["currency"] . $order->delivery_charge }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="main-total-cart">
                                                    <h2>{{__('Total')}}</h2>
                                                    <span>{{$data["currency"] . $order->payment }}</span>
                                                </div>
                                            </div>
                                            <div class="track-order">
                                                @php
                                                    $status = $order->order_status;
                                                @endphp
                                                @if ($status == "Cancel")
                                                    <h4 class="text-danger">{{__('Order Cancelled')}}</h4>
                                                @else
                                                    <h4>{{__('Track Order')}}</h4>
                                                    <div class="bs-wizard" style="border-bottom:0;">   
                                                        <div class="bs-wizard-step {{ $status == "Pending" || $status == "Approved"  ? 'active':'complete' }}">
                                                            <div class="text-center bs-wizard-stepnum">{{__('Placed')}}</div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        
                                                        <div class="bs-wizard-step {{ $status == "Pending" || $status == "Approved" ? 'disabled':'' }}{{ $status == "OrderReady" || $status == "DriverAtShop" ? 'active':'' }}{{ $status == "OutOfDelivery" || $status == "PickUpGrocery" || $status == "OneTheWay" || $status == "Completed" ? 'complete':''  }}">
                                                            <div class="text-center bs-wizard-stepnum">{{__('Packed')}}</div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        <div class="bs-wizard-step {{ $status == "Pending" || $status == "Approved" || $status == "OrderReady" || $status == "DriverAtShop" ? 'disabled':'' }}{{ $status == "OutOfDelivery" || $status == "PickUpGrocery" || $status == "OneTheWay" ? 'active':''  }}{{ $status == "Completed" ? 'complete':'' }}">
                                                            <div class="text-center bs-wizard-stepnum">{{__('On the way')}}</div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        <div class="bs-wizard-step {{ $status == "Completed" ? 'active':'disabled' }}">
                                                            <div class="text-center bs-wizard-stepnum">{{__('Completed')}}</div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="call-bill">
                                                @if (isset($order->deliveryBoy_id))
                                                    <div class="delivery-man">
                                                        {{__('Delivery Boy')}} - <a href="tel:{{$order->deliveryGuy->phone_code . $order->deliveryGuy->phone}}"><i class="uil uil-phone"></i> {{__('Call Us')}}</a>
                                                    </div>
                                                @endif
                                                <div class="order-bill-slip">
                                                    <a href="{{url('invoice/'.$order->id)}}" target="_blank" class="bill-btn5 hover-btn">{{__('View Invoice')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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