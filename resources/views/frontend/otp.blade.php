@extends('frontend.layout.loginMaster')
@section('title', __('Verify-OTP'))

@section('content')
@php
    $company = \App\CompanySetting::first(['logo','name','logo_dark']);
@endphp
    <div class="sign-inup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <div class="sign-logo" id="logo">
                                <a href="{{ url('/') }}"><img src="{{ url('images/upload/'.$company->logo) }}" alt=""></a>
                                <a href="{{ url('/') }}"><img class="logo-inverse" src="{{ url('images/upload/'.$company->logo_dark) }}" alt=""></a>
                            </div>
                            <div class="form-dt">
                                <div class="form-inpts checout-address-step">
                                    <form action="{{url('/check-otp')}}" method="post">
                                        @csrf
                                        <div class="form-title"><h6>{{__('Verify-OTP')}}</h6></div>
                                        <div class="form-group pos_rel">
                                            <input id="otp" name="otp" type="text" placeholder="{{__('Enter OTP')}}" class="form-control lgn_input">
                                            <i class="uil uil-mobile-android-alt lgn_icon"></i>
                                        </div>
                                        @if($errors->any())
                                            <h4 class="text-center text-danger">{{$errors->first()}}</h4>
                                        @endif
                                        @if ($message = Session::get('error'))
                                            <h4 class="text-center text-danger">{{$message}}</h4>
                                        @endif
                                        @if ($message = Session::get('msg'))
                                            <h4 class="text-center text-success">{{$message}}</h4>
                                        @endif
                                        <button class="login-btn hover-btn" type="submit">{{__('Verify OTP')}}</button>
                                    </form>
                                </div>
                                <div class="password-forgor mb-5">
                                    <a href="{{url('/')}}">{{__('Back to home')}}?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright-text text-center mt-4">
                        <i class="uil uil-copyright"></i> {{__('Copyright')}} @php echo date('Y'); @endphp <b > {{$company->name}} </b>. {{__('All rights reserved')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection