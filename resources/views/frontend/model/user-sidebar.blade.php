<div class="col-lg-3 col-md-4">
    <div class="left-side-tabs">
        <div class="dashboard-left-links">
            <a href="{{url('/profile/dashboard')}}" class="user-item {{ request()->is('profile/dashboard')  ? 'active' : ''}}">
                <i class="uil uil-apps"></i> {{__('Overview')}}
            </a>
            <a href="{{url('/profile/view')}}" class="user-item {{ request()->is('profile/view')  ? 'active' : ''}}">
                <i class="uil uil-user"></i> {{__('Profile')}}
            </a>
            <a href="{{url('/profile/change-password')}}" class="user-item {{ request()->is('profile/change-password')  ? 'active' : ''}}">
                <i class="uil uil-padlock"></i> {{__('Change Password')}}
            </a>
            <a href="{{url('/profile/orders')}}" class="user-item {{ request()->is('profile/orders')  ? 'active' : ''}}">
                <i class="uil uil-box"></i> {{__('My Orders')}}
            </a>
            <a href="{{url('/profile/wishlist')}}" class="user-item {{ request()->is('profile/wishlist')  ? 'active' : ''}}">
                <i class="uil uil-heart"></i> {{__('Shopping Wishlist')}}
            </a>
            <a href="{{url('/profile/address')}}" class="user-item {{ request()->is('profile/address')  ? 'active' : ''}}">
                <i class="uil uil-location-point"></i> {{__('My Address')}}
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="user-item">
                <i class="uil uil-exit"></i> {{__('Logout')}}
            </a>
        </div>
    </div>
</div>