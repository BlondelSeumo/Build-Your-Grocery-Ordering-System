@extends('admin.master', ['title' => __('Orders')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Grocery Orders') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Grocery Orders') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @if(count($orders)>0)
                            <table class="table data-table align-items-center table-flush" >
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('Order ID') }}</th>
                                        <th scope="col">{{ __('Customer') }}</th>
                                        <th scope="col">{{ __('payment') }}</th>
                                        <th scope="col">{{ __('date') }}</th>
                                        <th scope="col">{{ __('Payment GateWay') }}</th>
                                        <th scope="col">{{ __('Order Status') }}</th>
                                        <th scope="col">{{ __('Driver') }}</th>
                                        <th scope="col">{{ __('Payment Status') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $currency.$order->payment.'.00' }}</td>
                                            <td>{{ $order->date.' | '.$order->time }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td class="changeGroceryOrderStatus">
                                                <select id="order-{{$order->id}}" name="order_status" class="form-control" {{$order->order_status=="Cancel" || $order->order_status=="Completed" ? 'disabled':''}}>
                                                    @if ($order->order_status == 'Pending')
                                                        <option value="Pending"{{$order->order_status == 'Pending'?'Selected' : ''}} disabled>Pending</option>
                                                        <option value="Approved"{{$order->order_status == 'Approved'?'Selected' : ''}}>Approved</option>
                                                        <option value="Cancel"{{$order->order_status == 'Cancel'?'Selected' : ''}}>Cancel</option>
                                                    @elseif($order->order_status == 'Approved')
                                                        <option value="Approved"{{$order->order_status == 'Approved'?'Selected' : ''}} disabled>Approved</option>
                                                        <option value="PickUpGrocery"{{$order->order_status == 'PickUpGrocery'?'Selected' : ''}}>Pickup Grocery at Store</option>
                                                        <option value="OutOfDelivery"{{$order->order_status == 'OutOfDelivery'?'Selected' : ''}}>Order is Out Of Delivery</option>
                                                        <option value="Completed"{{$order->order_status == 'Completed'?'Selected' : ''}}>Completed</option>
                                                    @elseif($order->order_status == 'PickUpGrocery')
                                                        <option value="PickUpGrocery"{{$order->order_status == 'PickUpGrocery'?'Selected' : ''}} disabled>Pickup Grocery at Store</option>
                                                        <option value="OutOfDelivery"{{$order->order_status == 'OutOfDelivery'?'Selected' : ''}}>Order is Out Of Delivery</option>
                                                        <option value="Completed"{{$order->order_status == 'Completed'?'Selected' : ''}}>Completed</option>   
                                                    @elseif($order->order_status == 'OutOfDelivery')
                                                        <option value="OutOfDelivery"{{$order->order_status == 'OutOfDelivery'?'Selected' : ''}} disabled>Order is Out Of Delivery</option>
                                                        <option value="Completed"{{$order->order_status == 'Completed'?'Selected' : ''}}>Completed</option>
                                                    @elseif($order->order_status == 'Completed')
                                                        <option value="Completed"{{$order->order_status == 'Completed'?'Selected' : ''}} disabled>Completed</option>
                                                    @elseif($order->order_status == 'Cancel')
                                                        <option value="Cancel"{{$order->order_status == 'Cancel'?'Selected' : ''}} disabled>Cancel</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <select name="order_driver" data-id="{{$order->id}}"  class="form-control select-driver">
                                                    <option value="" {{$order->deliveryBoy_id == null? 'selected':''}}> {{__('Select Driver')}} </option>
                                                    @foreach ($drivers as $item)
                                                        @if ($order->location_id == $item->location)
                                                            <option value="{{$item->id}}" {{$order->deliveryBoy_id == $item->id? 'selected':''}}> {{$item->name}} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            
                                            <td class="changeGroceryOrderPaymentStatus">
                                                <select name="order_payment_status" data-id="{{$order->id}}" id="order1-{{$order->id}}" class="form-control" {{$order->payment_status == 1? 'disabled':''}}>
                                                    @if ($order->payment_status == 0)
                                                        <option value="" {{$order->payment_status == 0? 'selected':''}} disabled> Pending </option>
                                                        <option value="" {{$order->payment_status == 1? 'selected':''}}> Completed </option>
                                                    @else
                                                        <option value="" {{$order->payment_status == 1? 'selected':''}}> Completed </option>
                                                    @endif
                                                </select>
                                               
                                            </td>
                                            <td>
                                                <a href="{{url('viewGroceryOrder/'.$order->id.$order->order_no)}}" class="table-action" data-toggle="tooltip" data-original-title="View Order">
                                                    <i class="fas fa-eye"></i></a>
                                                <a href="{{url('groceryOrderInvoice/'.$order->id.$order->order_no)}}" class="table-action" data-toggle="tooltip" data-original-title="view Invoice">
                                                    <i class="fas fa-file-invoice-dollar"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <?php echo $orders->render(); ?>
                            @else 
                                <div class="empty-state text-center pb-3" style="background: #fff;">
                                    <img src="{{url('images/empty3.png')}}" style="width:35%;height:220px;">
                                    <h2 class="pt-3 mb-0" style="font-size:25px;">{{__('Nothing!!')}}</h2>
                                    <p style="font-weight:600;">{{__('Your Collection list is empty....')}}</p>
                                </div> 
                            @endif
                        </div>
                      
            </div>
        </div>
       
    </div>

@endsection