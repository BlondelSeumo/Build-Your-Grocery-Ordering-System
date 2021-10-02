@extends('frontend.layout.loginMaster')
@section('title', __('Forgot Password'))

@section('content')
@php
    $company = \App\CompanySetting::first(['logo','phone','logo_dark']);
@endphp
<div class="sign-inup">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="sign-form">
                    <div class="sign-inner">
                        <div class="sign-logo" id="logo">
                            <a href="{{ url('/') }}"><img src="{{ url('images/upload/'.$company->responsive_logo) }}" alt=""></a>
                            <a href="{{ url('/') }}"><img class="logo-inverse" src="{{ url('images/upload/'.$company->logo_dark) }}" alt=""></a>
                        </div>
                        <div class="form-dt">
                            <div class="form-inpts checout-address-step">
                                <form action="forgot-password" method="POST">
                                    @csrf
                                    <div class="form-title"><h6> {{__('Get New Password')}} </h6></div>
                                    <div class="form-group pos_rel">
                                        <input id="email" name="email" type="email" placeholder="{{__('Your Email Address')}}" class="form-control lgn_input" required="">
                                        <i class="uil uil-envelope lgn_icon"></i>
                                    </div>
                                    <button class="login-btn hover-btn" type="submit"> {{__("Submit")}} </button>
                                </form>
                                @if ($message = Session::get('error_msg'))
                                    <h4 class="text-center text-danger">{{$message}}</h4>
                                @endif
                                @if ($message = Session::get('success_msg'))
                                    <h4 class="text-center text-success">{{$message}}</h4>
                                @endif
                            </div>
                            <div class="signup-link">
                                <p>{{__('Go Back')}} - <a href="{{url('/signin')}}">{{__('Sign In Now')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-text text-center mt-3">
                    <i class="uil uil-copyright"></i> {{__('Copyright')}} @php echo date('Y'); @endphp <b > {{$company->name}} </b>. {{__('All rights reserved')}}
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection