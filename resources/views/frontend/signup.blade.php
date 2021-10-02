@extends('frontend.layout.loginMaster')
@section('title', __('Sign-up'))

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
                                    <form action="{{url('/signup')}}" method="post">
                                        @csrf
                                        <div class="form-title"><h6> {{__('Sign Up')}} </h6></div>
                                        <div class="form-group pos_rel">
                                            <input name="name" type="text" placeholder="{{__('Full name')}}" class="form-control lgn_input" required>
                                            <i class="uil uil-user-circle lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input name="email" type="email" placeholder="{{__('Email Address')}}" class="form-control lgn_input" required>
                                            <i class="uil uil-envelope lgn_icon"></i>
                                        </div>
                                        
                                        <div class="form-group pos_rel">
                                            <input name="phone_code" type="text" placeholder="{{__('Phone Code e.g.: +91')}}" class="form-control lgn_input" required>
                                            <i class="uil uil-mobile-android-alt lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input name="phone" type="number" placeholder="{{__('Phone Number')}}" class="form-control lgn_input" required>
                                            <i class="uil uil-mobile-android-alt lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input name="password" type="password" placeholder="{{__('New Password')}}" class="form-control lgn_input" required="">
                                            <i class="uil uil-padlock lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input name="confirm_password" type="password" placeholder="{{__('Confirm Password')}}" class="form-control lgn_input" required="">
                                            <i class="uil uil-padlock lgn_icon"></i>
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
                                        <button class="login-btn hover-btn" type="submit">{{__('Sign Up Now')}}</button>
                                    </form>
                                </div>
                                <div class="signup-link">
                                    <p> {{__('I have an account?')}} - <a href="{{url('/signin')}}"> {{__('Sign In Now')}} </a></p>
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