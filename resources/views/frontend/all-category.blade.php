@extends('frontend.layout.master')
@section('title', __('All Categories'))

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
                            <li class="breadcrumb-item active" aria-current="page"> {{__('Categories')}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="all-product-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-top-dt">
                        <div class="product-left-title">
                            <h2 class="cat_name"> {{__('All Categories')}} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-list-view">
                <div class="row category-by-cat">
                    @if (count($data['category']) > 0)
                        @foreach ($data['category'] as $item)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{url('category/'.$item->id.'/'.Str::slug($item->name))}}" class="single-cat-item bg-white mb-4">
									<div class="icon">
										<img src="{{ $item->imagePath . $item->image }}" alt="">
									</div>
									<div class="text"> {{$item->name}} </div>
								</a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-md-12">
                            <div class="how-order-steps">
                                <div class="how-order-icon">
                                    <i class="uil uil-shopping-basket"></i>
                                </div>
                                <h4> {{__('No Categories Available')}} </h4>
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