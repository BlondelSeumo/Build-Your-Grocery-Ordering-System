<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = [
        'user_id', 'order_id', 'title','message','image','driver_id'
    ];

    protected $table = 'notification';

    protected $appends = ['imagePath'];

    public function getImagePathAttribute()
    {
        return url('images/upload') . '/';
    }
}
