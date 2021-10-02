<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <?php $logo = \App\CompanySetting::find(1)->logo; ?>

        @if(Auth::check())
            <a class="navbar-brand pt-0" href="{{url('home')}}">
                <img src="{{ url('images/upload/'.$logo)}}" class="navbar-brand-img" alt="...">
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ url('images/upload/'.Auth::user()->image) }}">
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                        </div>
                        <a href="#" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('My profile') }}</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>{{ __('Activity') }}</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="ni ni-support-16"></i>
                            <span>{{ __('Support') }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="#">
                                <img src="{{ url('images/upload/'.$logo) }}">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    {{-- here --}}
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended"
                            placeholder="{{ __('Search') }}" aria-label="Search">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home')  ? 'active' : ''}}" href="{{url('home')}}">
                            <i class="ni ni-chart-pie-35 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                 
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('GroceryOrder')  ? 'active' : ''}}" href="{{url('GroceryOrder')}}">
                            <i class="ni ni-calendar-grid-58 text-primary"></i> {{ __('Orders') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('Location')  ? 'active' : ''}}" href="{{url('Location')}}">
                            <i class="ni ni-pin-3 " style="color: #ff9200;"></i> {{ __('Locations') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('GroceryCategory')  ? 'active' : ''}}" href="{{url('GroceryCategory')}}">
                            <i class="ni ni-app " style="color: #f3a4b5;"></i> {{ __('Grocery Category') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('GrocerySubCategory')  ? 'active' : ''}}" href="{{url('GrocerySubCategory')}}">
                            <i class="fas fa-list-ul text-primary"></i> {{ __('Grocery SubCategory') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('GroceryShop')  ? 'active' : ''}}" href="{{url('GroceryShop')}}">
                            <i class="fas fa-store-alt text-orange"></i> {{ __('Grocery Shop') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('GroceryItem')  ? 'active' : ''}}" href="{{url('GroceryItem')}}">
                            <i class="ni ni-app text-success"></i> {{ __('Grocery Item') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('GroceryCoupon')  ? 'active' : ''}}" href="{{url('GroceryCoupon')}}">
                            <i class="fas fa-tags text-orange"></i> {{ __('Grocery Coupon') }}
                        </a>
                    </li>
              
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('Banner')  ? 'active' : ''}}" href="{{url('Banner')}}">
                            <i class="ni ni-image text-danger "></i> {{ __('Banner') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('Customer') || request()->is('deliveryGuys')  ? 'active' : ''}}" href="#navbar-examples" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="navbar-examples">
                            <i class="ni ni-circle-08" style="color: #1592e2;"></i>
                            <span class="nav-link-text">{{ __('Manage Users') }}</span>
                        </a>

                        <div class="collapse {{ request()->is('Customer') || request()->is('deliveryGuys') ? 'show' : ''}}" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('Customer')  ? 'active-tab' : ''}}" href="{{url('Customer')}}">
                                        <i class="fas fa-users" style="color:#8abf4d;"></i> {{ __('Users') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('deliveryGuys')  ? 'active-tab' : ''}}" href="{{url('deliveryGuys')}}">
                                        <i class="fas fa-truck-moving" style="color:#8abf4d;"></i>
                                        {{ __('Delivery Guys') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>                             
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('customerReport') || request()->is('groceryRevenueReport') ? 'active' : ''}}" href="#report-expand" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="report-expand">
                            <i class="fas fa-chart-bar" style="color: #5e72e4;"></i>
                            <span class="nav-link-text">{{ __('Reports') }}</span>
                        </a>
                 
                        <div class="collapse {{ request()->is('customerReport') || request()->is('groceryRevenueReport') ? 'show' : ''}}" id="report-expand">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('customerReport')  ? 'active-tab' : ''}}" href="{{url('customerReport')}}">
                                            <i class="ni ni-paper-diploma" style="color:#ff9200;"></i> {{ __('Customer Report') }}
                                        </a>
                                    </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('groceryRevenueReport')  ? 'active-tab' : ''}}" href="{{url('groceryRevenueReport')}}">
                                        <i class="ni ni-chart-pie-35" style="color:#8abf4d;"></i>
                                        {{ __('Revenue Report') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('NotificationTemplate')  ? 'active' : ''}}" href="{{url('NotificationTemplate')}}">
                            <i class="fas fa-bell" style="color: #f53d55;"></i> {{ __('Notification Setting') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('Faq')  ? 'active' : ''}}" href="{{url('Faq')}}">
                            <i class="fa fa-question-circle text-green "></i> {{ __('FAQ') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user-request')  ? 'active' : ''}}" href="{{url('user-request')}}">
                            <i class="fa fa-paper-plane text-pink "></i> {{ __('User Request') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('OwnerSetting')  ? 'active' : ''}}" href="{{url('OwnerSetting')}}">
                            <i class="ni ni-settings-gear-65 text-info"></i> {{ __('Setting') }}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</nav>