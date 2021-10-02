<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Carbon\Carbon;
use App\Setting;
use App\NotificationTemplate;
use App\CompanySetting;
use App\PaymentSetting;
use App\GroceryShop;
use App\GroceryCategory;
use App\GrocerySubCategory;
use App\GroceryItem;
use App\GroceryOrder;
use App\User;
use App\Faq;
use App\Notification;
use App\Currency;
use App\Location;
use App\Coupon;
use App\Banner;
use App\UserAddress;
use Auth;
use Hash;
use App\Wishlist;
use App\Mail\UserVerification;
use App\Mail\ForgetPassword;
use App\Mail\OrderCreate;
use Illuminate\Support\Facades\Mail;
class UserApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);

        $data = $request->all();

        $userdata = array(
            'email'     => $request->email,
            'password'  => $request->password,
            'role' => 0,
            'status' => 0,
        );
        if(Auth::attempt($userdata)){
            $user_verify = Setting::where('id',1)->first()->user_verify;
            $user = Auth::user();
            if($user_verify==1){
                if(Auth::user()->verify == 1){
                    if(isset($data['device_token']))
                        User::findOrFail(Auth::user()->id)->update(['device_token'=>$data['device_token']]);
                    $user['token'] = $user->createToken('Gambo')->accessToken;
                    return response()->json(['msg' => "login Successfully", 'data' => $user, 'success'=>true], 200);
                }
                else{
                    return response()->json(['msg' => 'Please Verify Your Phone number.', 'success'=>false], 200);
                }
            }
            else if($user_verify==0){
                $user['token'] = $user->createToken('Gambo')->accessToken;
                return response()->json(['msg' => "login Successfully", 'data' => $user, 'success'=>true], 200);
            }
        }
        else{
            return response()->json(['msg' => 'Invalid Username or password', 'data' => null,'success'=>false], 400);
        }
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'phone' => 'bail|required',
            'phone_code' => 'bail|required',
            'confirm_password' => 'bail|required|same:password|min:6',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['otp'] = mt_rand(100000,999999);
        $data['image'] = 'user.png';
        
        $user_verify = Setting::where('id',1)->first()->user_verify;
        if($user_verify == 1){
            $data['verify'] = 0;
            $data1 = User::create($data);
            return response()->json(['msg' => 'Register Successfully!', 'data' => $data1,'success'=>true], 200);
        }
        else if($user_verify == 0){
            $data['verify'] = 1;
            $data1 = User::create($data);
            $user = User::findOrFail($data1->id);
            $user['token'] = $user->createToken('Gambo')->accessToken;
            return response()->json(['msg' => 'Register Successfully!', 'data' => $user,'success'=>true], 200);
        }
    }

    public function sendotp(Request $request)
    {
        $request->validate([
            'email' => 'bail|required',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user){
            $setting = Setting::where('id',1)->first(['id','twilio_account_id','twilio_auth_token','twilio_phone_number','phone_verify','email_verify']);
            $content = NotificationTemplate::where('title','User Verification')->first()->mail_content;
            $message = NotificationTemplate::where('title','User Verification')->first()->message_content;

            $otp = mt_rand(100000,999999);
            $detail['name'] = $user->name;
            $detail['otp'] = $otp;
            $detail['shop_name'] = CompanySetting::where('id',1)->first()->name;
            User::findOrFail($user->id)->update(['otp'=>$otp]);
            if($setting->phone_verify==1){
                $data = ["{{name}}", "{{otp}}", "{{shop_name}}"];
                $message1 = str_replace($data, $detail, $message);
                try{
                    $sid =$setting->twilio_account_id;
                    $token = $setting->twilio_auth_token;
                    $client = new Client($sid, $token);
                    $client->messages->create(
                        $user->phone_code.$user->phone,
                        array(
                            'from' => $setting->twilio_phone_number,
                            'body' => $message1
                        )
                    );
                } catch (\Exception $e) {}
                return response()->json(['msg' => 'OTP will send in your phone, plz check it!', 'success'=>true], 200);

            }
            else if($setting->email_verify==1){
                try{
                    Mail::to($user->email)->send(new UserVerification($content,$detail));
                } catch (\Exception $e) {
                    return response()->json(['msg' => 'OTP will send in your email, plz check it!', 'success'=>true], 200);
                }
            }
        }
        else{
            return response()->json(['msg' => 'Invalid User ID.', 'data' => null,'success'=>false], 400);
        }
    }

    public function checkotp(Request $request)
    {
        $request->validate([
            'otp' => 'bail|required|numeric',
            'user_id' => 'bail|required',
        ]);

        $user = User::where([['id',$request->user_id],['otp',$request->otp]])->first();
        if($user){
            User::findOrFail($user->id)->update(['verify'=>1]);
            $user = User::findOrFail($user->id);
            $user['token'] = $user->createToken('Gambo')->accessToken;
            return response()->json(['msg' => 'OTP matched', 'data' => $user,'success'=>true], 200);
        }
        else{
            return response()->json(['msg' => 'Invalid OTP code.','success'=>false], 400);
        }
    }

    public function forgetpassword(Request $request)
    {
        $request->validate( [
            'email' => 'bail|required|email',
        ]);

        $user = User::where([['email',$request->email],['role',0]])->first();
        $password = mt_rand(100000,999999);
        if($user){
            $content = NotificationTemplate::where('title','Forget Password')->first()->mail_content;
            $detail['name'] = $user->name;
            $detail['password'] = $password;
            $detail['shop_name'] = CompanySetting::where('id',1)->first()->name;
            try{
                Mail::to($user->email)->send(new ForgetPassword($content,$detail));
            } catch (\Exception $e) {}
            User::findOrFail($user->id)->update(['password'=>Hash::make($password)]);
            return response()->json(['success'=>true,'msg'=>'new password is Send in your mail.'], 200);
        }
        else{
            return response()->json(['success'=>false,'msg'=>'Invalid Email ID'], 400);
        }
    }

    public function settings()
    {
        $data = PaymentSetting::findOrFail(1);
        $key = Setting::where('id',1)->first(['push_notification','onesignal_app_id','onesignal_project_number','currency','map_key']);
        $key['currency_symbol'] =  Currency::where('code',$key->currency)->first()->symbol;
        $setting = array_merge($data->toArray(), $key->toArray());
        return response()->json(['msg' => 'settings', 'data' => $setting,'success'=>true], 200);
    }
    
    public function location()
    {
        $locations = Location::where('status',0)->orderBy('id','desc')->get();
        $arr = array();
        foreach ($locations as $key => $location) {
            $shops = GroceryShop::where([['status',0],['location',$location->id]])->get();
            foreach ($shops as $key_shop => $shop) {
                $item = GroceryItem::where([['status',0],['shop_id',$shop->id]])->first();
                array_push($arr, $location->id);
            }
        }
        $locations = Location::whereIn('id',$arr)->orderBy('id','desc')->get();
        return response()->json(['msg' => null, 'data' => $locations,'success'=>true], 200);
    }

    public function category()
    {
        $category = GroceryCategory::where('status',0)->orderBy('id','desc')->get();
        return response()->json(['msg' => "All categories",'data' =>$category ,'success'=>true], 200);
    }

    public function faq()
    {
        $faq = Faq::where('status',0)->orderBy('id','desc')->get();
        return response()->json(['msg' => "FAQs",'data' =>$faq ,'success'=>true], 200);
    }

    public function home(Request $request)
    {
        $request->validate( [
            'location_id' => 'bail|required',
        ]);
        $location_id = $request->location_id;

        $data['category'] = GroceryCategory::where('status',0)->orderBy('id','desc')->get(['id','name','image']);

        $data['banner'] = Banner::where('status',0)->orderBy('id','desc')->get(['id','title1','title2','url','off','image']);

        $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');

        $data['new_product'] = GroceryItem::where('status',0)
            ->whereIn('shop_id',$shop_ids)
            ->orderBy('id','desc')->take(10)->get(['id', 'name', 'category_id','subcategory_id','shop_id', 'sell_price','fake_price','image','stock']);

        $data['top_featured'] = GroceryItem::where([['status',0],['top_featured',1]])
            ->whereIn('shop_id',$shop_ids)
            ->orderBy('id','desc')->take(10)->get(['id', 'name', 'category_id','subcategory_id','shop_id', 'sell_price','fake_price','image','stock']);

        return response()->json(['msg' => null, 'data' => $data,'success'=>true], 200);
    }

    public function banners()
    {
        $data = Banner::where('status',0)->orderBy('id', 'DESC')->get(); 
        return response()->json(['data' =>$data ,'success'=>true], 200);
    }
    
    public function coupons(Request $request)
    {
        $request->validate( [
            'location_id' => 'bail|required',
        ]);

        $location_id = $request->location_id;
        $data = Coupon::where([['status',0],['location_id',$request->location_id]])
            ->orderBy('id','desc')->get();

        return response()->json(['msg' => "All Coupons", 'data' => $data,'success'=>true], 200);
    }
    
    public function checkCoupon(Request $request)
    {
        $request->validate( [
            'code' => 'bail|required',
        ]);
        $date = Carbon::now()->format('Y-m-d');

        $data = Coupon::where([['code',$request->code],['status',0]])->first();
        if($data){
            if (Carbon::parse($date)->between(Carbon::parse($data->start_date),Carbon::parse($data->end_date))){
                if($data->max_use<=$data->use_count){
                    return response()->json(['success'=>false,'msg'=>'This coupon is expire!' ,'data' =>null ], 200);
                }
                else{
                    return response()->json(['success'=>true,'msg'=>'coupon applied' ,'data' =>$data ], 200);
                }
            }
            else{
                return response()->json(['success'=>false,'msg'=>'This coupon is expire!' ,'data' =>null ], 200);
            }
        }
        else{
            return response()->json(['success'=>false,'msg'=>'Invalid Coupon code!' ,'data' =>null ], 200);
        }
    }

    public function viewProfile()
    {
        $user = User::find(Auth::user()->id);
        return response()->json(['msg' => "Your profile", 'data' => $user,'success'=>true], 200); 
    }
    
    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'dob' => 'bail|required',
            'phone_code' => 'bail|required',
            'phone' => 'bail|required|numeric|',
        ]);
        $data['name']= $request->name;
        $data['dateOfBirth']= $request->dob;
        $data['phone']= $request->phone;
        $data['phone_code']= $request->phone_code;

        User::findOrFail(Auth::user()->id)->update($data);
        $data = User::findOrFail(Auth::user()->id);

        return response()->json(['msg' => null, 'data' => $data,'success'=>true], 200);
    }

    public function changeImage(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'image' => 'bail|required',
            // 'image_type' => 'bail|required',
        ]);

        $user = User::findOrFail($id);
        if(isset($request->image))
        {
            if($user->image != "user.png")
            {
                if(\File::exists(public_path('/images/upload/'. $user->image))){
                    \File::delete(public_path('/images/upload/'. $user->image));
                }
            }
            $img = $request->image;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data1 = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/upload/') . $Iname . ".png";
            $success = file_put_contents($file, $data1);
            $image=$Iname . ".png";
        }
        User::findOrFail($id)->update(['image'=>$image]);
        return response()->json(['msg' => null, 'data' => $user,'success'=>true], 200);

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6','same:new_password'],
        ]);
        if (Hash::check($request->current_password, Auth::user()->password))
        {
            $password = Hash::make($request->new_password);
            User::find(Auth::user()->id)->update(['password'=>$password]);
        }
        return response()->json(['success'=>true,'msg'=>'Your password is change successfully','data' =>null ], 200);
    }
    
    public function allAddress()
    {
        $address = UserAddress::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        return response()->json(['msg' => null, 'data' => $address,'success'=>true], 200);
    }

    public function addAddress(Request $request)
    {
        $request->validate( [
            'address_type' => 'bail|required',
            'soc_name' => 'bail|required',
            'street' => 'bail|required',
            'city' => 'bail|required',
            'zipcode' => 'bail|required',
            'lat' => 'bail|required|numeric',
            'lang' => 'bail|required|numeric',
        ]);
        $data=$request->all();
        $data['user_id'] = Auth::user()->id;
        $address = UserAddress::create($data);
        $user = User::findOrFail(Auth::user()->id);
        if($user->address_id==null){
            User::findOrFail($user->id)->update(['address_id'=>$address->id,'lat'=>$address->lat,'lang'=>$address->lang]);
        }
        return response()->json(['msg' => "Address Created Successfully",'success'=>true], 200);
    }

    public function editAddress(Request $request)
    {
        $request->validate( [
            'address_id' => 'bail|required',
            'address_type' => 'bail|required',
            'soc_name' => 'bail|required',
            'street' => 'bail|required',
            'city' => 'bail|required',
            'zipcode' => 'bail|required',
            'lat' => 'bail|required|numeric',
            'lang' => 'bail|required|numeric',
        ]);

        $data = $request->all();
        $address = UserAddress::findOrFail($request->address_id)->update($data);
        return response()->json(['msg' => 'Address Updated Successfully','success'=>true], 200);
    }

    public function deleteAddress($id)
    {
        $used = GroceryOrder::where('address_id',$id)->first();
        if(isset($used))
        {
            return response()->json(['msg' => "Address is in use", 'success'=>false], 200); 
        }
        $delete = UserAddress::findOrFail($id);
        $delete->delete();
        return response()->json(['msg' => "Address Deleted Successfully", 'success'=>true], 200);
    }

    public function viewWishlist()
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $data['wishlist'] = Wishlist::with('groceryItem')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return response()->json(['msg' => "Your Wishlist", 'data' => $data,'success'=>true], 200);
    }
    
    public function updateWishlist($id)
    {
        $has = Wishlist::where([['user_id',Auth::user()->id],['item_id',$id]])->first();
        if (isset($has)) {
            $has->delete();
            return response()->json(['msg' => "Removed From Wishlist", 'data' => 0 , 'success' => true], 200);
        } else {
            $data['user_id'] = Auth::user()->id;
            $data['item_id'] = $id;
            Wishlist::create($data);
            return response()->json(['msg' => "Added To Wishlist", 'data' => 1 , 'success' => true], 200);
        }
    }

    public function notifications()
    {
        $data = Notification::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();   
        return response()->json(['msg' => "Notifications", 'data' => $data,'success'=>true], 200);
    }

    public function orders()
    {
        $data['all'] = GroceryOrder::with(['customer','deliveryGuy'])
        ->where('customer_id',Auth::user()->id)
        ->orderBy('id', 'DESC')->get();
        return response()->json(['msg' => "All Orders", 'data' => $data,'success'=>true], 200);
    }

}