<?php

namespace App\Http\Controllers;

use Artisan;
use Redirect;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\GroceryCategory;
use App\GrocerySubCategory;
use App\GroceryShop;
use App\GroceryItem;
use App\Banner;
use App\Coupon;
use App\Location;
use App\Currency;
use App\Setting;
use App\User;
use App\UserRequest;
use App\UserAddress;
use App\Wishlist;
use App\Faq;
use App\GroceryOrder;
use App\GroceryOrderChild;
use App\NotificationTemplate;
use App\Notification;
use App\CompanySetting;
use App\PaymentSetting;
use App\Language;
use App;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Stripe;

use App\Mail\UserVerification;
use App\Mail\ForgetPassword;
use App\Mail\OrderCreate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    public function signin()
    {
        return view('frontend.signin');
    }

    public function signinPost(Request $request)
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
        if(Auth::attempt($userdata)) {
            $user_verify = Setting::where('id',1)->first()->user_verify;
            $user = Auth::user();

            $language = Language::where('name',Auth::user()->language)->first();
            App::setLocale($language->name);
            session()->put('locale', $language->name);
            if($language){
                session()->put('direction', $language->direction);
            }

            if($user_verify==1){
                if(Auth::user()->verify == 1){
                    User::findOrFail(Auth::user()->id)->update(['user_verify' => 1]);
                    return redirect('/');
                }
                else{
                    $user = User::findOrFail(Auth::user()->id);
                    if($user){
                        $setting = Setting::where('id',1)->first(['id','twilio_account_id','twilio_auth_token','twilio_phone_number','email_verify','phone_verify']);
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
                        }
                        else if($setting->email_verify==1){
                            try{
                                Mail::to($user->email)->send(new UserVerification($content,$detail));
                            } catch (\Exception $e) {}
                        }
                        $user_id = Auth::user()->id;
                        session()->put('user_id', $user_id);
                        Auth::logout();
                        return Redirect::route('otp');
                    }
                    else{
                        return redirect()->back()->with('error','Invalid User ID');
                    }
                }
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect()->back()->with('error','Invalid Username or password');
        }
    }

    public function verifyView()
    {
        return view('frontend.otp');
    }

    public function checkOTP(Request $request)
    {
        $user_id  = session()->get('user_id');
        $user = User::where([['id',$user_id],['otp',$request->otp]])->first();
        if($user){
            User::findOrFail($user->id)->update(['verify'=>1]);
            $user = User::findOrFail($user->id);
            Session::forget('user_id');
            if(Auth::loginUsingId($user_id)){
                return redirect('/');
            }
        }
        else{
             return Redirect::back()->with('error','Invalid OTP');
        }
    }

    public function forgotPassword()
    {
        return view('frontend.forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        $user = User::where([['email',$request->email],['role',0]])->first();
        $password = rand(100000,999999);
        if($user){
            $content = NotificationTemplate::where('title','Forget Password')->first()->mail_content;
            $detail['name'] = $user->name;
            $detail['password'] = $password;
            $detail['shop_name'] = CompanySetting::where('id',1)->first()->name;
            try{
                Mail::to($user->email)->send(new ForgetPassword($content,$detail));
            } catch (\Exception $e) {}
            User::findOrFail($user->id)->update(['password'=>Hash::make($password)]);
            return Redirect::back()->with('success_msg','Please check your email new password will send on it.');
        }
        return Redirect::back()->with('error_msg','Invalid Email ID');
    }

    public function signup()
    {
        return view('frontend.signup');
    }

    public function signupPost(Request $request)
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
        $data['password']=Hash::make($data['password']);
        $data['otp'] = mt_rand(100000,999999);
        $data['image'] = 'user.png';

        $data['language'] = CompanySetting::first()->language;
        $user_verify = Setting::where('id',1)->first()->user_verify;
        if($user_verify==1){
            $data['verify'] = 0;
        }
        else if($user_verify==0){
            $data['verify'] = 1;
        }
        $data1 = User::create($data);

        $language = Language::where('name',$data['language'])->first();
        App::setLocale($language->name);
        session()->put('locale', $language->name);
        if($language){
            session()->put('direction', $language->direction);
        }

        if($user_verify == 1){    
            $user = User::findOrFail($data1->id);
            if($user){
                $setting = Setting::where('id',1)->first(['id','twilio_account_id','twilio_auth_token','twilio_phone_number','email_verify','phone_verify']);
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
                }
                else if($setting->email_verify==1){
                    try{
                        Mail::to($user->email)->send(new UserVerification($content,$detail));
                    } catch (\Exception $e) {}
                }
                $user_id = $data1->id;
                session()->put('user_id', $user_id);
                Auth::logout();
                return Redirect::route('otp');
            }
        }
        else if($user_verify==0){
            $userdata = array(
                'email'     => $request->email,
                'password'  => $request->password,
                'role' => 0,
                'status' => 0,
            );
            if(Auth::attempt($userdata)){
                return redirect('/');
            }
        }
    }

    public function setLocation($id)
    {
        $location = Location::find($id);
        session()->put('location_id', $location->id);
        session()->put('location_name', $location->name);
        session()->forget(['cart', 'coupon']);
        return redirect()->back();
    }

    public function products(Request $request)
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $query = "";
        if (isset($request['query'])) {
            $query = $request['query'];
        }
        $data['products'] = GroceryItem::where([['name','like','%'.$query.'%'],['status',0]])->orderBy('id','desc');
    
        if (session()->exists('location_id') && session()->exists('location_name')) {
            $location_id = session('location_id');
            $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');
            $data['products'] = $data['products']
                ->whereIn('shop_id',$shop_ids);
        }
        $data['products'] = $data['products']->get();
        
        $default_cat = GroceryCategory::where('status',0)->first();
        return view('frontend.search-products', compact('data','default_cat','query'));
    }

    public function wishlist()
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $data['wishlist'] = Wishlist::with('groceryItem')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('frontend.profile-wishlist', compact('data'));
    }
    
    public function addToWishlist($id)
    {
        if (!Auth::check()) {
            return response()->json(['msg' => "login required", 'success' => false], 200);
        }
        $has = Wishlist::where([['user_id',Auth::user()->id],['item_id',$id]])->first();
        if (isset($has)) {
            $has->delete();
            return response()->json(['msg' => "removed", 'data' => 0 , 'success' => true], 200);
        } else {
            $data['user_id'] = Auth::user()->id;
            $data['item_id'] = $id;
            Wishlist::create($data);
            return response()->json(['msg' => "added", 'data' => 1 , 'success' => true], 200);
        }
    }

    public function removeFromWishlist($id)
    {
        $has = Wishlist::where([['user_id',Auth::user()->id],['item_id',$id]])->first();
        if (isset($has)) {
            $has->delete();
            return response()->json(['msg' => "removed", 'success' => true], 200);
        }
    }

    public function contactUs()
    {
        $data['location'] = Location::where('status',0)->get();
        return view('frontend.contact-us', compact('data'));
    }

    public function offers()
    {
        $coupons = Coupon::where('status',0)->get();
        if (session()->exists('location_id') && session()->exists('location_name')) {
            $location_id = session('location_id');

            $coupons = Coupon::where([['status',0],['location_id',$location_id]])
                ->orderBy('id','desc')->get();
        }
        return view('frontend.offers', compact('coupons'));
    }

    public function faq()
    {
        $faq = Faq::where('status',0)->orderBy('id','desc')->get();
        return view('frontend.faq', compact('faq'));
    }

    public function userRequest(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email',
            'subject' => 'bail|required',
            'message' => 'bail|required',
        ]);
      
        $data = $request->all();
        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        }
        UserRequest::create($data);
        return redirect()->back()->withStatus(__('Request Sended Successfully.'));
    }

    public function home()
    {
        if(env('DB_DATABASE') == "" || env('DB_DATABASE') == null){
            return view('frontPage');
        }
        else{
            $currency_code = Setting::where('id',1)->first()->currency;
            $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
            $data['category'] = GroceryCategory::where('status',0)->orderBy('id','desc')->get();
            $data['banner'] = Banner::where('status',0)->orderBy('id','desc')->get();
            $data['coupon'] = Coupon::where('status',0)->orderBy('id','desc')->get();
            $cat = GrocerySubCategory::where('name','like','%fruit%')->orWhere('name','like','%vegetable%')->get()->pluck('id');
            $data['fruits_veg'] = GroceryItem::where('status',0)
                ->whereIn('subcategory_id',$cat)
                ->orderBy('id','desc')->get();

            $data['new_product'] = GroceryItem::where('status',0)
                ->orderBy('id','desc')->take(10)->get();

            $data['top_featured'] = GroceryItem::where([['status',0],['top_featured',1]])
                ->orderBy('id','desc')->take(10)->get();

            if (session()->exists('location_id') && session()->exists('location_name')) {
                $location_id = session('location_id');
                $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');

                $data['coupon'] = Coupon::where([['status',0],['location_id',$location_id]])
                    ->orderBy('id','desc')->get();

                $data['fruits_veg'] = GroceryItem::where('status',0)
                    ->whereIn('subcategory_id',$cat)
                    ->whereIn('shop_id',$shop_ids)
                    ->orderBy('id','desc')->get();
               
                $data['new_product'] = GroceryItem::where('status',0)
                    ->whereIn('shop_id',$shop_ids)
                    ->orderBy('id','desc')->take(10)->get();

                $data['top_featured'] = GroceryItem::where([['status',0],['top_featured',1]])
                    ->whereIn('shop_id',$shop_ids)
                    ->orderBy('id','desc')->take(10)->get();

            }
            return view('frontend.home',compact('data'));
        }
    }

    public function allCategory()
    {
        $data['category'] = GroceryCategory::where('status',0)->orderBy('id','desc')->get();
        return view('frontend.all-category', compact('data'));
    }

    public function allProducts(Request $request)
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $default_cat = GroceryCategory::where('status',0)->first();
        if(isset($default_cat))
        {
            if(isset($request->category_id)){
                $default_cat = GroceryCategory::find($request->category_id);
            }
            $data['category'] = GroceryCategory::where('status',0)->get();
    
            $data['products'] = GroceryItem::where([['status',0],['category_id',$default_cat->id]]);
            if (session()->exists('location_id') && session()->exists('location_name'))
            {
                $location_id = session('location_id');
                $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');
                $data['products'] = $data['products']
                    ->whereIn('shop_id',$shop_ids);
            }
            $data['products'] = $data['products']->get();
            $data['products'] = collect($data['products']->toArray());
            $data['products'] = $data['products']->sortByDesc('id');
            if (isset($request->sort)) {
                if($request->sort == "new"){
                    $data['products'] = $data['products']->sortByDesc('id');
                } elseif($request->sort == "price-asc"){
                    $data['products'] = $data['products']->sortBy('sell_price');
                } elseif($request->sort == "price-desc") {
                    $data['products'] = $data['products']->sortByDesc('sell_price');
                } elseif($request->sort == "alphabetical") {
                    $data['products'] = $data['products']->sortBy('name');
                } elseif($request->sort == "off-desc") {
                    $data['products'] = $data['products']->sortByDesc('off');
                }  elseif($request->sort == "off-asc") {
                    $data['products'] = $data['products']->sortBy('off');
                }
            }
            $data['products'] = $data['products']->paginate(4);
        }
        
        if($request->ajax())
        {
            $view = view('frontend.model.product2',compact('data','default_cat'))->render();
            return response()->json(['html' => $view, 'meta' => $data['products'], 'category' => $default_cat]);
        }
        return view('frontend.all-products', compact('data','default_cat'));
    }

    public function featuredProducts(Request $request)
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $default_cat = GroceryCategory::where('status',0)->first();
        if(isset($default_cat))
        {
            if(isset($request->category_id)){
                $default_cat = GroceryCategory::find($request->category_id);
            }
            $data['category'] = GroceryCategory::where('status',0)->get();
    
            $data['products'] = GroceryItem::where([['status',0],['category_id',$default_cat->id],['top_featured',1]]);
        
            if (session()->exists('location_id') && session()->exists('location_name')) {
                $location_id = session('location_id');
                $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');
                $data['products'] = $data['products']
                    ->whereIn('shop_id',$shop_ids);
            }
            $data['products'] = $data['products']->get();
            $data['products'] = collect($data['products']->toArray());
            $data['products'] = $data['products']->sortByDesc('id');
    
            if (isset($request->sort)) {
                if($request->sort == "new"){
                    $data['products'] = $data['products']->sortByDesc('id');
                } elseif($request->sort == "price-asc"){
                    $data['products'] = $data['products']->sortBy('sell_price');
                } elseif($request->sort == "price-desc") {
                    $data['products'] = $data['products']->sortByDesc('sell_price');
                } elseif($request->sort == "alphabetical") {
                    $data['products'] = $data['products']->sortBy('name');
                } elseif($request->sort == "off-desc") {
                    $data['products'] = $data['products']->sortByDesc('off');
                }  elseif($request->sort == "off-asc") {
                    $data['products'] = $data['products']->sortBy('off');
                }
            }
            $data['products'] = $data['products']->paginate(4);
        }
        
        if($request->ajax())
        {
            $view = view('frontend.model.product2',compact('data','default_cat'))->render();
            return response()->json(['html' => $view, 'meta' => $data['products'], 'category' => $default_cat]);
        }
        return view('frontend.all-products', compact('data','default_cat'));
    }

    public function singleProduct($id, $name)
    {
        $product = GroceryItem::find($id);
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $data['category'] = GroceryCategory::find($product->category_id);
        $data['top_featured'] = GroceryItem::where([['status',0],['top_featured',1],['id','!=',$id]])
            ->orderBy('id','desc')->take(10)->get();
        $data['like_this'] = GroceryItem::where([['status',0],['category_id',$product->category_id],['subcategory_id',$product->subcategory_id],['id','!=',$id]])
            ->orderBy('id','desc')->take(10)->get();

        if (session()->exists('location_id') && session()->exists('location_name')) {
            $location_id = session('location_id');
            $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');
            $data['top_featured'] = GroceryItem::where([['status',0],['top_featured',1],['id','!=',$id]])
                ->whereIn('shop_id',$shop_ids)
                ->orderBy('id','desc')->take(10)->get();
            $data['like_this'] = GroceryItem::where([['status',0],['category_id',$product->category_id],['subcategory_id',$product->subcategory_id],['id','!=',$id]])
                ->whereIn('shop_id',$shop_ids)
                ->orderBy('id','desc')->take(10)->get();
        }
        return view('frontend.single-product', compact('product','data'));
    }

    public function categotyProduct(Request $request,$id, $name)
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $category = GroceryCategory::find($id);

        $data['products'] = GroceryItem::where([['status',0],['category_id',$category->id]]);
    
        if (session()->exists('location_id') && session()->exists('location_name')) {
            $location_id = session('location_id');
            $shop_ids = GroceryShop::where('location',$location_id)->get()->pluck('id');
            $data['products'] = $data['products']
                ->whereIn('shop_id',$shop_ids);
        }
        $data['products'] = $data['products']->get();
        $data['products'] = collect($data['products']->toArray());
        $data['products'] = $data['products']->sortByDesc('id');

        if (isset($request->sort)) {
            if($request->sort == "new"){
                $data['products'] = $data['products']->sortByDesc('id');
            } elseif($request->sort == "price-asc"){
                $data['products'] = $data['products']->sortBy('sell_price');
            } elseif($request->sort == "price-desc") {
                $data['products'] = $data['products']->sortByDesc('sell_price');
            } elseif($request->sort == "alphabetical") {
                $data['products'] = $data['products']->sortBy('name');
            } elseif($request->sort == "off-desc") {
                $data['products'] = $data['products']->sortByDesc('off');
            }  elseif($request->sort == "off-asc") {
                $data['products'] = $data['products']->sortBy('off');
            }
        }
        $data['products'] = $data['products']->paginate(4);
        
        if($request->ajax())
        {
            $view = view('frontend.model.product2',compact('data','category'))->render();
            return response()->json(['html' => $view, 'meta' => $data['products'], 'category' => $category]);
        }
        return view('frontend.category-products', compact('data','category'));
    }

    public function dashboard()
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $order = GroceryOrder::with('orderItem')->where('customer_id',Auth::user()->id)->orderBy('id','desc')->first();
        return view('frontend.profile-dashboard', compact('data','order'));
    }

    public function profileOrders()
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $company = CompanySetting::first(['name']);
        $orders = GroceryOrder::where('customer_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('frontend.profile-orders', compact('orders','company','data'));
    }

    public function profileView()
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        $data['language'] = Language::where('status',1)->get();
        return view('frontend.profile-view', compact('data'));
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data = $request->all();

        $language = Language::where('name',$request->language)->first();
        \App::setLocale($request->language);
        session()->put('locale', $request->language);
        if($language){
            session()->put('direction', $language->direction);
        }
     
        if ($request->hasFile('image')) {
            if($user->image != "user.png")
            {
                if(\File::exists(public_path('/images/upload/'. $user->image))){
                    \File::delete(public_path('/images/upload/'. $user->image));
                }
            }
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        User::findOrFail(Auth::user()->id)->update($data);
        return Redirect::back();
    }

    public function changePassword()
    {
        return view('frontend.change-password');
    }

    public function changePasswordPost(Request $request)
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
        return Redirect::back();
    }

    public function profileAddress()
    {
        $data = UserAddress::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $setting = Setting::first(['lat','lang']);
        return view('frontend.profile-address', compact('data','setting'));
    }

    public function addressView($id)
    {
        $data = UserAddress::find($id);
        return $data;
    }

    public function addressAdd(Request $request)
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
        return Redirect::back();
    }

    public function addressEdit(Request $request)
    {
        $data = $request->all();
        UserAddress::findOrFail($request->id)->update($data);
        return Redirect::back();
    }

    public function addressDelete($id)
    {
        $used = GroceryOrder::where('address_id',$id)->first();
        if(isset($used))
        {
            return false;
        }
        $delete = UserAddress::findOrFail($id);
        $delete->delete();
        return true;
    }

    public function addToCart(Request $request)
    {
        if (!session()->exists('location_id') && !session()->exists('location_name')) {
            return response()->json(['msg' => __('Select Your Location')], 400);
        }
        $product = GroceryItem::find($request->item_id);
        $cart = session()->get('cart');
        if(!$cart) {
            $cart = [
                $request->item_id => [
                    "id" => $product->id,
                    "name" => $product->name,
                    "image" => $product->imagePath.$product->image,
                    "qty" => $request->qty,
                    "off" => $product->off,
                    "sell_price" => $request->sell_price * $request->qty,
                    "fake_price" => $request->fake_price * $request->qty,
                    "details" => $product->detail,
                    "detail_index" => $request->detail_index,
                ]
            ];
            session()->put('cart', $cart);
            $total_item = count((array) session('cart'));
            $htmlCart = view('frontend.model.cart')->render();
            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart, 'total_item' => $total_item]);
        }

        if(isset($cart[$request->item_id])) {
            unset($cart[$request->item_id]);
            session()->put('cart', $cart);
            $total_item = count((array) session('cart'));
            $htmlCart = view('frontend.model.cart')->render();
            return response()->json(['msg' => 'Product removed from cart successfully!', 'data' => $htmlCart, 'total_item' => $total_item]);
        }
        
        $cart[$request->item_id] = [
            "id" => $product->id,
            "name" => $product->name,
            "image" => $product->imagePath.$product->image,
            "qty" => $request->qty,
            "off" => $product->off,
            "sell_price" => $request->sell_price * $request->qty,
            "fake_price" => $request->fake_price * $request->qty,
            "details" => $product->detail,
            "detail_index" => $request->detail_index,
        ];
        session()->put('cart', $cart);
        $total_item = count((array) session('cart'));
        $htmlCart = view('frontend.model.cart')->render();
        return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart, 'total_item' => $total_item]);
    }

    public function getProductDetails(Request $request)
    {
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;

        $item = GroceryItem::find($request->product_id);
        $array = json_decode($item->detail);
        $data['price'] = $array[$request->detail_index]->price;
        $data['fake_price'] = $array[$request->detail_index]->fake_price;
        $data['detail_index'] = $request->detail_index;
        $cal = 100 - ($data['price'] * 100) / $data['fake_price'];
        $data['off'] = round($cal, 2);
        if(isset($request->qty))
        {
            $data['price'] = $data['price'] * $request->qty;
            $data['fake_price'] = $data['fake_price'] * $request->qty;
            $cal = 100 - ($data['price'] * 100) / $data['fake_price'];
            $data['off'] = round($cal, 2);
        }

        $cart = session()->get('cart');
        if(isset($cart[$request->product_id])) {

            $cart[$request->product_id]['qty'] = $request->qty;
            $cart[$request->product_id]['sell_price'] = $data['price'];
            $cart[$request->product_id]['fake_price'] = $data['fake_price'];
            $cart[$request->product_id]['detail_index'] = $data['detail_index'];
            session()->put('cart', $cart);
        }
        if(isset($cart)){
            $total = $this->getCartTotal();
            $data['cart_total'] = $total['total'];
            $data['cart_saving'] = $total['saving'];
            $del = Setting::first()->delivery_charge;
            $data['cart_total_with_delivery'] = $data['cart_total'] + $del;
    
            if (session()->exists('coupon')) {
                $coupon = session('coupon');
                if ($coupon->type == 'amount') {
                    $data['cart_total_with_delivery'] = $data['cart_total'] + $del - $coupon->discount;
                    $data['discount'] = $coupon->discount;
                }
                else {
                    $data['discount'] = ($total['total'] * $coupon->discount) / 100;
                    $data['cart_total_with_delivery'] = $data['cart_total'] + $del - $data['discount'];
                }
            }
        }

        return $data;
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart');
        if(isset($cart[$request->item_id])) {
            unset($cart[$request->item_id]);
            session()->put('cart', $cart);
        }
        $total = $this->getCartTotal();
        $data['cart_total'] = $total['total'];
        $data['cart_saving'] = $total['saving'];
        $del = Setting::first()->delivery_charge;
        $data['cart_total_with_delivery'] = $data['cart_total'] + $del;

        if (session()->exists('coupon')) {
            $coupon = session('coupon');
            if ($coupon->type == 'amount') {
                $data['cart_total_with_delivery'] = $data['cart_total'] + $del - $coupon->discount;
                $data['discount'] = $coupon->discount;
            }
            else {
                $data['discount'] = ($total['total'] * $coupon->discount) / 100;
                $data['cart_total_with_delivery'] = $data['cart_total'] + $del - $data['discount'];
            }
        }

        $total_item = count((array) session('cart'));
        $htmlCart = view('frontend.model.cart')->render();
        return response()->json(['msg' => 'Product removed from cart successfully!', 'data' => $htmlCart,  'total_item' => $total_item, 'total' => $data]);
    }

    public function getCartTotal()
    {
        $total = 0;
        $saving = 0;
        $cart = session()->get('cart');
        foreach($cart as $id => $details) {
            $total += $details['sell_price'];
            $saving += $details['fake_price'];
        }
        $send['total'] = $total;
        $send['saving'] = $saving - $total;

        return $send;
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return view('frontend.signin');
        }
        $data['address'] = UserAddress::where('user_id',Auth::user()->id)->get();
        $data['payment_setting'] = PaymentSetting::first();
        return view('frontend.checkout', compact('data'));
    }
    
    public function checkCoupon($code)
    {
        $date = Carbon::now()->format('Y-m-d');

        $data = Coupon::where([['code',$code],['status',0],['location_id',session('location_id')]])->first();
        if($data){
            if (Carbon::parse($date)->between(Carbon::parse($data->start_date),Carbon::parse($data->end_date))) {
                if($data->max_use<=$data->use_count){
                    return response()->json(['success'=>false,'msg'=>'This coupon is expire!' ,'data' =>null ], 200);
                }
                else{
                    session()->put('coupon', $data);

                    $total = $this->getCartTotal();
                    $delivery_charge = Setting::first()->delivery_charge;
                    $data['cart_saving'] = $total['saving'];
                    $data['cart_total'] = $total['total'];
                    if ($data->type == "amount") {
                        $data['cart_discount'] = $data->discount;
                        $data['cart_total_with_delivery'] = $data['cart_total'] + $delivery_charge - $data['cart_discount'];
                    } else {
                        $data['cart_discount'] = ($total['total'] * $data->discount) / 100;
                        $data['cart_total_with_delivery'] = $data['cart_total'] + $delivery_charge - $data['cart_discount'];
                    }
                    
                    return response()->json(['success'=>true,'msg'=>'Coupon applied successfully' ,'data' =>$data ], 200);
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

    public function placeOrder(Request $request)
    {
        $data = $request->all();
       
        $delivery_charge = Setting::first()->delivery_charge;
        $data['customer_id'] = Auth::user()->id;
        $data['location_id'] = session('location_id');
        $data['order_status'] = Setting::find(1)->default_grocery_order_status;
        $data['delivery_charge'] = $delivery_charge;
        $data['order_no'] = '#' . rand(100000, 999999);
        $data['time'] = Carbon::now('Asia/Kolkata')->format('h:i A');
        $data['address_id'] = $request->address_id;
        $data['date'] = Carbon::now()->format('Y-m-d');
        $payment = 0;
        foreach((array) session('cart') as $id => $details) {
            $payment += $details['sell_price'];
        }
        $data['payment'] = $payment + $delivery_charge;
        if(session()->exists('coupon')){
            $coupon = session('coupon');
            $count = Coupon::findOrFail($coupon->id)->use_count;
            $count = $count + 1;
            Coupon::findOrFail($coupon->id)->update(['use_count'=>$count]);

            if ($coupon->type == 'amount') {
                $data['discount'] = $coupon->discount;
            }
            else {
                $data['discount'] = ($data['payment'] * $coupon->discount) / 100;
            }
            $data['payment'] = $data['payment'] - $data['discount'];
        }
        if($request->payment_type != "COD" )
        {
            $data['payment_token'] = $request->payment_token;
        }
        if($request->payment_type == "STRIPE")
        {
            $stripeSecretKey = PaymentSetting::first()->stripeSecretKey;
            $stripe = Stripe\Stripe::setApiKey($stripeSecretKey);
            $currency_code = Setting::where('id',1)->first()->currency;

            $response = \Stripe\Token::create(array(
                "card" => array(
                    "number"    => $request->cardnumber,
                    "exp_month" => $request->expire_month,
                    "exp_year"  => $request->expire_year,
                    "cvc"       => $request->cvv
                )));
            if (!isset($response['id'])) {
                return redirect()->route('addmoney.paymentstripe');
            }

            $stripe_payment = $currency_code == "USD" ? $data['payment'] * 100 : $data['payment'];

            $charge = \Stripe\Charge::create([
                'card' => $response['id'],
                'currency' => $currency_code,
                'amount' =>  $stripe_payment,
            ]);

            if($charge['status'] == 'succeeded') {
                $data['payment_token'] = $charge['id'];
            } else {
                return 'something went to wrong.';
            }
        }

        if($request->payment_type=='COD' ||$request->payment_type=='FLUTTERWAVE' || $request->payment_type=='WHATSAPP'){            
            $data['payment_status'] = 0;
        }
        else{
            $data['payment_status'] = 1;
        }

        $order = GroceryOrder::create($data);

        $cart = session()->get('cart');
        if($cart)
        {
            foreach((array) $cart as $id => $item)
            {
                $shop_id = GroceryItem::find($item['id'])->shop_id;
                foreach (json_decode($item['details']) as $key => $detail){
                    if($key == $item['detail_index']){
                        $unit = $detail->unit;
                        $unit_qty = $detail->qty;
                    }
                }
                $child['order_id'] = $order->id;
                $child['item_id'] = $item['id'];
                $child['price'] = $item['sell_price'];
                $child['quantity'] = $item['qty'];
                $child['unit'] = $unit;
                $child['unit_qty'] = $unit_qty;
                $child['shop_id'] = $shop_id;
                GroceryOrderChild::create($child);
            }
        }
        $order = GroceryOrder::with('address')->find($order->id);
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;

        // user notification
        $user = User::findOrFail($order->customer_id);
        $notification = Setting::findOrFail(1);
        $shop_name = CompanySetting::where('id',1)->first()->name;
        $content = NotificationTemplate::where('title','Create Order')->first()->mail_content;
        $message = NotificationTemplate::where('title','Create Order')->first()->message_content;
        $detail_not['name'] = $user->name;
        $detail_not['shop'] = $order->location->name;
        $detail_not['shop_name'] = $shop_name; 
        $data_not = ["{{name}}", "{{shop}}","{{shop_name}}"];
        $send_msg = str_replace($data_not, $detail_not, $message);

        if($notification->mail_notification == 1){
            try {               
                Mail::to($user->email)->send(new OrderCreate($content,$detail_not));
            } catch (\Throwable $th) {}
        }
        if($notification->push_notification == 1){
            if($user->device_token!=null){
                try{
                    Config::set('onesignal.app_id', env('APP_ID'));
                    Config::set('onesignal.rest_api_key', env('REST_API_KEY'));
                    Config::set('onesignal.user_auth_key', env('USER_AUTH_KEY'));
              
                    $device_token = $user->device_token;
                    OneSignal::sendNotificationToUser(
                        $send_msg,
                        $device_token,
                        $url = null,
                        $data = null,
                        $buttons = null,
                        $schedule = null
                    );
                } catch(\Exception $e){}
            }
        }
      
        $image = NotificationTemplate::where('title','Create Order')->first()->image;
        $data1 = array();
        $data1['user_id']= $order->customer_id;
        $data1['order_id']= $order->id;
        $data1['title']= 'Order Created';
        $data1['message']= $send_msg;
        $data1['image'] = $image;
        Notification::create($data1);

        if($request->payment_type == "FLUTTERWAVE") {
            session()->forget(['cart', 'coupon']);
            return redirect('create-payment/'.$order->id);            
        }
        else if($request->payment_type == "WHATSAPP") {
            
            $num = CompanySetting::first()->phone;
            $text = $this->generateWhatsappOrder($data, $cart, $order);
            $url = 'https://api.whatsapp.com/send?phone='.$num.'&text='.$text;
            session()->forget(['cart', 'coupon']);
            return Redirect::to($url);     
        }
        
        session()->forget(['cart', 'coupon']);
        return redirect('order-placed/'.$order->id);
    }

    public function generateWhatsappOrder($data, $cart, $order)
    {
        $final = "Hi, I'd like to place an order 👇 \n 🛵🔜🏡 \n\n";

        $final .= 'Delivery Order No '. $order->order_no ."\n\n ----------\n\n";

        $final .= '*Order:*'."\n";
        $subtotal = 0;
        foreach ($order->orderItem as $key => $item) {
            $final .= $item->quantity.' x '.$item->itemName .' ('. $item->unit_qty. $item->unit.") - ".$data['currency'].$item->price."\n";
            $subtotal = $subtotal + $item->price;
        }
        $final .= "\n";
        $final .= 'Sub Total: '.$data['currency'].$subtotal."\n";

        if($order->delivery_charge != null || $order->delivery_charge != 0){
            $final .= 'Delivery Charges: '.$data['currency'].$order->delivery_charge."\n";
        }
        if($order->discount != null || $order->discount != 0){
            $final .= 'Discount: '.$data['currency'].$order->discount."\n\n";
        }
        
        $final .= '----------'."\n".'Total Payment: *'.$data['currency'].$order->payment."*\n----------\n\n";

        $final .= "📍 Delivery Details\n\n";
        if ($order->address_id != null) {
            $final .= 'Address: '.$order->address['soc_name'] .' '.$order->address->street.' '.$order->address->city.' '.$order->address->zipcode."\n\n";
        }

        $final .= "We accept Cash On Delivery";
        return urlencode($final);
    }

    public function makePayment($id)
    {
        $order = GroceryOrder::with('address')->find($id);
        $data['currency_code'] = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$data['currency_code'])->first()->symbol;
        return view('frontend.model.createPayment', compact('order','data'));
    }

    public function transction_verify(Request $request, $id)
    {
        $order = GroceryOrder::find($id);
        if($request->status == "successful") {
            $order->payment_status = 1;
            $order->payment_token = $request->transaction_id;
            $order->save();
            return redirect('order-placed/'.$order->id);
        } else {
            return 'payment not successfully done';
        }
    }

    public function orderPlaced($id)
    {
        $order = GroceryOrder::with('address')->find($id);
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        return view('frontend.orderPlaced', compact('order','data'));
    }

    public function invoice($id)
    {
        $order = GroceryOrder::with('address','orderItem')->find($id);
        $currency_code = Setting::where('id',1)->first()->currency;
        $data['currency'] = Currency::where('code',$currency_code)->first()->symbol;
        return view('frontend.invoice', compact('order','data'));
    }
}