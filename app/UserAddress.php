<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    //
    // use SoftDeletes;
    protected $fillable = [
        'user_id', 'address_type', 'soc_name', 'street', 'city', 'zipcode', 'lat','lang',  
    ];

    protected $table = 'user_address';
    
}
