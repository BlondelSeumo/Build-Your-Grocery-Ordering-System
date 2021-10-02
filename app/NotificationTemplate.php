<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationTemplate extends Model
{
    //
    // use SoftDeletes;
    protected $fillable = [
        'title', 'subject', 'mail_content','message_content','image',
    ];

    protected $table = 'notification_template';    
}
