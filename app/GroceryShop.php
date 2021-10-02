<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryShop extends Model
{
    //

    protected $fillable = [
        'name', 'description', 'location','category_id','image', 'address', 'latitude', 'longitude','phone','radius',
        'status','user_id','open_time','close_time','cover_image',
    ];

    protected $table = 'grocery_shop';
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function locationData()
    {
        return $this->hasOne('App\Location', 'id', 'location');
    }

    protected $appends = [ 'imagePath'];

    public function getImagePathAttribute()
    {
        return url('images/upload') . '/';
    }

}
