@extends('admin.master', ['title' => __('Item Gallery')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Grocery Item Gallery') ,
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card form-card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Grocery Item Gallery') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{url('/GroceryItem/gallery/'.$data->id.'/add')}}" class="btn btn-sm btn-primary">{{ __('Add New Images') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @php
                            $imgs = array();
                            if($data->gallery != "" || $data->gallery != null){
                                $imgs = explode(", ",$data->gallery);
                            }
                        @endphp
                        @if(count($imgs) > 0)
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('Image') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($imgs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class=" avatar-lg rou  nd-5" src="{{url('images/upload/'.$item)}}"></td>
                                            <td>
                                                
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" onclick="deleteItemGallery('{{$item}}','{{$data->id}}')" href="#">{{ __('Delete') }}</a>
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
                                <p style="font-weight:600;">{{__('Your Collection list in empty....')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
