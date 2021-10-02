@extends('admin.master', ['title' => __('Add Coupon')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Add Grocery Coupon') ,
        'headerData' => __('Grocery Coupon') ,
        'url' => 'GroceryCoupon' ,
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">

            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card form-card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Add Coupon') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ url('GroceryCoupon') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" id="add-coupon-form" action="{{url('GroceryCoupon')}}" autocomplete="off" enctype="multipart/form-data" >
                                    @csrf

                                    <h6 class="heading-small text-muted mb-4">{{ __('Coupon Detail') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">                                            
                                                    <label class="form-control-label" for="input-name">{{ __('Coupon Name') }}</label>
                                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">                                            
                                                    <label class="form-control-label" for="input-code">{{ __('Code') }}</label>
                                                    <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __('Code') }}" value="{{ old('code') }}" required >
                                                    @if ($errors->has('code'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('code') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                            <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}"  >{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                    <div class="form-group{{ $errors->has('location_id') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-location_id">{{ __('Location') }}</label>
                                                        <select name="location_id" id="input-location_id" class="form-control form-control-alternative{{ $errors->has('location_id') ? ' is-invalid' : '' }}" required >
                                                            <option value=""> {{__('Select Location')}} </option>
                                                            @foreach ($location as $item)
                                                            <option value="{{$item->id}}"{{ old('location_id')==$item->id ? 'Selected' : ''}}>{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('location_id'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('location_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('max_use') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-max_use">{{ __('Maximum Usage') }}</label>
                                                    <input type="number" min="0" name="max_use" id="input-max_use" class="form-control form-control-alternative{{ $errors->has('max_use') ? ' is-invalid' : '' }}" placeholder="{{ __('Maximum Usage') }}" value="{{ old('max_use') }}" required >
                                                    @if ($errors->has('max_use'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('max_use') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-control-label" for="input-description">{{ __('Counpon Type:') }}</label>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <div class="row">
                                                        <div class="col-4"> <label class="form-control-label">{{ __('Amount') }}</label></div>
                                                        <div class="col-8">
                                                            <label class="custom-toggle">
                                                                <input type="radio" value="amount" name="type" checked>
                                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4"> <label class="form-control-label">{{ __('Percentage') }}</label></div>
                                                        <div class="col-8">
                                                            <label class="custom-toggle">
                                                                <input type="radio" value="percentage" name="type" >
                                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('discount') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-discount">{{ __('Discount') }}<span id="coupon_type_label"> {{ __('(In Amount)') }}</span> </label>
                                                    <input type="number" min="0" name="discount" id="input-discount" class="form-control form-control-alternative{{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="{{ __('Discount') }}" value="{{ old('discount') }}" required >
                                                    @if ($errors->has('discount'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('discount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="coupon_start_date">{{ __('Activate Date') }}</label>
                                                    <input type="text" name="start_date" id="coupon_start_date" class="form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Activate Date') }}" value="{{ old('start_date') }}" required style="background:#fff;" >
                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                                        <Select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"  required>
                                                            <option value="">Select Status</option>
                                                            <option value="0" {{ old('status')=="0" ? 'Selected' : ''}}>Active</option>
                                                            <option value="1" {{ old('status')=="1" ? 'Selected' : ''}}>Deactive</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                                <div class="custom-file">
                                                    <input type="file"  accept=".png, .jpg, .jpeg, .svg" class="custom-file-input" name="image" id="image" required>
                                                    <label class="custom-file-label" for="image">Select file</label>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    </div>

@endsection
