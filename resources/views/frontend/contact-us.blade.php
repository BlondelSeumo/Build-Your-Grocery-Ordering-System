@extends('frontend.layout.master')
@section('title', __('Contact Us'))

@section('content')

<!-- Body Start -->
<div class="wrapper">
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"> {{__('Home')}} </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{__('Contact Us')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="panel-group accordion" id="accordion0">
                        @foreach ($data['location'] as $item)
                            <div class="panel panel-default">
                                <div class="panel-heading" id="heading-{{$item->id}}">
                                    <div class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-target="#collapse-{{$item->id}}" href="#" aria-expanded="false" aria-controls="collapse-{{$item->id}}">
                                            <i class="uil uil-location-point chck_icon"></i> {{$item->name}}
                                        </a>
                                    </div>
                                </div>
                                <div id="collapse-{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{$item->id}}" data-parent="#accordion0" >
                                    <div class="panel-body">
                                        {{$item->name}} {{__('Head Office:')}}<br>
                                        {{$item->address}}<br>
                                        {{$item->description}}<br>
                                        <div class="color-pink">Tel: <a href="tel:{{$item->phone}}">{{$item->phone}}</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact-title">
                        <h2>{{__('Submit customer service request')}}</h2>
                        <p>{{__('If you have a question about our service or have an issue to report, please send a request and we will get back to you as soon as possible.')}}</p>
                    </div>
                    <div class="contact-form">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>×</span>
                                    </button>
                                        {{ session('status') }}
                                </div>
                            </div>
                        @endif
                        <form action="{{url('/user-request-post')}}" method="post" id="user-request-form">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="control-label" for="sendername">{{__('Full Name')}}*</label>
                                <div class="ui search focus">
                                    <div class="ui left icon input swdh11 swdh19">
                                        <input class="prompt srch_explore" type="text" name="name" id="sendername" placeholder="{{__('Your Full Name')}}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-1">
                                <label class="control-label" for="emailaddress">{{__('Email Address')}}*</label>
                                <div class="ui search focus">
                                    <div class="ui left icon input swdh11 swdh19">
                                        <input class="prompt srch_explore" type="email" name="email" id="emailaddress" placeholder="{{__('Your Email Address')}}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-1">
                                <label class="control-label" for="sendersubject">{{__('Subject')}}*</label>
                                <div class="ui search focus">
                                    <div class="ui left icon input swdh11 swdh19">
                                        <input class="prompt srch_explore" type="text" name="subject" id="sendersubject" placeholder="{{__('Subject')}}" required>
                                    </div>
                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-1">	
                                <div class="field">
                                    <label class="control-label" for="sendermessage">{{__('Message')}}*</label>
                                    <textarea rows="2" class="form-control" id="sendermessage" name="message" placeholder="{{__('Write Message')}}" required></textarea>
                                </div>
                                @if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="next-btn16 hover-btn mt-3 user-request" type="submit" data-btntext-sending="Sending...">{{__('Submit Request')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
<!-- Body End -->

@endsection