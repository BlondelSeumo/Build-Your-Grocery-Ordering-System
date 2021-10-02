@extends('admin.master', ['class' => 'bg-default'])

@section('content')
    @include('layouts.guestHeader') 
    <div class="container mt--9 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-4">
                        
                        <div class="btn-wrapper text-center">
                            <h2 class="text-muted pt-4" style="font-size:22px;">Forget Password</h2>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{url('reset_password')}}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if(Session::has('error_msg'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{Session::get('error_msg')}}</strong>
                                    </span>
                                      
                                @endif
                                @if(Session::has('success_msg'))
                                    <span class="invalid-feedback" style="display: block;color:#5ea23f;" role="alert">
                                        <strong>{{Session::get('success_msg')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control-alternative custom-checkbox">
                                <a href="{{url('login')}}" class="text-light">
                                    <i class="fas fa-arrow-left"></i> <small>{{ __('Back to Login') }}</small>
                                </a>
                            </div>
                          
                            <div class="text-center login-btn">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                      
                    </div>
           
                </div>
            </div>
        </div>
    </div>
@endsection














{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
