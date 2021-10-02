@extends('admin.master', ['title' => __('Owner Profile')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Owner Profile'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{url('images/upload/'.Auth::user()->image)}}" style="height:180px;width:180px;border: 5px solid #fff;" class="rounded-circle view-image">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        {{-- <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                        </div> --}}
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">{{$master['shops']}}</span>
                                        <span class="description">{{ __('Shops') }}</span>
                                    </div>
                                   
                                    <div>
                                        <span class="heading">{{$master['users']}}</span>
                                        <span class="description">{{ __('Customers') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{Auth::user()->name}} 
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i> {{Auth::user()->email}} 
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Shop Owner - Gambo') }}
                            </div>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('editOwnerProfile')}}" autocomplete="off"  enctype="multipart/form-data">
                            @csrf
                          
                            <h6 class="heading-small text-muted mb-4">{{ __('Owner information') }}</h6>
                            
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{Auth::user()->name}}"  required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{Auth::user()->email}}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                        <div class="custom-file">
                                            <input type="file"  accept=".png, .jpg, .jpeg, .svg" class="custom-file-input read-image" name="image" id="image" >
                                            <label class="custom-file-label" for="image">Select file</label>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Language') }}</label>
                                    <select name="language" class="form-control form-control-alternative{{ $errors->has('language') ? ' is-invalid' : '' }}" required >
                                        <option value=""> {{__('Select Language')}} </option>
                                        @foreach ($master['language'] as $language)
                                            <option value="{{$language->name}}" {{ Auth::user()->language === $language->name ? 'Selected' : ''}}>{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('language'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('language') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4"/>
                        <form method="post" action="{{url('changeOwnerPassword')}}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Change Password') }}</h6>

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}"required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                    @if(Session::has('error_msg'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{Session::get('error_msg')}}</strong>
                                        </span>  
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}"  required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm New Password') }}" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change Password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
@endsection