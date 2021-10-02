<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $fillable = [
        'name', 'file','status','icon','direction'
    ];

    protected $table = 'language';

}
        