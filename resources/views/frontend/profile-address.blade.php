@extends('frontend.layout.master')
@section('title', __('Addresses'))

@section('content')

<!-- Body Start -->
<div class="wrapper">
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"> {{__('Home')}} </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{__('Dashboard')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.model.user-dashboard')
    <div class="">
        <div class="container">
            <div class="row">
                @include('frontend.model.user-sidebar')
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-title-tab">
                                    <h4><i class="uil uil-location-point"></i> {{__('My Address')}} </h4>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4>{{__('My Address')}} </h4>
                                    </div>
                                    <div class="address-body">
                                        <a href="#" class="add-address hover-btn" data-toggle="modal" data-target="#address_model"> {{__('Add New Address')}} </a>
                                        @foreach ($data as $item)
                                            <div class="address-item">
                                                <div class="address-icon1">
                                                    <i class="uil uil-home-alt"></i>
                                                </div>
                                                <div class="address-dt-all">
                                                    <h4> {{$item->address_type}} </h4>
                                                    <p> {{$item->soc_name}}, {{$item->street}}, {{$item->city}}, {{$item->zipcode}} </p>
                                                    <ul class="action-btns">
                                                        <li><a class="action-btn edit-address-btn" data-toggle="modal" data-target="#address_edit_model" onclick="edit_address('{{$item->id}}')"> <i class="uil uil-edit"></i></a></li>
                                                        <li><a class="action-btn" onclick="delete_address('{{$item->id}}')"><i class="uil uil-trash-alt"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
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
<!-- Body End -->
@include('frontend.model.address-add')
@include('frontend.model.address-edit')
@endsection