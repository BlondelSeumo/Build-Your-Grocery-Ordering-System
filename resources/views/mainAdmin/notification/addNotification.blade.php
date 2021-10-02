@extends('admin.master', ['title' => __('Add Template')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Add Template') ,
        'headerData' => __('Templates') ,
        'url' => 'NotificationTemplate' ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card form-card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Add Template') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ url('NotificationTemplate') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{url('NotificationTemplate')}}" id="add-template-form" autocomplete="off" enctype="multipart/form-data" >
                                    @csrf
                                    
                                    <h6 class="heading-small text-muted mb-4">{{ __('Notification Detail') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">                                            
                                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>
                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">                                            
                                                    <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                                                    <input type="text" name="subject" id="input-subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Subject') }}" value="{{ old('subject') }}" required >
                                                    @if ($errors->has('subject'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subject') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                                                            
        
                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                            <div class="custom-file">
                                                <input type="file" accept=".png, .jpg, .jpeg, .svg" class="custom-file-input" name="image" id="image" required>
                                                <label class="custom-file-label" for="image">Select file</label>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>   
                                        <div class="form-group{{ $errors->has('mail_content') ? ' has-danger' : '' }}">                                            
                                            <label class="form-control-label" for="input-mail_content">{{ __('Content for Mail') }}</label>
                                            <textarea name="mail_content" placeholder="Enter Content" rows="10" id="input-mail_content" class="form-control textarea_editor form-control-alternative{{ $errors->has('mail_content') ? ' is-invalid' : '' }}" required ></textarea>
                                            @if ($errors->has('mail_content'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mail_content') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('message_content') ? ' has-danger' : '' }}">                                            
                                            <label class="form-control-label" for="input-message_content">{{ __('Content for Message') }}</label>
                                            <textarea name="message_content"  id="input-message_content" class="form-control form-control-alternative{{ $errors->has('message_content') ? ' is-invalid' : '' }}" ></textarea>
                                            @if ($errors->has('message_content'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('message_content') }}</strong>
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