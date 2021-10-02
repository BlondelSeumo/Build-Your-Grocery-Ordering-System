<!-- Add Address Model Start-->
<div id="address_edit_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
    <div class="modal-dialog category-area" role="document">
        <div class="category-area-inner">
            <div class="modal-header">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <i class="uil uil-multiply"></i>
                </button>
            </div>
            <div class="category-model-content modal-content"> 
                <div class="cate-header">
                    <h4> {{__('Edit Address')}} </h4>
                </div>
                <div class="add-address-form">
                    <div class="checout-address-step">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form" action="{{url('/profile/addressEdit')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="product-radio">
                                            <ul class="product-now">
                                                <li>
                                                    <input type="radio" id="Home" name="address_type" value="Home">
                                                    <label for="Home"> {{__('Home')}} </label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="Office" name="address_type" value="Office">
                                                    <label for="Office"> {{__('Office')}} </label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="Other" name="address_type" value="Other">
                                                    <label for="Other"> {{__('Other')}} </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="address-fieldset">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"> {{__('Flat / House / Office No.')}}* </label>
                                                    <input id="soc_name_edit" name="soc_name" type="text" placeholder="Address" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"> {{__('Street / Society / Office Name')}}* </label>
                                                    <input id="street_edit" name="street" type="text" placeholder="Street Address" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Pincode')}}*</label>
                                                    <input id="pincode_edit" name="zipcode" type="text" placeholder="Pincode" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('City')}}*</label>
                                                    <input id="city_edit" name="city" type="text" placeholder="Enter City" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="lat_edit" name="lat">
                                                    <input type="hidden" id="lang_edit" name="lang">

                                                    <input type="hidden" id="id_edit" name="id">
                                                    <div class="mapsize_address my-0 mx-auto mb-4" id="location_map_edit"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-0">
                                                    <div class="address-btns">
                                                        <button class="save-btn14 hover-btn">{{__('Save Changes')}}</button>
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