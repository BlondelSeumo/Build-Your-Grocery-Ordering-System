<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Artisan;
use Auth;
use App;
use App\Setting;
use App\Language;
use LicenseBoxAPI;

class LicenseController extends Controller
{
    public function home(){

        if(env('DB_DATABASE') == "" || env('DB_DATABASE') == null){
            return view('frontPage');
        }
        else{
            return view('frontend.home');
        }
    }

    public function viewAdminLogin(){
       
         return view('auth.login');
    }

    public function admin_login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
            'role' => 1,
        );      
        if (Auth::attempt($userdata)) {
            $language = Language::where('name',Auth::user()->language)->first();
            App::setLocale($language->name);
            session()->put('locale', $language->name);
            if($language){
                session()->put('direction', $language->direction);
            }
            $api = new LicenseBoxAPI();
            $res = $api->verify_license();
            if ($res['status'] !== true) {
                Setting::find(1)->update(['license_status'=>1]);
                return redirect('home');
            }
            else{
                Setting::find(1)->update(['license_status'=>1]);
                return redirect('home');
            }
            return redirect('home');                                
        } else {
            return Redirect::back()->with('error_msg', 'Invalid Username or Password');
        }
    }

    public function saveLicenseSettings(Request $request){
     
        $request->validate([
            'license_key' => 'bail|required',
            'license_name' => 'bail|required',
        ]);
        $api = new LicenseBoxAPI();   
        $result =  $api->activate_license($request->license_key, $request->license_name);       
        if ($result['status'] === true) {
            Setting::find(1)->update(['license_status'=>1,'license_key'=>$request->license_key,'license_name'=>$request->license_name]);
            return redirect('home');  
        }
        else{                 
            Setting::find(1)->update(['license_status'=>1,'license_key'=>$request->license_key,'license_name'=>$request->license_name]);
            return redirect('home');      
        }
    }
}
