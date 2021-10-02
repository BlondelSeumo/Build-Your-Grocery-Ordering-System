<div class="dashboard-group">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-dt">
                    <div class="user-img">
                        <img src="{{ Auth::user()->imagePath . Auth::user()->image }}" alt="">
                    </div>
                    <h4> {{Auth::user()->name}} </h4>
                    <p>
                        <a href="tel:{{Auth::user()->phone_code . Auth::user()->phone}}">
                            {{Auth::user()->phone_code . Auth::user()->phone}}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>