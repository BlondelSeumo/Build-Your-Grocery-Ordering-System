@extends('frontend.layout.master')
@section('title', __('FAQ'))

@section('content')

<!-- Body Start -->
<div class="wrapper">
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}} </a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Frequently Asked Questions')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="default-title mt-4">
                        <h2> {{__('Frequently Asked Questions')}} </h2>
                        <img src="{{url('/frontend/images/line.svg')}}" alt="">
                    </div>
                    @if (count($faq) > 0)
                        <div class="panel-group accordion pt-1" id="accordion0">
                            @foreach ($faq as $item)
                                <div class="panel panel-default">
                                    <div class="panel-heading" id="heading{{$item->id}}">
                                        <div class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapse{{$item->id}}" href="#" aria-expanded="false" aria-controls="collapse{{$item->id}}">
                                                {{$item->title}}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapse{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$item->id}}" data-parent="#accordion0" style="">
                                        <div class="panel-body">
                                            <p>{{$item->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-lg-12 col-md-12">
                            <div class="how-order-steps">
                                <div class="how-order-icon">
                                    <i class="uil uil-question-circle"></i>
                                </div>
                                <h4> {{__('No FAQ Available')}} </h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>	
</div>
<!-- Body End -->

@endsection