<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->group(function()
{
    Route::post('/login','UserApiController@login');
    Route::post('/register','UserApiController@register');
    Route::post('/sendotp','UserApiController@sendotp');
    Route::post('/checkotp','UserApiController@checkotp');
    Route::post('/forgetpassword','UserApiController@forgetpassword');
    Route::get('/settings','UserApiController@settings');

    Route::get('/all-locations','UserApiController@location');
    Route::get('/all-category','UserApiController@category');
    Route::get('/banners','UserApiController@banners');
    Route::get('/faq','UserApiController@faq');
    
    Route::post('coupons','UserApiController@coupons');
    Route::post('check-coupon','UserApiController@checkCoupon');
    Route::post('/home','UserApiController@home');    

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/view-profile','UserApiController@viewProfile');
        Route::post('/edit-profile','UserApiController@editProfile'); 
        Route::post('/change-image','UserApiController@changeImage');
        Route::post('/change-password','UserApiController@changePassword');
        Route::get('/view-address','UserApiController@allAddress');
        Route::post('/add-address','UserApiController@addAddress');
        Route::post('/edit-address','UserApiController@editAddress');
        Route::get('/delete-address/{id}','UserApiController@deleteAddress');
        Route::get('/view-wishlist','UserApiController@viewWishlist');
        Route::get('/update-wishlist/{id}','UserApiController@updateWishlist');
        Route::get('/notifications','UserApiController@notifications');

        Route::get('/all-orders','UserApiController@orders');
    });
});