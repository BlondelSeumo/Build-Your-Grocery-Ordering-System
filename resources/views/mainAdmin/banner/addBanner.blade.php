@extends('admin.master', ['title' => __('Add Banner')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Add Banner') ,
        'headerData' => __('Banner') ,
        'url' => 'Banner' ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card form-card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Banner') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('Banner') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('Banner')}}" autocomplete="off" enctype="multipart/form-data" >
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Banner Detail') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title1') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title1">{{ __('Title 1') }}</label>
                                    <input type="text" name="title1" id="input-title1" class="form-control form-control-alternative{{ $errors->has('title1') ? ' is-invalid' : '' }}" placeholder="{{ __('Title 1') }}" value="{{ old('title1') }}" required autofocus>
                                    @if ($errors->has('title1'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('title2') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title2">{{ __('Title 2') }}</label>
                                    <input type="text" name="title2" id="input-title2" class="form-control form-control-alternative{{ $errors->has('title2') ? ' is-invalid' : '' }}" placeholder="{{ __('Title 2') }}" value="{{ old('title 2') }}" required>
                                    @if ($errors->has('title2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('off') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-off">{{ __('Off') }}</label>
                                    <input type="text" name="off" id="input-off" class="form-control form-control-alternative{{ $errors->has('off') ? ' is-invalid' : '' }}" placeholder="{{ __('Off') }}" value="{{ old('off') }}" required>
                                    @if ($errors->has('off'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('off') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url">{{ __('URL') }}</label>
                                    <input type="url" name="url" id="input-url" class="form-control form-control-alternative{{ $errors->has('url') ? ' is-invalid' : '' }}" placeholder="{{ __('URL') }}" value="{{ old('url') }}">
                                    @if ($errors->has('url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                        <div class="custom-file">
                                            <input type="file"  accept=".png, .jpg, .jpeg, .svg" class="custom-file-input" name="image" id="image" required>
                                            <label class="custom-file-label" for="image"> {{__('Select file')}} </label>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                    <Select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"  required>
                                        <option value=""> {{__('Select Status')}} </option>
                                        <option value="0" {{ old('status')=="0" ? 'Selected' : ''}}>Active</option>
                                        <option value="1" {{ old('status')=="1" ? 'Selected' : ''}}>Deactive</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            
                            
                                <div class="text-center">
                                    <button type="submit" class="btn  btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection