<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    //
    // use SoftDeletes;
    protected $fillable = [
        'name', 'code', 'location_id', 'description', 'type', 'discount', 'max_use', 'start_date', 'end_date','status','use_count','image',
    ];

    protected $table = 'coupon';

    protected $appends = ['imagePath'];

    public function getImagePathAttribute()
    {
        return url('images/upload') . '/';
    }
    
    public function location()
    {
        return $this->hasOne('App\Location', 'id', 'location_id');
    }
}
