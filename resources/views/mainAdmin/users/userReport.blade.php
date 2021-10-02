@extends('admin.master', ['title' => __('Users')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Users') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                    <div class="card form-card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Users') }}</h3>
                                </div>
                              
                            </div>
                        </div>

                        <div class="table-responsive">
                           
                            {{-- <form id="booking-filter" method="post" action="{{url('usersFilter')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <select class="select2 form-control p-0" name="role" id="role">
                                            <option value="">Select Role</option>  
                                            <option value="1">Shop Owners</option>                                                    
                                            <option value="0">Customers</option>  
                                            <option value="2">Drivers</option>  
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
                                            <option value="">Select Month</option>
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
                                        <button class="btn btn-primary" type="submit">Apply</button>
                                    </div>
                                    
                                </div>
                            </form>                                --}}
                                <table class="table data-table align-items-center table-flush" id="reports">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('#') }}</th>
                                            <th scope="col">{{ __('Image') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Email') }}</th>
                                            <th scope="col">{{ __('Phone') }}</th>                                            
                                            <th scope="col">{{ __('Status') }}</th>                                             
                                            <th scope="col">{{ __('Registered at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img class="avatar avatar-lg" src="{{url('images/upload/'.$user->image)}}"></td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                </td>
                                                <td>{{ $user->phone }}</td>                                                
                                                <td>
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="{{$user->status==0?'bg-success': 'bg-danger'}}"></i>
                                                        <span class="status">{{$user->status==0?'Active': 'Block'}}</span>
                                                    </span>
                                                </td>                                               
                                                {{-- <td>{{$user->created_at->diffForHumans()}}</td> --}}
                                                <td>{{$user->created_at->format('Y-m-d')}}</td> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                                   
                            </div>
                    </div>
            </div>
        </div>
       
    </div>

@endsection