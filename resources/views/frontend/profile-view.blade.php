@extends('frontend.layout.master')
@section('title', __('Profile'))

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
                                    <h4><i class="uil uil-user"></i> {{__('Profile')}} </h4>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4> {{__('Edit Profile')}} </h4>
                                    </div>
                                    <form action="{{url('/profile/update')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="add-cash-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Name')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="text" name="name" value="{{old('name', Auth::user()->name)}}" required="" placeholder="Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Email')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="email" name="email" value="{{old('email', Auth::user()->email)}}" required="" placeholder="Email" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Phone Code')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="text" name="phone_code" value="{{old('phone_code', Auth::user()->phone_code)}}" required="" placeholder="Phone code">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Phone number')}}*</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="text" name="phone" value="{{old('phone', Auth::user()->phone)}}" required="" placeholder="Phone">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Date of birth')}}</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="date" name="dateOfBirth" value="{{old('dateOfBirth', Auth::user()->dateOfBirth)}}" required="" placeholder="Date of birth">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Profile Photo')}}</label>
                                                        <div class="ui search focus">
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="file" name="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group mt-1">
                                                        <label class="control-label">{{__('Language')}}</label>
														<select class="ui fluid search dropdown form-dropdown" name="language">
                                                            @foreach ($data['language'] as $language)
															    <option value="{{$language->name}}" {{Auth::user()->language === $language->name ? 'selected':''}}> {{$language->name}} </option>
                                                            @endforeach
														</select>	
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