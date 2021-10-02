@extends('admin.master', ['title' => __('User Request')])

@section('content')
     @include('admin.layout.topHeader', [
        'title' => __('View User Request') ,
        'headerData' => __('User Request') ,
        'url' => 'user-request' ,
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0"> {{__('User Request')}} </h5>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="#">
                                <img src="{{url('images/upload/user.png')}}" class="avatar">
                            </a>
                            <div class="mx-3">
                                <a href="#" class="text-dark font-weight-600 text-sm"> {{ $user_req->name }} </a>
                                <small class="d-block text-muted">{{ $user_req->email }}</small>
                            </div>
                        </div>
                        <div class="text-right ml-auto">
                            <div class="btn btn-sm btn-primary btn-icon">
                                @if ($user_req->user_id != null)
                                    {{__('User')}}
                                @else
                                    {{__('Guest')}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="h3"> {{ $user_req->subject}} </h5>
                        <p class="mb-4">
                            {{ $user_req->message }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection