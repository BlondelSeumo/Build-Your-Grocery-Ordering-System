<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryOrder extends Model
{
    protected $fillable = [
        'order_no', 'owner_id','location_id','customer_id','deliveryBoy_id','payment','discount','payment_type',
        'order_status','payment_status','payment_token','delivery_charge','items',
        'coupon_id','coupon_price','time','date','address_id',
    ];

    protected $table = 'grocery_order';

    public function customer() 
    {
        return $this->hasOne('App\User', 'id', 'customer_id');
    }

    public function deliveryGuy()
    {
        return $this->hasOne('App\User', 'id', 'deliveryBoy_id');
    }
    
    public function orderItem()
    {
        return $this->hasMany('App\GroceryOrderChild', 'order_id', 'id');
    }
    public function address()
    {
        return $this->hasOne('App\UserAddress', 'id', 'address_id');
    }
    public function location()
    {
        return $this->hasOne('App\Location', 'id', 'location_id');
    }

    protected $appends = ['orderItems'];

    public function getOrderItemsAttribute()
    {
         return GroceryOrderChild::where('order_id',$this->attributes)->get();
    }


}
