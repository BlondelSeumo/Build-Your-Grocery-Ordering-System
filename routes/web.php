<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create sometshing great!
|
 */
 
//  website
Route::group(['middleware' => ['location']], function () {

    Route::get('/', 'FrontendController@home');
    
    Route::get('/setLocation/{id}', 'FrontendController@setLocation');
    Route::get('/signin', 'FrontendController@signin')->name('signin');
    Route::post('/signin', 'FrontendController@signinPost');
    
    Route::get('/signup', 'FrontendController@signup');
    Route::post('/signup', 'FrontendController@signupPost');
    
    Route::get('/forgot-password', 'FrontendController@forgotPassword');
    Route::post('/forgot-password', 'FrontendController@forgotPasswordPost');
    
    Route::get('/forgot-password', 'FrontendController@forgotPassword');
    Route::get('/verify-otp', 'FrontendController@verifyView')->name('otp');
    Route::post('/check-otp', 'FrontendController@checkOTP');
    
    
    Route::get('/contact-us', 'FrontendController@contactUs');
    Route::post('/user-request-post', 'FrontendController@userRequest');
    Route::get('/offers', 'FrontendController@offers');
    Route::get('/faq', 'FrontendController@faq');
    Route::post('/products', 'FrontendController@products');
    
    Route::post('/get-product-details', 'FrontendController@getProductDetails');
    
    
    Route::get('/wishlist/{item_id}', 'FrontendController@addToWishlist');
    Route::get('/wishlist/remove/{item_id}', 'FrontendController@removeFromWishlist');
    
    Route::get('/all-categories', 'FrontendController@allCategory');
    
    Route::match(array('GET','POST'),'/category/{id}/{name}', 'FrontendController@categotyProduct');
    Route::match(array('GET','POST'),'/all-products', 'FrontendController@allProducts');
    Route::match(array('GET','POST'),'/featured-products', 'FrontendController@featuredProducts');
    Route::match(array('GET','POST'),'/product/{id}/{name}', 'FrontendController@singleProduct');
    
    Route::post('/add-to-cart', 'FrontendController@addToCart');
    Route::post('/remove-from-cart', 'FrontendController@removeFromCart');
    Route::get('/checkout', 'FrontendController@checkout');
    Route::get('/checkCoupon/{code}', 'FrontendController@checkCoupon');
    
    Route::get('/create-payment/{id}', 'FrontendController@makePayment');
    Route::get('/transction_verify/{id}', 'FrontendController@transction_verify');
    
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/profile/dashboard', 'FrontendController@dashboard');
        Route::get('/profile/wishlist', 'FrontendController@wishlist');
        Route::get('/profile/view', 'FrontendController@profileView');
        Route::get('/profile/change-password', 'FrontendController@changePassword');
        Route::post('/profile/change-password', 'FrontendController@changePasswordPost');
        Route::get('/profile/orders', 'FrontendController@profileOrders');
        Route::post('/profile/update', 'FrontendController@profileUpdate');
        Route::get('/profile/address', 'FrontendController@profileAddress');
        Route::get('/profile/addressView/{address_id}', 'FrontendController@addressView');
        Route::post('/profile/addressAdd', 'FrontendController@addressAdd');
        Route::post('/profile/addressEdit', 'FrontendController@addressEdit');
        Route::get('/profile/addressDelete/{address_id}', 'FrontendController@addressDelete');
    
        Route::post('/place-order', 'FrontendController@placeOrder');
        Route::get('/order-placed/{order_id}', 'FrontendController@orderPlaced');
        Route::get('/invoice/{order_id}', 'FrontendController@invoice');
    
    });
});

//  website over

Auth::routes();
Route::get('/login', 'LicenseController@viewAdminLogin')->name('login');
Route::post('saveEnvData', 'AdminController@saveEnvData');
Route::post('saveAdminData', 'AdminController@saveAdminData');
Route::post('/admin_login', 'LicenseController@admin_login');
Route::get('/ResetPassword', 'CustomerController@ResetPassword');
Route::post('/reset_password', 'CustomerController@reset_password');

Route::get('/changeLanguage/{locale}', 'CustomerController@changeLanguage');
Route::group(['middleware' => ['auth','admin']], function () {
    
    Route::resources([      
        'GrocerySubCategory' => 'GrocerySubCategoryController',
        'GroceryShop'=>'GroceryShopController',
        'GroceryItem' => 'GroceryItemController',
        'GroceryOrder' => 'GroceryOrderController',
        'GroceryCoupon' => 'GroceryCouponController',
        'OwnerSetting' => 'CompanySettingController',
        'NotificationTemplate' => 'NotificationTemplateController',
        'Location' => 'LocationController',
        'Customer' => 'CustomerController',
        'adminSetting' => 'CompanySettingController',
        'Language' => 'LanguageController',
        'GroceryCategory'=> 'GroceryCategoryController',
        'Banner' => 'BannerController',
        'Faq' => 'FaqController',
        'user-request' => 'UserRequestController'
    ]);

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/viewUsers', 'CustomerController@viewUsers');
    Route::get('/customerReport', 'CustomerController@customerReport');
    Route::get('/ownerProfile', 'CustomerController@ownerProfileform');
    Route::post('/editOwnerProfile', 'CustomerController@editOwnerProfile');
    Route::post('/changeOwnerPassword', 'CustomerController@changeOwnerPassword');
    Route::post('/changeGroceryOrderStatus', 'GroceryOrderController@changeGroceryOrderStatus');
    Route::post('/changeGroceryOrderPaymentStatus', 'GroceryOrderController@changeGroceryOrderPaymentStatus');
    Route::get('/accept-grocery-order/{id}', 'GroceryOrderController@accpetOrder');
    Route::get('/reject-grocery-order/{id}', 'GroceryOrderController@rejectOrder');
    Route::get('/viewGroceryOrder/{id}', 'GroceryOrderController@viewsingleOrder');
    Route::get('/groceryOrderInvoice/{id}', 'GroceryOrderController@orderInvoice');
    Route::get('/printGroceryInvoice/{id}', 'GroceryOrderController@printGroceryInvoice');
    Route::get('/groceryRevenueReport', 'GroceryOrderController@groceryRevenueReport');
    Route::post('/groceryRevenueFilter', 'CustomerController@groceryRevenueFilter');
    Route::get('/shopCategory/{shop_id}', 'GroceryShopController@shopCategory');
    Route::get('/itemSubcategory/{category_id}', 'GroceryShopController@itemSubcategory');   
    
    Route::get('/downloadSampleJson', 'CompanySettingController@downloadSampleJson');
 
    Route::get('/deliveryGuys', 'CustomerController@deliveryGuys'); 
    Route::post('/savePaymentSetting', 'CompanySettingController@savePaymentSetting');
    Route::post('/saveLicense', 'LicenseController@saveLicenseSettings');    
    Route::post('/saveNotificationSettings', 'CompanySettingController@saveNotificationSettings');
    Route::post('/saveMailSettings', 'CompanySettingController@saveMailSettings');
    Route::post('/saveSMSSettings', 'CompanySettingController@saveSMSSettings');
    Route::post('/saveSettings', 'CompanySettingController@saveSettings');
    Route::post('/saveMapSettings', 'CompanySettingController@saveMapSettings');
    Route::post('/saveCommissionSettings', 'CompanySettingController@saveCommissionSettings');
    Route::post('/saveVerificationSettings', 'CompanySettingController@saveVerificationSettings');

    Route::post('/default-language', 'CompanySettingController@saveDefaultLanguage');
    Route::post('/addDriver', 'CustomerController@addDriver');
    Route::get('/Delivery-guy/create', 'CustomerController@addDeliveryBoy');
    Route::get('/Driver/edit/{id}', 'CustomerController@editDriver');
    Route::post('/updateDriver/{id}', 'CustomerController@updateDriver');
    Route::post('/changelangStatus', 'LanguageController@changelangStatus');
    Route::post('/sendTestMail', 'NotificationTemplateController@sendTestMail');

    Route::get('/GroceryItem/gallery/{id}/edit', 'GroceryItemController@viewGallery');
    Route::get('/GroceryItem/gallery/{id}/add', 'GroceryItemController@addGallery');
    Route::post('/GroceryItem/gallery/{id}/store', 'GroceryItemController@storeGallery');
    Route::delete('/GroceryItem/gallery/{id}/delete/{name}', 'GroceryItemController@deleteGallery');

    Route::post('/changeGroceryOrderDriver', 'GroceryOrderController@changeGroceryOrderDriver');
});
