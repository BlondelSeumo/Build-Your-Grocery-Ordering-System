@extends('admin.master', ['title' => __('Manage Coupon')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Grocery Coupon') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                <div class="card form-card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Grocery Coupon') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{url('GroceryCoupon/create')}}" class="btn btn-sm btn-primary">{{ __('Add New Coupon') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @if(count($coupons)>0) 
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>                                          
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Code') }}</th>    
                                        <th scope="col">{{ __('Location') }}</th>                                           
                                        <th scope="col">{{ __('Discount') }}</th>
                                        <th scope="col">{{ __('Maximum Usage') }}</th>
                                        <th scope="col">{{ __('already Use') }}</th>    
                                        <th scope="col">{{ __('Duration') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>                                               
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead> 
                                <tbody>  
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $coupon->name}}</td>
                                            <td>{{ $coupon->code }}</td> 
                                            <td>{{ $coupon->location->name }}</td>                                                 
                                            <td>{{ $coupon->type=="amount"? $currency :''}}{{$coupon->discount}}{{$coupon->type=="percentage"? '%' :''}}</td>
                                            <td>{{ $coupon->max_use.' times' }}</td>
                                            <td>{{ $coupon->use_count.' times' }}</td>
                                            <td>{{ $coupon->start_date.' to '.$coupon->end_date }}</td>                                            
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <i class="{{$coupon->status==0?'bg-success': 'bg-danger'}}"></i>
                                                    <span class="status">{{$coupon->status==0?'Active': 'Deactive'}}</span>
                                                </span>
                                            </td>
                                            <td>                                                                        
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{url('GroceryCoupon/'.$coupon->code.'/edit')}}">{{ __('Edit') }}</a>
                                                        <a class="dropdown-item" onclick="deleteData('GroceryCoupon','{{$coupon->id}}');" href="#">{{ __('Delete') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else 
                            <div class="empty-state text-center pb-3">
                                <img src="{{url('images/empty3.png')}}" style="width:35%;height:220px;">
                                <h2 class="pt-3 mb-0" style="font-size:25px;">{{__('Nothing!!')}}</h2>
                                <p style="font-weight:600;">{{__('Your Collection list is empty....')}}</p>
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection