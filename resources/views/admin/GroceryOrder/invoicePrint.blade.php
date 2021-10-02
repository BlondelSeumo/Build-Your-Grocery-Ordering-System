<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{\App\CompanySetting::find(1)->name}}</title>
        <link href="{{ url('images/upload/'.\App\CompanySetting::find(1)->favicon)}}" rel="icon" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link type="text/css" href="{{url('admin/css/argon.css?v=1.0.0')}}" rel="stylesheet">
        <link href="{{url('admin/css/custom.css')}}" rel="stylesheet">
    </head>
    <body onload="window.print();">
      
            <div class="main-content">
            
                <div class="card form-card shadow" id="printarea">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-12 text-right" >
                                    
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-6"> --}}
                                    {{-- <h3>{{__('Shop Detail')}} </h3> --}}
                                    {{-- <p class="mb-0">{{$data->shop->name}}</p> --}}
                                    {{-- <p class="mb-0">{{$data->shop->address}}</p> --}}
                                    {{-- <p>{{$data->location->name}}</p> --}}
                                {{-- </div> --}}
                                <div class="col-6 text-right">
                                    <h2 style="font-size:32px;margin-right:10px;">{{__("Invoice")}}</h2>
                                </div>
                                <div class="col-12"><hr></div>
                                <div class="col-6 order-left">
                                 
                                    <h3>{{__('Invoice to')}}</h3>
                                    <p class="mb-0">{{$data->customer->name}}</p>
                                    <p>{{$data->customer->email}}</p>
                                    
                                </div>
                                <div class="col-6 text-right order-rigth">
                                    <h3><span>{{__('Order Date :')}} </span>{{$data->created_at->format('Y-m-d')}}</h3>
                                    <h3><span>{{__('Order Status :')}} </span>{{$data->order_status}}</h3>
                                    <h3><span>{{__('Order Id :')}} </span>{{$data->order_no}}</h3>
                                    <h3><span>{{__('Payment Type :')}} </span>{{$data->payment_type}}</h3>
                                    <h3><span>{{__('Payment Status :')}} </span>{{$data->payment_status==0?'Pending' : 'Complete'}}</h3>
                                    @if($data->payment_token!=null)
                                    <h3><span>{{__('Payment ID :')}} </span>{{$data->payment_token}}</h3>
                                    @endif
                                        
                                </div>

                            </div>

                            <div class="item-table table-responsive mt-5">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                       
                                        <tr>
                                            <th scope="col">{{ __('#') }}</th>
                                            <th scope="col">{{ __('Item') }}</th>
                                            <th scope="col">{{ __('Quantity') }}</th>
                                            <th scope="col">{{ __('Price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach ($data->orderItem as $item)
                                        
                                            <tr>
                                                <td>{{$loop->iteration}}</td>                                            
                                                <td>{{ $item->itemName }}</td>                                               
                                                <td>{{ $item->quantity}}</td>
                                                <td>{{ $currency.$item->price.'.00'}}</td>
                                               
                                            </tr> 
                                            <?php $total = $total + $item->price; ?>
                                        @endforeach
                                            
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="table-bottom mt-5 mb-5">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <h3><span>{{__('Items Total :')}} </span>{{$currency.$total.'.00'}}</h3>
                                        <h3><span>{{__('Delivery Charge :')}} </span>{{$currency.$data->delivery_charge.'.00'}}</h3>
                                        <h3><span>{{__('Coupon Discount :')}} </span>{{$currency.$data->coupon_price.'.00'}}</h3>
                                        <h3><span>{{__('Total Payment :')}} </span>{{$currency}}{{$total + $data->shop_charge + $data->delivery_charge  - $data->coupon_price}}.00</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        @stack('js')
    
    </body>
</html>