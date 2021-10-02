@extends('admin.master', ['title' => __('Orders')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Orders') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                    <div class="card form-card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Orders') }}</h3>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <a href="{{url('Customer/create')}}" class="btn btn-sm btn-primary">{{ __('Add New user') }}</a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="table-responsive">
                               
                                <?php $shop_charge = 0;$driver_charge = 0;
                                      $total_payment = 0;
                                      $total_shop = 0;
                                     ?>  
                                <?php $s_charge = \App\Setting::find(1)->commission_per; 
                                    //   $d_charge = \App\Setting::find(1)->delivery_charge_per;
                                ?>  

                                <form id="booking-filter" method="post" action="{{url('ownerRevenueFilter')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="select2 form-control p-0" name="shop_id" id="shop_id">
                                                <option value="">Select Shop</option>  
                                                @foreach ($shops as $shop)
                                                    <option value="{{$shop->id}}">{{$shop->name}}</option>
                                                @endforeach                                                                                              
                                            </select> 
                                        </div>
                                        <div class="col-3">
                                            <select class="select2 form-control p-0" name="reportPeriod" id="reportPeriod">
                                                <option value="">Select</option>                                                    
                                                <option value="year">Year</option>
                                                <option value="month">Month</option>
                                                <option value="week">Week</option>
                                                <option value="day">Day</option>
                                            </select> 
                                        </div>
                                        <div class="col-3 filterPeriod">
                                            <input type="text"  class="form-control" id="period_day"   name="period_day"> 
                                            <input type="text" style="display:none;" class="form-control" id="period_week"  name="period_week"> 
                                            <select style="display:none;" class="select2 form-control" id="period_month"  name="period_month"> 
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">Augest</option>
                                                <option value="09">Spetember</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <input type="number" style="display:none;" class="form-control" id="period_year"  name="period_year"> 
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-primary" type="submit">{{__('Apply')}}</button>
                                        </div>
                                        {{-- onclick="getfilter();" --}}
                                    </div>
                                </form>

                                <table class="table data-table align-items-center table-flush" id="reports">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('#') }}</th>
                                            <th scope="col">{{ __('Order ID') }}</th>
                                            <th scope="col">{{ __('Customer') }}</th>
                                            <th scope="col">{{ __('Shop Name') }}</th>
                                            <th scope="col">{{ __('Date') }}</th>
                                            <th scope="col">{{ __('Payment') }}</th>
                                            <th scope="col">{{ __('Shop Charge') }}</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <?php $earning = $item->payment - ($item->payment*$s_charge/100); ?>
                                            <?php $total_payment = $total_payment + $item->payment; ?>
                                            <?php $total_shop = $total_shop + ($item->payment*$s_charge/100); ?>
                                            
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$item->order_no}}</td>
                                                <td>{{ $item->customer->name }}</td>
                                                <td>{{ $item->shop_name }}</td>
                                                <td>{{$item->date}} </td>
                                                <td>{{ $currency.$item->payment }}</td>
                                                <td>{{ $currency.$item->payment*$s_charge/100 }}</td>
                                            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <thead class="footer-head">
                                        <tr >
                                            <th></th> 
                                            <th></th>
                                            <th></th>                                        
                                            <th></th>
                                            <th>{{__('Total Income')}} </th>
                                            <th>{{$currency.$total_payment}}</th>
                                            <th>{{$currency.$total_shop}}</th>
                                            
                                        </tr>
                                    </thead>
                                </table>
                                                      
                            </div>
                    </div>
            </div>
        </div>
       
    </div>

@endsection