@extends('admin.master', ['title' => __('Settings')])

@section('content_setting')
    @include('admin.layout.topHeader', [
        'title' => __('Settings') ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row settings">
            <div class="col">
                    <div class="card bg-secondary form-card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Settings') }}</h3>
                                </div>                            
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-3" style="border-right: 1px solid #ddd;">
                                    <?php $status = \App\Setting::find(1)->license_status;  ?>
                                    <ul class="nav nav-tabs tabs-left sideways border-0">  
                                        <li><a href="#general-v" class="{{ $status==1?'active':'event-none'}} " data-toggle="tab"> <i class="ni ni-settings-gear-65 mr-2"></i>{{ __("General") }}</a></li>
                                        <li><a href="#payment-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="far fa-credit-card mr-2"></i>{{ __("Payment Gateway") }}</a></li>
                                        <li><a href="#language-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="fas fa-language mr-2"></i>{{ __("Language Setting") }}</a></li>
                                        <li><a href="#verification-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="fas fa-user-check mr-2"></i>{{ __("User Verification") }}</a></li>
                                        <li><a href="#notification-va" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="far fa-bell mr-2"></i>{{ __("Push Notification") }}</a></li>
                                        <li><a href="#mail-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="far fa-envelope mr-2"></i>{{ __("Mail") }}</a></li>
                                        <li><a href="#sms-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="far fa-comments mr-2"></i>{{ __("SMS Gateway") }}</a></li>
                                        <li><a href="#map-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="far fa-map  mr-2"></i>{{ __("Map Setting") }}</a></li>
                                        <li><a href="#additional-v" class="{{ $status==0?'event-none':''}}" data-toggle="tab"><i class="ni ni-settings mr-2"></i>{{ __("Additional setting") }}</a></li> 
                                    </ul>
                                </div>
                                <div class="col-9">
                                    <div class="tab-content">
                                        <div class="tab-pane {{ $status==1?'active':''}}" id="general-v">
                                                <form method="post" id="company-setting-form" action="{{url('adminSetting/'.$companyData->id)}}" autocomplete="off"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <h6 class="heading-small text-muted mb-4">{{ __("Company's General Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group row{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="name" id="input-name"
                                                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Name') }}" value="{{ $companyData->name }}" required>
                                                                @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('address') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="address" id="input-address"
                                                                    class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Address') }}" value="{{ $companyData->address }}" required>
                                                                @if ($errors->has('address'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('address') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="phone" id="input-phone"
                                                                    class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Phone') }}" value="{{ $companyData->phone }}" required>
                                                                @if ($errors->has('phone'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-group row{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="email" name="email" id="input-email"
                                                                    class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Email ID') }}" value="{{ $companyData->email }}" required>
                                                                @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('website') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-website">{{ __('Website') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="website" id="input-website"
                                                                    class="form-control form-control-alternative{{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Website') }}" value="{{ $companyData->website }}">
                                                                @if ($errors->has('website'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('website') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-3"></div>
                                                            <div class="col-9">
                                                                <img src="{{url('images/upload/'.$companyData->logo)}}" id="setting-logo"
                                                                    style="width:160px;height:60px;margin-bottom:15px;border-radius:5px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('logo') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-logo">{{ __('Logo') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"  accept=".png, .jpg, .jpeg, .svg" name="logo" id="logo">
                                                                    <label class="custom-file-label" for="logo">Select file</label>
                                                                </div>
                                                                @if ($errors->has('imaglogoe'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-3"></div>
                                                            <div class="col-9">
                                                                <img src="{{url('images/upload/'.$companyData->logo_dark)}}" id="setting-logo_dark"
                                                                    style="width:160px;height:60px;margin-bottom:15px;border-radius:5px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('logo_dark') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-logo">{{ __('Dark Logo') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"  accept=".png, .jpg, .jpeg, .svg" name="logo_dark" id="logo_dark">
                                                                    <label class="custom-file-label" for="logo_dark">Select file</label>
                                                                </div>
                                                                @if ($errors->has('logo_dark'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('logo_dark') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-3"></div>
                                                            <div class="col-9">
                                                                <img src="{{url('images/upload/'.$companyData->responsive_logo)}}" id="setting-responsive_logo"
                                                                    style="width:160px;height:60px;margin-bottom:15px;border-radius:5px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('responsive_logo') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-responsive_logo">{{ __('Responsive Logo') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"  accept=".png, .jpg, .jpeg, .svg" name="responsive_logo" id="responsive_logo">
                                                                    <label class="custom-file-label" for="responsive_logo">Select file</label>
                                                                </div>
                                                                @if ($errors->has('responsive_logo'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('responsive_logo') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-3"></div>
                                                            <div class="col-9">
                                                                <img src="{{url('images/upload/'.$companyData->favicon)}}" id="setting-favicon"
                                                                    style="width:90px;height:90px;margin-bottom:15px;border-radius:5px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row{{ $errors->has('favicon') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-favicon">{{ __('Favicon Icon') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"  accept=".png, .jpg, .jpeg, .svg" name="favicon" id="favicon">
                                                                    <label class="custom-file-label" for="favicon">Select file</label>
                                                                </div>
                                                                @if ($errors->has('favicon'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('favicon') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row {{ $errors->has('description') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea name="description" id="input-description"
                                                                    class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Description') }}">{{$companyData->description}}</textarea>
                                                                @if ($errors->has('description'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('description') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>                                                                                    
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>                                          
                                            </div>
                                            <div class="tab-pane" id="payment-v">
                                                <form method="post" action="{{url('savePaymentSetting')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 class="heading-small text-muted mb-4">{{ __("Payment Gateway Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group{{ $errors->has('cod') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-4"> <label
                                                                        class="form-control-label">{{ __('COD (Cash on delivery Payment)') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->cod == 1?'checked':''}} name="cod"
                                                                            id="cod">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('whatsapp') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-4"> <label
                                                                        class="form-control-label">{{ __('Whatsapp') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->whatsapp == 1?'checked':''}} name="whatsapp"
                                                                            id="whatsapp">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('stripe') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-4"> <label
                                                                        class="form-control-label">{{ __('Stripe (Online Payment with Stripe)') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->stripe == 1?'checked':''}} name="stripe"
                                                                            id="stripe">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('paypal') ? ' has-danger' : '' }}">
                                                            <div class="row ">
                                                                <div class="col-4"> <label
                                                                        class="form-control-label">{{ __('Paypal (Paypal Express Checkout)') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->paypal == 1?'checked':''}} name="paypal"
                                                                            id="paypal">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('razor') ? ' has-danger' : '' }}">
                                                            <div class="row pb-1">
                                                                <div class="col-4"> <label class="form-control-label">{{ __('RazorPay') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->razor == 1?'checked':''}} name="razor"
                                                                            id="razor">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('flutterwave') ? ' has-danger' : '' }}">
                                                            <div class="row ">
                                                                <div class="col-4"> <label
                                                                        class="form-control-label">{{ __('Flutterwave') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->flutterwave == 1?'checked':''}} name="flutterwave"
                                                                            id="flutterwave">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('paystack') ? ' has-danger' : '' }}">
                                                            <div class="row" style="border-bottom:1px solid #ddd;">
                                                                <div class="col-4"> <label
                                                                        class="form-control-label">{{ __('Paystack') }}</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$paymentData->paystack == 1?'checked':''}} name="paystack"
                                                                            id="paystack">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h6 class="heading-small text-muted mb-4" >{{ __("Stripe") }}</h6>
                                                        <div class="form-group row{{ $errors->has('stripePublicKey') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-stripePublicKey">{{ __('Stripe Public Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="stripePublicKey" id="input-stripePublicKey"
                                                                    class="form-control form-control-alternative{{ $errors->has('stripePublicKey') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Stripe Public Key') }}" value="{{ $paymentData->stripePublicKey }}">
                                                                @if ($errors->has('stripePublicKey'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('stripePublicKey') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('stripeSecretKey') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-stripeSecretKey">{{ __('Stripe Secret Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="stripeSecretKey" id="input-stripeSecretKey"
                                                                    class="form-control form-control-alternative{{ $errors->has('stripeSecretKey') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Stripe Secret Key:') }}" value="{{ $paymentData->stripeSecretKey }}">
                                                                @if ($errors->has('stripeSecretKey'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('stripeSecretKey') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <h6 class="heading-small text-muted mb-4 pt-4" style="border-top:1px solid #ddd;">{{ __("Paypal") }}</h6>
                                                        <div class="form-group row {{ $errors->has('paypalSendbox') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-paypalSendbox">{{ __('Paypal Sandbox Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="paypalSendbox" id="input-paypalSendbox"
                                                                    class="form-control form-control-alternative{{ $errors->has('paypalSendbox') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Paypal Sandbox Key:') }}" value="{{ $paymentData->paypalSendbox }}">
                                                                @if ($errors->has('paypalSendbox'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('paypalSendbox') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('paypalProduction') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-paypalProduction">{{ __('Paypal Production Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="paypalProduction" id="input-paypalProduction"
                                                                    class="form-control form-control-alternative{{ $errors->has('paypalProduction') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Paypal Production Key:') }}" value="{{ $paymentData->paypalProduction }}">
                                                                @if ($errors->has('paypalProduction'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('paypalProduction') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <h6 class="heading-small text-muted mb-4 pt-4" style="border-top:1px solid #ddd;">{{ __("RazorPay") }}</h6>
                                                        <div class="form-group row{{ $errors->has('razorPublishKey') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-razorPublishKey">{{ __('Razor Public Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="razorPublishKey" id="input-razorPublishKey"
                                                                    class="form-control form-control-alternative{{ $errors->has('razorPublishKey') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('RazorPay Public Key') }}" value="{{ $paymentData->razorPublishKey }}">
                                                                @if ($errors->has('razorPublishKey'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('razorPublishKey') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                            
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('razorSecretKey') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-razorSecretKey">{{ __('RazorPay Secret Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="razorSecretKey" id="input-razorSecretKey"
                                                                    class="form-control form-control-alternative{{ $errors->has('razorSecretKey') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('RazorPay Secret Key:') }}" value="{{ $paymentData->razorSecretKey }}">
                                                                @if ($errors->has('razorSecretKey'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('razorSecretKey') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                                        <h6 class="heading-small text-muted mb-4 pt-4" style="border-top:1px solid #ddd;">{{ __("Flutterwave") }}</h6>
                                                        <div class="form-group row {{ $errors->has('flutterwave_public_key') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-flutterwave_public_key">{{ __('Flutterwave Public Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="flutterwave_public_key" id="input-flutterwave_public_key"
                                                                    class="form-control form-control-alternative{{ $errors->has('flutterwave_public_key') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Flutterwave Public Key') }}" value="{{ $paymentData->flutterwave_public_key }}">
                                                                @if ($errors->has('flutterwave_public_key'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('flutterwave_public_key') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <h6 class="heading-small text-muted mb-4 pt-4" style="border-top:1px solid #ddd;">{{ __("Paystack") }}</h6>
                                                        <div class="form-group row {{ $errors->has('paystack_public_key') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-paystack_public_key">{{ __('Paystack Public Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="paystack_public_key" id="input-paystack_public_key"
                                                                    class="form-control form-control-alternative{{ $errors->has('paystack_public_key') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Paystack Public Key') }}" value="{{ $paymentData->paystack_public_key }}">
                                                                @if ($errors->has('paystack_public_key'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('paystack_public_key') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="tab-pane" id="language-v">
                                                <h6 class="heading-small text-muted mb-4">{{ __("Language Setting") }}</h6>
                                                <div class="row">
                                                    <div class="col-3 mb-2 heading-small">{{ __("Language Name") }}</div>
                                                    <div class="col-9 mb-2 heading-small">{{ __("Status") }}</div>
                                                </div>
                                                <div class="row languages mb-4" style="border-bottom: 1px solid #ddd;">
                                                    @foreach ($language as $item)
                                                    <div class="col-3 mb-2 text-muted"><span>{{$item->name}}</span></div>
                                                    <div class="col-9 mb-2 text-muted">
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" value="1" class="language-status" {{$item->status == 1?'checked':''}}
                                                                name="status-{{$item->id}}" id="status-{{$item->id}}">
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <form method="post" action="{{url('default-language')}}" autocomplete="off" enctype="multipart/form-data" files="true">
                                                    @csrf
                                                    <h6 class="heading-small text-muted mb-4 mt-4">{{ __("Default Language") }}</h6>
                                                    <div  style="border-bottom: 1px solid #ddd;">
                                                        <select name="language" id="language"
                                                            class="form-control form-control-alternative{{ $errors->has('language') ? ' is-invalid' : '' }}"
                                                            required>
                                                            <option value="">{{__('Select Default Language')}}</option>
                                                            @foreach ($language as $item)
                                                                <option value="{{$item->name}}" {{$companyData->language==$item->name?'Selected' : ''}}>
                                                                    {{$item->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-right mb-5">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <a href="{{ url('downloadSampleJson') }}" class="btn btn-sm btn-primary mt-4 float-right">{{ __('Sample .json') }}</a>
                                                <form method="post" action="{{url('Language')}}" autocomplete="off" enctype="multipart/form-data" files="true">
                                                    @csrf
                                                    <h6 class="heading-small text-muted mb-4 mt-4">{{ __("Add New Language") }}</h6>
                                                    <div>
                                                        <div class="form-group row {{ $errors->has('lang_name') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-lang_name">{{ __('Language Name') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="lang_name" id="input-lang_name"
                                                                    class="form-control form-control-alternative{{ $errors->has('lang_name') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Language Name') }}">
                                                                @if ($errors->has('lang_name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('lang_name') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('file') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-file">{{ __('Language File') }}:<br>(only .json file)</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="custom-file">
                                                                    <input type="file" accept="application/JSON"
                                                                        class="custom-file-input form-control-alternative{{ $errors->has('file') ? ' is-invalid' : '' }}"
                                                                        name="file" id="file">
                                                                    @if ($errors->has('file'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('file') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                    <label class="custom-file-label" for="file">Select file</label>
                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('icon') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-icon">{{ __('Language Map icon') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="custom-file">
                                                                    <input type="file"
                                                                        class="custom-file-input form-control-alternative{{ $errors->has('icon') ? ' is-invalid' : '' }}"
                                                                        name="icon" id="icon">
                                                                    @if ($errors->has('icon'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('icon') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                    <label class="custom-file-label" for="icon">Select file</label>
                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('direction') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-icon">{{ __('Direction') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <select name="direction" id="input-direction"
                                                                class="form-control form-control-alternative{{ $errors->has('direction') ? ' is-invalid' : '' }}"
                                                                required>
                                                                <option value="ltr">LTR</option>
                                                                <option value="rtl">RTL</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="tab-pane" id="verification-v">
                                                <form method="post" action="{{url('saveVerificationSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 class="heading-small text-muted mb-4">{{ __("User Verification Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group{{ $errors->has('user_verify') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-4"> <label class="form-control-label">{{ __('Verify User') }}:</label></div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$setting->user_verify == 1?'checked':''}}
                                                                            name="user_verify" id="user_verify">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-group{{ $errors->has('phone_verify') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-4"> <label class="form-control-label">{{ __('Verification using Phone') }}:</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$setting->phone_verify == 1?'checked':''}}
                                                                            name="phone_verify" id="phone_verify">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('email_verify') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-4"> <label class="form-control-label">{{ __('Verification using Email') }}:</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$setting->email_verify == 1?'checked':''}}
                                                                            name="email_verify" id="email_verify">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="tab-pane" id="commission-v">
                                                <form method="post" action="{{url('saveCommissionSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 class="heading-small text-muted mb-4">{{ __("Commission Setting") }}</h6>
                                                    <div>
                                                    <div class="form-group row {{ $errors->has('commission_per') ? ' has-danger' : '' }}">
                                                        <div class="col-3">
                                                            <label class="form-control-label" for="input-commission_per">{{ __('Gambo Commission') }}
                                                                <br>{{ __('(in Percentage)') }}:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="number" name="commission_per" min="0" id="input-commission_per"
                                                                class="form-control form-control-alternative{{ $errors->has('commission_per') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Gambo commission in percentage') }}" value="{{ $setting->commission_per }}">
                                                            @if ($errors->has('commission_per'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('commission_per') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                            
                                            <div class="form-group row {{ $errors->has('delivery_charge_per') ? ' has-danger' : '' }}">
                                                <div class="col-3">
                                                    <label class="form-control-label"
                                                        for="input-delivery_charge_per">{{ __('Delivery charge per order') }}<br>{{ __('(in Percentage)') }}:</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="number" name="delivery_charge_per" min="0" id="input-delivery_charge_per"
                                                        class="form-control form-control-alternative{{ $errors->has('delivery_charge_per') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Delivery charge per order(in Percentage)') }}"
                                                        value="{{ $setting->delivery_charge_per }}">
                                                    @if ($errors->has('delivery_charge_per'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('delivery_charge_per') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                            </div>
                                            </div>
                                            </form>
                                            </div>
                                            
                                            
                                            <div class="tab-pane" id="notification-va">
                                                <form method="post" action="{{url('saveNotificationSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                            
                                                    <h6 class="heading-small text-muted mb-4">{{ __("Push Notification Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group{{ $errors->has('push_notification') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-3"> <label class="form-control-label">{{ __('Enable Push Notification') }}</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$setting->push_notification == 1?'checked':''}}
                                                                            name="push_notification" id="push_notification">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                            
                                                        <div class="form-group row {{ $errors->has('onesignal_api_key') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-onesignal_api_key">{{ __('One Signal Rest Api Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="onesignal_api_key" id="input-onesignal_api_key"
                                                                    class="form-control form-control-alternative{{ $errors->has('onesignal_api_key') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('One Signal Rest Api Key') }}" value="{{ $setting->onesignal_api_key }}">
                                                                @if ($errors->has('onesignal_api_key'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('onesignal_api_key') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-group row {{ $errors->has('onesignal_auth_key') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-onesignal_auth_key">{{ __('One Signal Auth Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="onesignal_auth_key" id="input-onesignal_auth_key"
                                                                    class="form-control form-control-alternative{{ $errors->has('onesignal_auth_key') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('One Signal Auth Key') }}" value="{{ $setting->onesignal_auth_key }}">
                                                                @if ($errors->has('onesignal_auth_key'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('onesignal_auth_key') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                            
                                                        <div class="form-group row {{ $errors->has('onesignal_app_id') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-onesignal_app_id">{{ __('One Signal AppID') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="onesignal_app_id" id="input-onesignal_app_id"
                                                                    class="form-control form-control-alternative{{ $errors->has('onesignal_app_id') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('One Signal AppID') }}" value="{{ $setting->onesignal_app_id }}">
                                                                @if ($errors->has('onesignal_app_id'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('onesignal_app_id') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('onesignal_project_number') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-onesignal_project_number">{{ __('One Signal Project No.') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="onesignal_project_number" id="input-onesignal_project_number"
                                                                    class="form-control form-control-alternative{{ $errors->has('onesignal_project_number') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('One Signal Project No.') }}"
                                                                    value="{{ $setting->onesignal_project_number }}">
                                                                @if ($errors->has('onesignal_project_number'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('onesignal_project_number') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                            
                                            
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="mail-v">
                                                <form method="post" action="{{url('saveMailSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                            
                                                    <h6 class="heading-small text-muted mb-4">{{ __("SMTP Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group{{ $errors->has('mail_notification') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-3"> <label class="form-control-label">{{ __('Enable Mail Notification') }}</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$setting->mail_notification == 1?'checked':''}}
                                                                            name="mail_notification" id="mail_notification">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-group row {{ $errors->has('mail_host') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-mail_host">{{ __('Mail Host') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="mail_host" id="input-mail_host" value="{{$setting->mail_host}}"
                                                                    class="form-control form-control-alternative{{ $errors->has('mail_host') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Mail Host') }}">
                                                                @if ($errors->has('mail_host'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('mail_host') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('mail_port') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-mail_port">{{ __('Mail Port') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="mail_port" id="input-mail_port" value="{{$setting->mail_port}}"
                                                                    class="form-control form-control-alternative{{ $errors->has('mail_port') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Mail Port') }}">
                                                                @if ($errors->has('mail_port'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('mail_port') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row {{ $errors->has('mail_encryption') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-mail_encryption">{{ __('Mail Encryption') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="mail_encryption" id="input-mail_encryption" value="{{$setting->mail_encryption}}"
                                                                    class="form-control form-control-alternative{{ $errors->has('mail_encryption') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Mail Encryption') }}">
                                                                @if ($errors->has('mail_encryption'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('mail_encryption') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('mail_username') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-mail_username">{{ __('Mail UserName') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="mail_username" id="input-mail_username" value="{{$setting->mail_username}}"
                                                                    class="form-control form-control-alternative{{ $errors->has('mail_username') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Mail UserName') }}">
                                                                @if ($errors->has('mail_username'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('mail_username') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('mail_password') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-mail_password">{{ __('Mail Password') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="mail_password" id="input-mail_password" value="{{$setting->mail_password}}"
                                                                    class="form-control form-control-alternative{{ $errors->has('mail_password') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Mail Password') }}">
                                                                @if ($errors->has('mail_password'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('mail_password') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('sender_email') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-sender_email">{{ __('Sender Email ID') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="sender_email" id="input-sender_email" value="{{$setting->sender_email}}"
                                                                    class="form-control form-control-alternative{{ $errors->has('sender_email') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Sender Email ID') }}">
                                                                @if ($errors->has('sender_email'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('sender_email') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="sms-v">
                                                <form method="post" action="{{url('saveSMSSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                            
                                                    <h6 class="heading-small text-muted mb-4">{{ __("SMS Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group{{ $errors->has('sms_twilio') ? ' has-danger' : '' }}">
                                                            <div class="row">
                                                                <div class="col-3"> <label class="form-control-label">{{ __('Enable SMS Notification') }}</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <label class="custom-toggle">
                                                                        <input type="checkbox" value="1" {{$setting->sms_twilio == 1?'checked':''}}
                                                                            name="sms_twilio" id="sms_twilio">
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                                            data-label-on="Yes"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                            
                                            
                                                        <div class="form-group row {{ $errors->has('twilio_account_id') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-twilio_account_id">{{ __('Twilio Account ID') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="twilio_account_id" id="input-twilio_account_id"
                                                                    class="form-control form-control-alternative{{ $errors->has('twilio_account_id') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Twilio Account ID') }}" value="{{ $setting->twilio_account_id }}">
                                                                @if ($errors->has('twilio_account_id'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('twilio_account_id') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('twilio_auth_token') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-twilio_auth_token">{{ __('Twilio Auth Token') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="twilio_auth_token" id="input-twilio_auth_token"
                                                                    class="form-control form-control-alternative{{ $errors->has('twilio_auth_token') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Twilio Auth Token') }}" value="{{ $setting->twilio_auth_token }}">
                                                                @if ($errors->has('twilio_auth_token'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('twilio_auth_token') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-group row {{ $errors->has('twilio_phone_number') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-twilio_phone_number">{{ __('Twilio Phone Number') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="twilio_phone_number" id="input-twilio_phone_number"
                                                                    class="form-control form-control-alternative{{ $errors->has('twilio_phone_number') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Twilio Phone Number') }}" value="{{ $setting->twilio_phone_number }}">
                                                                @if ($errors->has('twilio_phone_number'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('twilio_phone_number') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                            
                                            
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="tab-pane" id="map-v">
                                                <form method="post" action="{{url('saveMapSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                            
                                                    <h6 class="heading-small text-muted mb-4">{{ __("Map Setting") }}</h6>
                                                    <div>
                                                        <div class="form-group row {{ $errors->has('map_key') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-map_key">{{ __('Map Api Key') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="map_key" id="input-map_key"
                                                                    class="form-control form-control-alternative{{ $errors->has('map_key') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Map api key') }}" value="{{ $setting->map_key }}" required>
                                                                @if ($errors->has('map_key'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('map_key') }}</strong>
                                                                </span>
                                                                @endif
                                            
                                                                <p class="mt-4" style="font-weight:400;font-size:15px;letter-spacing: .5px;">
                                                                    {{ __('The Maps JavaScript API lets you customize maps with your own content and imagery for display on web pages and mobile devices. See')}}
                                                                    <a
                                                                        href="https://developers.google.com/maps/documentation/javascript/get-api-key">{{ __('Get API Key')}}</a>
                                                                    {{ __('for more information')}}.</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row {{ $errors->has('lat') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-lat">{{ __('Default Latitude') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="lat" id="input-lat"
                                                                    class="form-control form-control-alternative{{ $errors->has('lat') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Default Latitude') }}" value="{{ $setting->lat }}">
                                                                @if ($errors->has('lat'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('lat') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row {{ $errors->has('lang') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label"
                                                                    for="input-lang">{{ __('Default Longitude') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="lang" id="input-lang"
                                                                    class="form-control form-control-alternative{{ $errors->has('lang') ? ' is-invalid' : '' }}"
                                                                    placeholder="{{ __('Default Longitude') }}" value="{{ $setting->lang }}">
                                                                @if ($errors->has('lang'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('lang') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="tab-pane" id="additional-v">
                                                <form method="post" action="{{url('saveSettings')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 class="heading-small text-muted mb-4">{{ __("General Setting") }}</h6>
                                                    <div>

                                                        <div class="form-group row {{ $errors->has('color') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-color">{{ __('Website Color') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="color" name="color" value="{{$setting->color}}"  id="input-color" class="form-control form-control-alternative{{ $errors->has('color') ? ' is-invalid' : '' }}" required>                                                                                                                                 
                                                                @if ($errors->has('color'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('color') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row {{ $errors->has('currency') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-currency">{{ __('Currency') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <select name="currency" id="input-currency"
                                                                    class="form-control form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}"
                                                                    required>
                                                                    <option value="">Select Currency</option>
                                                                    @foreach ($currency as $item)
                                                                    <option value="{{$item->code}}" {{$setting->currency==$item->code?'Selected' : ''}}>
                                                                        {{$item->currency.' ( '.$item->symbol.' )'}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('currency'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('currency') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row {{ $errors->has('location') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-location">{{ __('Default Location') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <select name="location" id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}">
                                                                    @if ($setting->location != null)
                                                                        <option value="0">Remove Default Location</option>
                                                                    @else
                                                                        <option value="">Select Location</option>
                                                                    @endif
                                                                    @foreach ($location as $item)
                                                                    <option value="{{$item->id}}" {{$setting->location == $item->id?'Selected' : ''}}>
                                                                        {{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('location'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('location') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row {{ $errors->has('default_grocery_order_status') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-default_grocery_order_status">{{ __('Default Order Status for Grocery') }}:</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <select name="default_grocery_order_status" id="input-default_grocery_order_status" class="form-control form-control-alternative{{ $errors->has('default_grocery_order_status') ? ' is-invalid' : '' }}" required>
                                                                    <option value="">Select Defaut order Status</option>
                                                                    <option value="Pending" {{$setting->default_grocery_order_status=="Pending"?'Selected' : ''}}>Pending</option>
                                                                    <option value="Approved" {{$setting->default_grocery_order_status=="Approved"?'Selected' : ''}}>Approved</option>
                                                                </select>
                                                                @if ($errors->has('default_grocery_order_status'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('default_grocery_order_status') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row {{ $errors->has('delivery_charge') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-delivery_charge">{{ __('Delivery charges') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="number" min="0" name="delivery_charge" placeholder="Enter Delivery charges" value="{{$setting->delivery_charge}}"  id="input-delivery_charge" class="form-control form-control-alternative{{ $errors->has('delivery_charge') ? ' is-invalid' : '' }}" required>                                                                                                                                 
                                                                @if ($errors->has('delivery_charge'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('delivery_charge') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane {{ $status==0?'active':''}}" id="license-v">
                                                <form method="post" action="{{url('saveLicense')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                            
                                                    <h6 class="heading-small text-muted mb-4">{{ __("License Setting") }}</h6>
                                                    <div>
                                                  
                                                        <div class="form-group row {{ $errors->has('license_key') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-license_key">{{ __('License Key') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" {{$status==1?'disabled':''}} name="license_key" placeholder="Enter License key" id="input-license_key" class="form-control form-control-alternative{{ $errors->has('license_key') ? ' is-invalid' : '' }}" required>                                                                                                                                 
                                                                @if ($errors->has('license_key'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('license_key') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row {{ $errors->has('license_name') ? ' has-danger' : '' }}">
                                                            <div class="col-3">
                                                                <label class="form-control-label" for="input-license_name">{{ __('License name') }}</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" name="license_name" {{$status==1?'disabled':''}} placeholder="Enter License name"  id="input-license_name" class="form-control form-control-alternative{{ $errors->has('license_name') ? ' is-invalid' : '' }}" required>                                                                                                                                 
                                                                @if ($errors->has('license_name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('license_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3"></div>
                                                            <div class="col-9">
                                                                @if(Session::has('error_msg'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{Session::get('error_msg')}}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if($status==0)
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                                        </div>
                                                        @endif
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

@endsection