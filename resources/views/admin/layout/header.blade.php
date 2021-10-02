<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{url('home')}}">{{ __('Dashboard') }}</a>
      
        <!-- User -->
        <?php $image = Auth::user()->image; ?>
        <?php 
           $product = 'Grocery';
        ?>
        <ul class="navbar-nav align-items-center d-none d-md-flex"> 
            <?php
                $lang = \App\Language::where('status',1)->get();
                $local = \App\Language::where('name',session('locale'))->first();
                if($local){
                    $lang_image="/images/upload/".$local->icon;
                }
                else{
                    $lang_image="/images/flag-us.png";
                }
            ?>  
               
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">                       
                        <img alt="Image placeholder"  src="{{asset($lang_image)}}" class="flag-icon" >                                             
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right py-0 overflow-hidden">
                    @foreach ($lang as $item)
                        <a href="{{url('changeLanguage/'.$item->name)}}" class="dropdown-item">
                            <img src="{{url('images/upload/'.$item->icon)}}" class="flag-icon" ><span>{{ __($item->name) }}</span>
                        </a>                        
                    @endforeach
                </div>
            </li>  
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="rounded-circle">
                            <img alt="Image placeholder" class="avatar" src="{{url('images/upload/'.$image)}}">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">
                                @if(Auth::check())
                                    {{Auth::user()->name}}
                                @endif
                            </span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right  py-0 overflow-hidden">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome') }}</h6>
                    </div>
                    @if(Auth::check())
                        <a href="{{url('ownerProfile')}}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('My profile') }}</span>
                        </a>
                        <a href="{{url('OwnerSetting')}}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    @endif
                   
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>