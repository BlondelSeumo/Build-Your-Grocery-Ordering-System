@extends('admin.master', ['title' => __('Notification Template')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Notification Template') ,
        'class' => 'col-lg-7'
    ]) 
    @if(Session::has('msg'))
        @include('toast',Session::get('msg'))
    @endif
    <div class="container-fluid mt--7">
           
        <div class="row">
            <div class="col">
                    <div class="card bg-secondary shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Notification Template') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    {{-- <a href="{{url('NotificationTemplate/create')}}" class="btn btn-sm btn-primary">{{ __('Add New Template') }}</a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="template-left">
                                        @foreach ($data as $item)
                                            @if($loop->iteration==1)
                                                <?php $template = $item;?>
                                            @endif
                                            <div class="template-row mb-4">
                                                <img src="{{url('images/upload/'.$item->image)}}" class="avatar round-5">
                                                <button onclick="notificationDetail({{$item->id}});" class="btn btn-primary template-btn"> {{$item->title}}</button>    
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <div class="col-7">
                                        <form method="post" action="{{url('NotificationTemplate/'.$template->id)}}" id="edit-template-form" autocomplete="off" enctype="multipart/form-data" >
                                            @csrf
                                            @method('put')
                                            <h6 class="heading-small text-muted mb-4">{{ __('Edit Template') }}</h6>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">                                            
                                                            <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                                                            <input type="text" name="subject" id="input-subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Subject') }}" value="{{isset($template) ? $template->subject: ''}}" required >
                                                            @if ($errors->has('subject'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                                            <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                                                <div class="custom-file">
                                                                <input type="file" accept=".png, .jpg, .jpeg, .svg" class="custom-file-input" name="image" id="image" >
                                                                <label class="custom-file-label" for="image">Select file</label>
                                                                </div>
                                                            @if ($errors->has('image'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('image') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>  
                                                    </div>
                                                </div>
                                                <input type="hidden" id="content-data" name="content-text" value="{{isset($template) ? $template->mail_content: ''}}" >
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
                                                    <textarea name="message_content"  id="input-message_content" class="form-control form-control-alternative{{ $errors->has('message_content') ? ' is-invalid' : '' }}" >{{isset($template) ? $template->message_content: ''}}</textarea>
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
                                <div class="col-2">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Email Placeholder') }}</h6>
                                    <div class="mail-placeholder">  
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Receiver name">@{{name}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Order ID">@{{order_no}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="User Address">@{{user_address}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Payment Status">@{{payment_status}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Order Status">@{{status}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Cusetomer name">@{{customer_name}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="New Password">@{{password}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="User Verification code">@{{otp}}</button>
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="System Name">@{{shop_name}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>       
        <div class="test-mail-section">
            <span><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn" title="Send test mail"><i class="far fa-envelope"></i></button></span>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('Send Test Mail')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body bg-secondary">
                <form method="post" action="{{url('sendTestMail')}}">
                        @csrf                        
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">                                            
                                <label class="form-control-label" for="input-email">{{ __('Recipient Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Recipient Email') }}" value="" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                          
                            <div class="form-group{{ $errors->has('template_id') ? ' has-danger' : '' }}">                                            
                                <label class="form-control-label"   style="display:block;"for="input-template_id">{{ __('Notification Template') }}</label>
                                <select type="text" name="template_id" id="input-template_id" class=" select2 form-control form-control-alternative{{ $errors->has('template_id') ? ' is-invalid' : '' }}" required >
                                    <option value="" selected>Select Mail Template</option>
                                    @foreach ($data as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('template_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('template_id') }}</strong>
                                    </span>
                                @endif
                            </div>  
                            <div class="form-group text-right"> 
                                <button type="button" class="btn" data-dismiss="modal">{{ __('Close') }}</button>
                                <button  type="submit" class="btn btn-primary">{{ __('Send') }}</button>   
                            </div>                                              
                   </form>
                </div>
                {{-- <div class="modal-footer">    </div> --}}
            </div>
        </div>
    </div>


@endsection