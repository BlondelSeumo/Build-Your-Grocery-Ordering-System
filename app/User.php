<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Auth;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','dateOfBirth','role','image','verify','otp','location','address_id','phone_code','language',
        'provider','provider_token','device_token','lat','lang',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['shops','imagePath','wishlistCount'];

    public function getShopsAttribute()
    {
        if(Auth::check()){
            if($this->attributes['role']==1){
                return GroceryShop::where('user_id',$this->attributes['id'])->get();
            }
            else{
                return [];
            }   
        }
        return [];
    }

    public function getImagePathAttribute()
    {
        return url('images/upload') . '/';
    }

    public function getWishlistCountAttribute()
    {
        if (Auth::check())
        {
            return Wishlist::where('user_id',Auth::user()->id)->count();
        } else
            return 0;
    }
}
