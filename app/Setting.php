<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    //
    // use SoftDeletes;
    protected $fillable = [
        'currency', 'map_key', 'push_notification' ,'onesignal_api_key','onesignal_auth_key','onesignal_app_id','onesignal_project_number',
        'twilio_phone_number','twilio_account_id','twilio_auth_token', 'sms_twilio',
        'mail_notification','mail_host','mail_port','mail_username','mail_password','sender_email','mail_encryption',
        'delivery_charge_amount','delivery_charge_per','commission_amount','commission_per',
        'user_verify','phone_verify','email_verify','default_grocery_order_status',
        'license_key','license_name','license_status','lat','lang','delivery_charge','location','color'
    ];
    protected $table = 'general_setting';
}
