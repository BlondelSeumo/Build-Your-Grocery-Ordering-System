<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    //
    protected $fillable = [
        'user_id', 'name', 'email', 'subject', 'message'
    ];

    protected $table = 'user_request';

}
