@extends('admin.master', ['title' => __('Manage Banner')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Banner') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card form-card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Banner') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{url('Banner/create')}}" class="btn btn-sm btn-primary">{{ __('Add New Banner') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @if(count($banner)>0)
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Id') }}</th>
                                        <th scope="col">{{ __('Image') }}</th>
                                        <th scope="col">{{ __('Title 1') }}</th>
                                        <th scope="col">{{ __('Title 2') }}</th>
                                        <th scope="col">{{ __('Off') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>    
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banner as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class=" avatar-lg round-5" src="{{url('images/upload/'.$item->image)}}"></td>
                                            <td>{{ $item->title1 }}</td>                                              
                                            <td>{{ $item->title2 }}</td>                                              
                                            <td>{{ $item->off }}</td>                                              
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <i class="{{$item->status==0?'bg-success': 'bg-danger'}}"></i>
                                                    <span class="status">{{$item->status==0?'Active': 'Deactive'}}</span>
                                                </span>
                                            </td>
                                            <td>                            
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{url('Banner/'.$item->id.'/edit')}}">{{ __('Edit') }}</a>
                                                        <a class="dropdown-item " onclick="deleteData('Banner','{{$item->id}}');" href="#">{{ __('Delete') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <?php echo $banner->render(); ?>
                        @else 
                            <div class="empty-state text-center pb-3">
                                <img src="{{url('images/empty3.png')}}" style="width:35%;height:220px;">
                                <h2 class="pt-3 mb-0" style="font-size:25px;">{{__('Nothing!!')}}</h2>
                                <p style="font-weight:600;"> {{__('Your Collection list is empty....')}} </p>
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection