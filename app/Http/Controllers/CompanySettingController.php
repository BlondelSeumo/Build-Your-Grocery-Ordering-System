<?php

namespace App\Http\Controllers;

use App\CompanySetting;
use App\PaymentSetting;
use App\Setting;
use Redirect;
use App\Currency;
use App\NotificationTemplate;
use App\Mail\TestMail;
use App\Language;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Location;
use Auth;

class CompanySettingController extends Controller
{
    public function index(){
        $companySetting = CompanySetting::findOrFail(1);
        $paymentSetting = PaymentSetting::findOrFail(1);
        $setting = Setting::findOrFail(1);
        $currency = Currency::get();
        $language = Language::get();
        $location = Location::where('status',0)->get();
        
        return view('admin.setting.setting',['companyData' => $companySetting,
        'language' => $language, 'paymentData' => $paymentSetting, 'setting' => $setting, 'currency' => $currency, 'location' => $location]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required_if:stripe,1',
            'address' => 'required_if:stripe,1',
            'phone' => 'required_if:paypal,1',
            'email' => 'required_if:paypal,1',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['logo'] = $name;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = uniqid() . '.' . $favicon->getClientOriginalExtension();
            $faviconPath = public_path('/images/upload');
            $favicon->move($faviconPath, $faviconName);
            $data['favicon'] = $faviconName;
        }
        
        if ($request->hasFile('logo_dark')) {
            $logo_dark = $request->file('logo_dark');
            $logo_darkName = uniqid() . '.' . $logo_dark->getClientOriginalExtension();
            $logo_darkPath = public_path('/images/upload');
            $logo_dark->move($logo_darkPath, $logo_darkName);
            $data['logo_dark'] = $logo_darkName;
        } 
        if ($request->hasFile('responsive_logo')) {
            $responsive_logo = $request->file('responsive_logo');
            $responsive_logoName = uniqid() . '.' . $responsive_logo->getClientOriginalExtension();
            $responsive_logoPath = public_path('/images/upload');
            $responsive_logo->move($responsive_logoPath, $responsive_logoName);
            $data['responsive_logo'] = $responsive_logoName;
        }

        CompanySetting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function savePaymentSetting(Request $request){

        $request->validate([
            'stripePublicKey' => 'required_if:stripe,1',
            'stripeSecretKey' => 'required_if:stripe,1',
            'paypalSendbox' => 'required_if:paypal,1',
            'paypalProduction' => 'required_if:paypal,1',
            'razorPublishKey' => 'required_if:razor,1',
            'razorSecretKey' => 'required_if:razor,1',
            'flutterwave_public_key' => 'required_if:flutterwave,1',
            'patstack_public_key' => 'required_if:patstack,1',
            'patstack_secret_key' => 'required_if:patstack,1',
        ]);
        $data = $request->all();
        if(isset($request->cod)){    $data['cod'] = 1;    }
        else{  $data['cod'] = 0;  }
         
        if(isset($request->whatsapp)){    $data['whatsapp'] = 1;    }
        else{  $data['whatsapp'] = 0;  }

        if(isset($request->razor)){    $data['razor'] = 1;    }
        else{  $data['razor'] = 0;  }
        
        if(isset($request->flutterwave)){    $data['flutterwave'] = 1;    }
        else{  $data['flutterwave'] = 0;  }

        if(isset($request->stripe)){    $data['stripe'] = 1;    }
        else{  $data['stripe'] = 0;  }

        if(isset($request->paypal)){    $data['paypal'] = 1;    }
        else{  $data['paypal'] = 0;  }
        
        if(isset($request->paystack)){    $data['paystack'] = 1;    }
        else{  $data['paystack'] = 0;  }

        PaymentSetting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function saveNotificationSettings(Request $request){
        $request->validate([
            'onesignal_app_id' => 'required_if:push_notification,1',
            'onesignal_project_number' => 'required_if:push_notification,1',
            'onesignal_api_key' => 'required_if:push_notification,1',
            'onesignal_auth_key' => 'required_if:push_notification,1',
        ]);

        $data1 = $request->all();
        if(isset($request->push_notification)){
            $data1['push_notification'] = 1;
        }
        else{
            $data1['push_notification'] = 0;
        }
        Setting::findOrFail(1)->update($data1);

        $data['APP_ID']=$request->onesignal_app_id;
        $data['REST_API_KEY']=$request->onesignal_api_key;
        $data['USER_AUTH_KEY']=$request->onesignal_auth_key;
        $data['PROJECT_NUMBER']=$request->onesignal_project_number;

        $this->update_env($data);
        return redirect('OwnerSetting');
    }

    public function saveMailSettings(Request $request){
        $request->validate([
            'mail_host' => 'bail|required_if:mail_notification,1',
            'mail_port' => 'bail|required_if:mail_notification,1',
            'mail_username' => 'bail|required_if:mail_notification,1',
            'mail_password' => 'bail|required_if:mail_notification,1',
            'sender_email' => 'bail|email|required_if:mail_notification,1',
            'mail_encryption' => 'bail|required_if:mail_notification,1',
        ]);
        $data1 = $request->all();
        if(isset($request->mail_notification)){  $data1['mail_notification'] = 1; }
        else{  $data1['mail_notification'] = 0; }
        Setting::findOrFail(1)->update($data1);

        $data['MAIL_HOST']=$request->mail_host;
        $data['MAIL_PORT']=$request->mail_port;
        $data['MAIL_USERNAME']=$request->mail_username;
        $data['MAIL_PASSWORD']=$request->mail_password;
        $data['MAIL_FROM_ADDRESS']=$request->sender_email;
        $data['MAIL_ENCRYPTION']=$request->mail_encryption;

        $this->update_env($data);
        return redirect('OwnerSetting');
    }

    public function saveSMSSettings(Request $request){
        $request->validate([
            'twilio_account_id' => 'required_if:sms_twilio,1',
            'twilio_auth_token' => 'required_if:sms_twilio,1',
            'twilio_phone_number' => 'required_if:sms_twilio,1',
        ]);

        $data = $request->all();
        if(isset($request->sms_twilio)){ $data['sms_twilio'] = 1; }
        else{ $data['sms_twilio'] = 0; }
        Setting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function saveSettings(Request $request){
        
        $request->validate([
            'currency' =>'bail|required',
            'default_grocery_order_status' =>'bail|required',
            'delivery_charge' =>'bail|required',
        ]);
        
        $data = $request->all();
        if($data['location'] == 0) {
            $data['location'] = null;
        }
        Setting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function saveDefaultLanguage(Request $request) {
        $data = $request->all();
        CompanySetting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function saveMapSettings(Request $request){
        $request->validate([
            'map_key' =>'bail|required',
        ]);
        $data = $request->all();
        Setting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function saveCommissionSettings(Request $request){
        $data = $request->all();
        Setting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function saveVerificationSettings(Request $request){
        $data = $request->all();
        if(isset($request->user_verify)){ $data['user_verify'] = 1; }
        else{ $data['user_verify'] = 0; }
        if(isset($request->phone_verify)){ $data['phone_verify'] = 1; }
        else{ $data['phone_verify'] = 0; }
        if(isset($request->email_verify)){ $data['email_verify'] = 1; }
        else{ $data['email_verify'] = 0; }
        Setting::findOrFail(1)->update($data);
        return redirect('OwnerSetting');
    }

    public function downloadSampleJson(){
        $pathToFile = public_path(). "/file/English.json";
        $name = 'Gambo_Language_Sample.json';
        $headers = array('Content-Type: application/pdf',);
        return response()->download($pathToFile, $name, $headers);
    }
 
    public function update_env($data){
        $envFile = app()->environmentFilePath();
        if($envFile){
            $str = file_get_contents($envFile);
            if (count($data) > 0) {
                foreach ($data as $envKey => $envValue) {
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                  
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
            }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)){ return false;  }
            else{   return redirect('OwnerSetting');   }
        }
    }
}
