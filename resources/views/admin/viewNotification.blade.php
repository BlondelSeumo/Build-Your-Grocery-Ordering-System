@extends('admin.master', ['title' => __('User Management')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Notifications') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                    <div class="card form-card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Notifications') }}</h3>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <a href="{{url('AdminCategory/create')}}" class="btn btn-sm btn-primary">{{ __('Add New Category') }}</a>
                                </div> --}}
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="list-group list-group-flush">       
                                @foreach ($data as $item)
                                    <a href="{{url('viewOrder/'.$item->order_id.$item->userData->order_no)}}" class="list-group-item list-group-item-action">                                    
                                        <div class="row align-items-center">
                                            
                                            <div class="col-auto">   
                                                {{-- @if($item->created_at->isToday()) --}}
                                                <span class="badge badge-dot mr-2">
                                                <i class="{{$item->created_at->isToday()? 'bg-success':'bg-transperent'}}"></i>
                                                    {{-- <span class="status">{{$shop->status==0?'Active': 'Deactive'}}</span> --}}
                                                </span>                          
                                                {{-- @endif                                                            --}}
                                                <img alt="Image placeholder" src="{{url('images/upload/'.$item->userData->image)}}" class="avatar rounded-circle">                                                                        
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{$item->userData->name}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>{{$item->created_at->diffForHumans()}}</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">{{$item->message}}</p>
                                            </div>
                                        </div>                                                                
                                    </a>   
                                @endforeach
                                                          
                            </div>
                        </div>

                    </div>

                  
            </div>
        </div>
       
    </div>

@endsection