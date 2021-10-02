<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    protected $fillable = [
        'title','description','status'
    ];

    protected $table = 'faq';
}
