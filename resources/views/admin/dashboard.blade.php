@extends('admin.master', ['title' => __('DashBoard')])

@section('content')
{{-- @include('admin.layout.topHeader', [
        'title' => __('DashBoard') ,
        'class' => 'col-lg-7'
    ])  --}}

@if(Session::has('success'))
@include('toast',Session::get('success'))
@endif

<div class="header pb-8 pt-5 d-flex pt-lg-8"
    style="background-image: url({{url('admin/images/bg.jpg')}}); background-size: cover; background-position: center center;">
    <span class="mask bg-gradient-default opacity-8"></span>
    <div class="container-fluid">

        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted">{{ __('Shops')}}</h5>
                                    <span class="h2 font-weight-bold">{{$master['shops']}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fas fa-store"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted">{{ __('New users')}}</h5>
                                    <span class="h2 font-weight-bold">{{$master['users']}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted">{{ __('Sales')}}</h5>
                                    <span class="h2 font-weight-bold">{{$currency.$master['sales']}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted">{{ __('Delivery Guys')}}</h5>
                                    <span class="h2 font-weight-bold">{{$master['delivery']}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-delivery-fast"></i>
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

<div class="container-fluid mt--7">
    @if(\App\Setting::find(1)->default_grocery_order_status == "Pending")
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Grocery Order Requests') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{url('GroceryOrder')}}" class="btn btn-sm btn-primary">{{ __('See all') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" id="grocery-pending-order">
                        @if(count($groceryOrders)>0)
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Order ID') }}</th>
                                    <th scope="col">{{ __('Customer') }}</th>
                                    <th scope="col">{{ __('payment') }}</th>
                                    <th scope="col">{{ __('date') }}</th>
                                    <th scope="col">{{ __('Payment GateWay') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groceryOrders as $order)
                                <tr>
                                    <td><span class="badge label label-light-warning">{{ $order->order_no }}</span></td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $currency.$order->payment.'.00'}}</td>
                                    <td>{{ $order->date ." | ".$order->time}}</td>
                                    <td>{{ $order->payment_type}}</td>
                                    <td>
                                        {{-- "{{url('accept-gocery-order/'.$order->id)}}" --}}
                                        <a href="{{url('accept-grocery-order/'.$order->id)}}" class="table-action"
                                            data-toggle="tooltip" data-original-title="Accept Order">
                                            <i class="fas fa-check-square text-success"></i>
                                        </a>
                                        <a href="{{url('reject-grocery-order/'.$order->id)}}" class="table-action"
                                            data-toggle="tooltip" data-original-title="Reject Order">
                                            <i class="fas fa-window-close text-danger"></i>
                                        </a>
                                        
                                        <a href="{{url('viewGroceryOrder/'.$order->id.$order->order_no)}}" class="table-action"
                                            data-toggle="tooltip" data-original-title="View Order">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="empty-state text-center pb-3">
                            <img src="{{url('images/empty3.png')}}" style="width:30%;height:200px;">
                            <h2 class="pt-3 mb-0" style="font-size:25px;">{{__("Nothing!!")}}</h2>
                            <p style="font-weight:600;">{{__("Your Collection list is empty....")}}</p>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-8">
            <div class="card shadow mb-5">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Our Locations') }}</h3>
                            <input type="hidden" id="locations" name="locations" value="{{$locations}}">
                            <input type="hidden" id="shops" name="shops" value="{{$shops}}">
                        </div>

                        <div class="col-4 text-right">
                            {{-- <a href="#" class="btn btn-sm btn-primary">{{ __('See all') }}</a> --}}
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="vector-map" id="locationMap" style="width: 100%; height: 400px"></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Categories') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{url('GroceryCategory')}}" class="btn btn-sm btn-primary">{{ __('See all') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($category)>0)
                        <ul class="list-group list-group-flush list my--3">
                            @foreach ($category as $item)
                            @if($loop->iteration <= 4) <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img class=" avatar-lg round-5" src="{{url('images/upload/'.$item->image)}}">
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0">
                                            <a href="#!">{{$item->name}}</a>
                                        </h4>
                                        <span class="badge badge-dot mr-4">
                                            <i class="{{$item->status==0?'bg-success': 'bg-danger'}}"></i>
                                            <span class="status">{{$item->status==0?'Active': 'Block'}}</span>
                                        </span>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <span class=" label label-light-primary">{{ $item->totalItems.' Items' }}</span>
                                    </div> --}}
                                </div>
                                </li>
                                @endif
                                @endforeach
                
                        </ul>
                        @else
                        <div class="empty-state text-center pb-3">
                            <img src="{{url('images/empty3.png')}}" style="width:60%;height:200px;">
                            <h2 class="pt-3 mb-0" style="font-size:25px;">{{__("Nothing!!")}}</h2>
                            <p style="font-weight:600;">{{__("Your Collection list is empty....")}}</p>
                        </div>
                        @endif
                    </div>
                </div>
        </div>
        <div class="col-8">
            {{-- <div class="card shadow mb-5">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Happy Customers') }}</h3>
        </div>
        <div class="col-4 text-right">
            <a href="{{url('viewUsers')}}" class="btn btn-sm btn-primary">{{ __('See all') }}</a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Total Orders</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <th scope="row"> {{$loop->iteration}} </th>
                <td><img class="avatar avatar-sm mr-3" src="{{url('images/upload/'.$item->image)}}">{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->orders}}</td>
                <td>{{$item->phone}}</td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <i class="{{$item->status==0?'bg-success': 'bg-danger'}}"></i>
                        <span class="status">{{$item->status==0?'Active': 'Block'}}</span>
                    </span>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div> --}}

<div class="card shadow mb-4">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">{{ __('Our Shops') }}</h3>
            </div>
            <div class="col-4 text-right">
                <a href="{{url('GroceryShop')}}" class="btn btn-sm btn-primary">{{ __('See all') }}</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        @if(count($shops)>0)
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Image')}}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Location') }}</th>
                    <th scope="col">{{ __('Radius') }}</th>                  
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shops as $shop)              
                <tr>
                    <th scope="row"> {{$loop->iteration}} </th>
                    <td><img class="avatar-lg round-5" src="{{url('images/upload/'.$shop->image)}}"></td>
                    <td>{{$shop->name}}</td>
                    <td>{{$shop->locationData?$shop->locationData->name:'-'}}</td>
                    <td>
                        {{$shop->radius.'km'}}
                    </td>
                   
                    <td>
                        <span class="badge badge-dot mr-4">
                            <i class="{{$shop->status==0?'bg-success': 'bg-danger'}}"></i>
                            <span class="status">{{$shop->status==0?'Active': 'Deactive'}}</span>
                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{url('GroceryShop/'.$shop->name)}}">{{ __('View') }}</a>
                                <a class="dropdown-item" href="{{url('GroceryShop/'.$shop->id.'/edit')}}">{{ __('Edit') }}</a>
                                <a class="dropdown-item" onclick="deleteData('GroceryShop','{{$shop->id}}');"
                                    href="#">{{ __('Delete') }}</a>
                                {{-- onclick="deleteData('Shop','{{$shop->id}}');" --}}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state text-center pb-3">
            <img src="{{url('images/empty3.png')}}" style="width:40%;height:200px;">
            <h2 class="pt-3 mb-0" style="font-size:25px;">{{__("Nothing!!")}}</h2>
            <p style="font-weight:600;">{{__("Your Collection list is empty....")}}</p>
        </div>
        @endif
    </div>

</div>
</div>
<div class="col-4">
    {{-- items --}}
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">{{ __('Our Items') }}</h3>
                </div>
                <div class="col-4 text-right">
                    <a href="{{url('GroceryItem')}}" class="btn btn-sm btn-primary">{{ __('See all') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(count($items)>0)
            <ul class="list-group list-group-flush list my--3">
                @foreach ($items as $item)
            
                @if($loop->iteration <= 6) <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img class=" avatar-lg round-5" src="{{url('images/upload/'.$item->image)}}">
                        </div>
                        <div class="col ml--2">
                            <h4 class="mb-0">
                                <a href="{{url('Item/'.$item->id)}}">{{$item->name}}</a>
                            </h4>
                            <span class="status">{{$currency.$item->sell_price.'.00'}}</span>
                        </div>
                        <div class="col-auto">
                            {{-- <img src="{{url('images/'.$item_veg.'.png')}}" class="mr-2" height="20px" width="20px"> --}}
                        </div>
                    </div>
                    </li>
                    @endif
                    @endforeach
            </ul>
            @else
            <div class="empty-state text-center pb-3">
                <img src="{{url('images/empty3.png')}}" style="width:60%;height:200px;">
                <h2 class="pt-3 mb-0" style="font-size:25px;">{{__("Nothing!!")}}</h2>
                <p style="font-weight:600;">{{__("Your Collection list is empty....")}}</p>
            </div>
            @endif
        </div>
    </div>
</div>
</div>

</div>

@endsection