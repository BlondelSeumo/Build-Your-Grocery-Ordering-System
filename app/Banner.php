<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $fillable = [
        'title1','title2','off', 'status', 'image','url'
    ];

    protected $table = 'banner';

    protected $appends = [ 'imagePath'];

    public function getImagePathAttribute()
    {
        return url('images/upload') . '/';
    }
}
