@extends('admin.master', ['title' => __('User Request')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('User Request') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card form-card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Request') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @if(count($user_req)>0)
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Id') }}</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Subject') }}</th>    
                                        <th scope="col">{{ __('Message') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_req as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td> {{ substr($item->message,0,60)}} {{ strlen($item->message) > 60 ? '...' : ""}}</td>
                                            <td>                            
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" onclick="deleteData('user-request','{{$item->id}}');" href="#">{{ __('Delete') }}</a>
                                                        <a class="dropdown-item"  href="{{url('user-request/'.$item->id)}}">{{ __('View') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <?php echo $user_req->render(); ?>
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