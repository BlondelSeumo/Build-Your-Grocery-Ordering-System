@extends('admin.master', ['title' => __('Manage Locations')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Location') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                    <div class="card form-card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Location') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{url('Location/create')}}" class="btn btn-sm btn-primary">{{ __('Add New Location') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            @if(count($locations)>0) 
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('#') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Address') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>    
                                            <th scope="col">{{ __('Popular') }}</th>    
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locations as $location)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $location->name }}</td>
                                                <td>{{ substr($location->address,0,80)}} {{ strlen($location->address) > 80 ? '...' : ""}}</td>
                                                <td>
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="{{$location->status==0?'bg-success': 'bg-danger'}}"></i>
                                                        <span class="status">{{$location->status==0?'Active': 'Deactive'}}</span>
                                                    </span>
                                                </td>
                                                <td>  
                                                    {{$location->popular==1?'Popular': 'Not Popular'}}
                                                </td>
                                                <td>                            
                                                    {{-- <a href="{{url('Location/'.$location->id.'/edit')}}" class="table-action" data-toggle="tooltip" data-original-title="Edit product">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>
                                                    <a href="#" onclick="deleteData('Location','{{$location->id}}');" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete product">
                                                        <i class="fas fa-trash"></i>
                                                    </a> --}}

                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{url('Location/'.$location->id.'/edit')}}">{{ __('Edit') }}</a>
                                                            <a class="dropdown-item" onclick="deleteData('Location','{{$location->id}}');" href="#">{{ __('Delete') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <?php echo $locations->render(); ?>
                            @else 
                                <div class="empty-state text-center pb-3">
                                    <img src="{{url('images/empty3.png')}}" style="width:35%;height:220px;">
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