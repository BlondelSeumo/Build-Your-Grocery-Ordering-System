@extends('frontend.layout.master')
@section('title', __('Change Password'))

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
                                    <h4><i class="uil uil-padlock"></i> {{__('Change Password')}} </h4>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4> {{__('Edit Profile')}} </h4>
                                    </div>
                                    <form action="{{url('/profile/change-password')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="add-cash-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Current Password')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="password" name="current_password" value="" required="" placeholder="{{__('Current Password')}}">
                                                            </div>
                                                        </div>
                                                        @error('current_password')
                                                            <div class="text-danger ml-2 mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('New Password')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="password" name="new_password" value="" required="" placeholder="{{__('New Password')}}">
                                                            </div>
                                                        </div>
                                                        @error('new_password')
                                                            <div class="text-danger ml-2 mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Confirm New Password')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="password" name="confirm_password" value="" required="" placeholder="{{__('Confirm New Password')}}">
                                                            </div>
                                                        </div>
                                                        @error('confirm_password')
                                                            <div class="text-danger ml-2 mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="next-btn16 hover-btn mt-3"> {{__('Save Changes')}} </button>
                                        </div>
                                    </form>
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

@endsection