<!-- Header Start -->
@php
    $company = \App\CompanySetting::first(['logo','phone','logo_dark','responsive_logo']);
    $locations = \App\Location::where('status',0)->orderBy('id','desc')->get();
    $arr = array();
    foreach ($locations as $key => $location) {
        $shops = \App\GroceryShop::where([['status',0],['location',$location->id]])->get();
        foreach ($shops as $key_shop => $shop) {
            $item = \App\GroceryItem::where([['status',0],['shop_id',$shop->id]])->first();
            array_push($arr, $location->id);
        }
    }
    $locations = \App\Location::whereIn('id',$arr)->orderBy('id','desc')->get();
@endphp

<header class="header clearfix">
    <div class="top-header-group">
        <div class="top-header">
            <div class="res_main_logo">
                <a href="{{ url('/') }}"><img src="{{ url('images/upload/'.$company->responsive_logo) }}" alt=""></a>
            </div>
            <div class="main_logo" id="logo">
                <a href="{{ url('/') }}"><img src="{{ url('images/upload/'.$company->logo) }}" alt=""></a>
                <a href="{{ url('/') }}"><img class="logo-inverse" src="{{ url('images/upload/'.$company->logo_dark) }}" alt=""></a>
            </div>
            <div class="select_location">
                <div class="ui inline dropdown loc-title">
                    <div class="text">
                      <i class="uil uil-location-point"></i>
                        @if (session()->exists('location_id') && session()->exists('location_name'))
                            {{session('location_name')}}
                        @else
                            {{__('Location')}}
                        @endif
                    </div>
                    <i class="uil uil-angle-down icon__14"></i>
                    <div class="menu dropdown_loc">
                        @foreach ($locations as $item)
                            <a href="{{url('setLocation/'.$item->id)}}" class="item channel_item">
                                <i class="uil uil-location-point"></i>
                                {{$item->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{url('/products')}}" method="post">
                @csrf
                <input type="hidden" name="query" value="" id="query">
                <button class="display-none" type="submit" id="search-btn"></button>
            </form>
                <div class="search120">
                    <div class="ui search">
                        <div class="ui left icon input swdh10">
                            <input class="prompt srch10" name="query" type="text" id="search" placeholder="{{__('Search for products..')}}">
                            <i class='uil uil-search-alt icon icon1'></i>
                        </div>
                    </div>
                </div>
            <div class="header_right">
                <ul>
                    <li>
                        <a href="tel:{{$company->phone}}" class="offer-link"><i class="uil uil-phone-alt"></i> {{$company->phone}} </a>
                    </li>
                    <li>
                        <a href="{{ url('/offers') }}" class="offer-link"><i class="uil uil-gift"></i> {{__('Offers')}} </a>
                    </li>
                    <li>
                        <a href="{{ url('/faq') }}" class="offer-link"><i class="uil uil-question-circle"></i> {{__('Help')}} </a>
                    </li>
                    @if (Auth::check())
                        <li>
                            <a href="{{ url('/profile/wishlist') }}" class="option_links" title="Wishlist">
                                <i class='uil uil-heart icon_wishlist'></i><span class="noti_count1"> {{Auth::user()->wishlistCount}} </span>
                            </a>
                        </li>	
                        <li class="ui dropdown">
                            <a href="#" class="opts_account">
                                <img src="{{ url('images/upload/'.Auth::user()->image) }}" alt="">
                                <span class="user__name"> {{Auth::user()->name}} </span>
                                <i class="uil uil-angle-down"></i>
                            </a>
                            <div class="menu dropdown_account">
                                <div class="night_mode_switch__btn">
                                    <a href="#" id="night-mode" class="btn-night-mode">
                                        <i class="uil uil-moon"></i> {{__('Night mode')}}
                                        <span class="btn-night-mode-switch">
                                            <span class="uk-switch-button"></span>
                                        </span>
                                    </a>
                                </div>
                                <a href="{{url('/profile/dashboard')}}" class="item channel_item"><i class="uil uil-apps icon__1"></i> {{__('Dashbaord')}} </a>
                                <a href="{{url('/profile/view')}}" class="item channel_item"><i class="uil uil-user icon__1"></i> {{__('Profile')}} </a>
                                <a href="{{url('/profile/change-password')}}" class="item channel_item"><i class="uil uil-padlock icon__1"></i> {{__('Change Password')}} </a>
                                <a href="{{url('/profile/orders')}}" class="item channel_item"><i class="uil uil-box icon__1"></i>{{__('My Orders')}}</a>
                                <a href="{{url('/profile/wishlist')}}" class="item channel_item"><i class="uil uil-heart icon__1"></i> {{__('My Wishlist')}} </a>
                                <a href="{{url('/profile/address')}}" class="item channel_item"><i class="uil uil-location-point icon__1"></i> {{__('My Address')}} </a>
                                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>{{__('Logout')}}</a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/signin') }}" class="offer-link"><i class="uil uil-sign-out-alt"></i> {{__('Sign In')}} </a>
                        </li>
                        <li>
                            <a href="{{ url('/signup') }}" class="offer-link"><i class="uil uil-user-plus"></i> {{__('Sign Up')}} </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="sub-header-group">
        <div class="sub-header">
            <div class="ui dropdown">
                <a href="#" class="category_drop hover-btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i><span class="cate__icon">{{__('Select Category')}}</span></a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light py-3">
                <div class="container-fluid">
                    <button class="navbar-toggler menu_toggle_btn" type="button" data-target="#navbarSupportedContent"><i class="uil uil-bars"></i></button>
                    <div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
                        <ul class="navbar-nav main_nav align-self-stretch">
                            <li class="nav-item">
                                <a href="{{url('/')}}" class="nav-link {{ request()->is('/')  ? 'active' : ''}}" title="Home"> {{__("Home")}} </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/all-products')}}" class="nav-link {{ request()->is('all-products')  ? 'active' : ''}}" title="All Products"> {{__('All Products')}} </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/featured-products')}}" class="nav-link {{ request()->is('featured-products')  ? 'active' : ''}}" title="Featured Products"> {{__('Featured Products')}} </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/contact-us')}}" class="nav-link {{ request()->is('contact-us')  ? 'active' : ''}}" title="Contact"> {{__('Contact Us')}} </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="catey__icon">
                <a href="#" class="cate__btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i></a>
            </div>
            <div class="header_cart order-1">
                <a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart"><i class="uil uil-shopping-cart-alt"></i><span>{{__('Cart')}}</span><ins class="cart-item-count">{{ count((array) session('cart')) }}</ins><i class="uil uil-angle-down"></i></a>
            </div>
            {{-- <div class="search__icon order-1">
                <a href="#" class="search__btn hover-btn" data-toggle="modal" data-target="#search_model" title="Search"><i class="uil uil-search"></i></a>
            </div> --}}
        </div>
    </div>
</header>
<!-- Header End -->