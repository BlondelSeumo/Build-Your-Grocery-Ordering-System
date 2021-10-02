<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentSetting extends Model
{
    //
    // use SoftDeletes;
    protected $fillable = [
        'cod', 'stripe', 'paypal','razor','whatsapp','paystack','flutterwave','stripePublicKey', 'stripeSecretKey', 
        'paypalSendbox', 'paypalProduction','razorPublishKey','razorSecretKey','flutterwave_public_key',
        'paystack_public_key'
    ];
    protected $table = 'payment_setting';
    
}
