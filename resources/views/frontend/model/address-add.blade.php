<!-- Add Address Model Start-->
@php
    $setting = \App\Setting::first(['lat','lang']);
@endphp
<div id="address_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
    <div class="modal-dialog category-area" role="document">
        <div class="category-area-inner">
            <div class="modal-header">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <i class="uil uil-multiply"></i>
                </button>
            </div>
            <div class="category-model-content modal-content"> 
                <div class="cate-header">
                    <h4> {{__('Add New Address')}} </h4>
                </div>
                <div class="add-address-form">
                    <div class="checout-address-step">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form" action="{{url('/profile/addressAdd')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="product-radio">
                                            <ul class="product-now">
                                                <li>
                                                    <input type="radio" id="home_add" name="address_type" value="Home" checked>
                                                    <label for="home_add"> {{__('Home')}} </label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="office_add" name="address_type" value="Office">
                                                    <label for="office_add"> {{__('Office')}} </label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="other_add" name="address_type" value="Other">
                                                    <label for="other_add"> {{__('Other')}} </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="address-fieldset">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"> {{__('Flat / House / Office No.')}}* </label>
                                                    <input id="flat" name="soc_name" type="text" placeholder="Address" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"> {{__('Street / Society / Office Name')}}*</label>
                                                    <input id="street" name="street" type="text" placeholder="Street Address" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Pincode')}}*</label>
                                                    <input id="pincode" name="zipcode" type="text" placeholder="Pincode" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('City')}}*</label>
                                                    <input id="city" name="city" type="text" placeholder="Enter City" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-2">
                                                <div class="form-group">
                                                    <input type="hidden" value="{{$setting->lat}}" id="lat" name="lat">
                                                    <input type="hidden" value="{{$setting->lang}}" id="lang" name="lang">
                                                    <div class="mapsize_address my-0 mx-auto mb-4" id="location_map"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-0">
                                                    <div class="address-btns">
                                                        <button class="save-btn14 hover-btn">{{__('Add')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Address Model End-->