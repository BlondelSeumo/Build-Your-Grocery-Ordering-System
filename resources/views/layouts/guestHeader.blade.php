<div class="header py-7 py-lg-8" style="background-image: url({{url('admin/images/bg.jpg')}}); background-size: cover; background-position: center center;">
    <span class="mask bg-gradient-success opacity-3"></span>
    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
           
                <?php $logo = \App\CompanySetting::find(1)->logo; ?>
                <div class="col-lg-5 col-md-6 logo-login">
                    <h1 class="text-white"><img src="{{ url('images/upload/'.$logo)}}" class="navbar-brand-img" style="width: 250px;"></h1>
                </div>
            </div>
            
        </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>