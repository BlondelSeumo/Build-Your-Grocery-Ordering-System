@extends('admin.master', ['title' => __('Edit Faq')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Edit Faq') ,
        'headerData' => __('Faq') ,
        'url' => 'Faq' ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card form-card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Edit Faq') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ url('Faq') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{url('Faq/'.$data->id)}}" autocomplete="off" enctype="multipart/form-data" >
                                    @csrf
                                    @method('put')
                                    <h6 class="heading-small text-muted mb-4">{{ __('Faq Detail') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ $data->title }}" required autofocus>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                            <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}"  >{{ $data->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                            <Select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"  required>
                                                <option value="">Select Status</option>
                                                <option value="0" {{ $data->status=="0" ? 'Selected' : ''}}>Active</option>
                                                <option value="1" {{ $data->status=="1" ? 'Selected' : ''}}>Deactive</option>
                                            </select>
        
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
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