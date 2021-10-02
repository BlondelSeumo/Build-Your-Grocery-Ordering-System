<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Support\Facades\Hash;
use App\User;
use Artisan;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function saveEnvData(Request $request){

        $request->validate([
            'email' => 'bail|required',
            'password' => 'bail|required|min:6',
        ]);

        $data['DB_HOST']=$request->db_host;
        $data['DB_DATABASE']=$request->db_name;
        $data['DB_USERNAME']=$request->db_user;
        $data['DB_PASSWORD']=$request->db_pass;

        $envFile = app()->environmentFilePath();

        if($envFile){
            $str = file_get_contents($envFile);
            if (count($data) > 0) {
                foreach ($data as $envKey => $envValue) {
                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
            }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)){
                return response()->json(['data' => null,'success'=>false], 200);
            }  
            Artisan::call('config:clear'); 
            Artisan::call('cache:clear');  
            return response()->json([ 'data' => null,'success'=>true], 200);             
        }
    }
        
    public function saveAdminData(Request $request){
        
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
      
        Artisan::call('config:clear'); 
        Artisan::call('cache:clear');       
            
        User::where('role',1)->update(['email'=>$request->email,'password'=>Hash::make($request->password)]);
        Setting::find(1)->update(['license_status'=>1,'license_key'=>$request->license_code,'license_name'=>$request->client_name]);            
        return response()->json([ 'data' => url('login'),'success'=>true], 200); 
    }
}
