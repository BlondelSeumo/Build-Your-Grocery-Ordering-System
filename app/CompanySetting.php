<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySetting extends Model
{
    // use SoftDeletes;
    protected $fillable = [
        'name', 'address', 'location', 'phone', 'email', 'logo', 'favicon', 'description', 'website','logo_dark','responsive_logo','language'
    ];

    protected $table = 'company_setting';
}
