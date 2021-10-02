<?php

namespace App\Http\Controllers;

use App\User;
use App\UserAddress;
use App\Setting;
use App\CompanySetting;
use App\NotificationTemplate;
use Auth;
use App;
use Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Notification;
use App\Coupon;
use App\GroceryOrder;
use App\GroceryShop;
use App\GroceryOrderChild;
use App\GrocerySubCategory;
use App\GroceryItem;
use App\Location;
use App\Language;
use App\UserRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $data = User::where('role',0)->orderBy('id', 'DESC')->get();
        return view('mainAdmin.users.users',['users'=>$data]);
    }

    public function create()
    {
        return view('mainAdmin.users.addUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users',
            'phone' => 'bail|required|numeric',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|same:password|min:6'
        ]);
        $data = $request->all();
        $data['password']=Hash::make($data['password']);
        $data['role']= 0;
        $data['otp'] = mt_rand(100000,999999);
        if (isset($request->image) && $request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        else{
            $data['image'] = 'user.png';
        }

        $user_verify = Setting::where('id',1)->first()->user_verify;
        if($user_verify==1){
            $data['verify'] = 0;
        }
        else if($user_verify==0){
            $data['verify'] = 1;
        }
        $user = User::create($data);
        return redirect('Customer');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('mainAdmin.users.editUser',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users,email,' . $id . ',id',
            'phone' => 'bail|required|numeric',
        ]);
        $data = $request->all();

        if (isset($request->image) && $request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        User::findOrFail($id)->update($data);
        return redirect('Customer');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if($user->role==0){               
                $Order = GroceryOrder::where('customer_id',$id)->get();
                if(count($Order)>0){
                    foreach ($Order as $value) {                                                
                        $OrderChild = GroceryOrderChild::where('order_id',$value->id)->get();
                        if(count($OrderChild)>0){
                            foreach ($OrderChild as $oc) {
                                $oc->delete();
                            }
                        }                       
                        $value->delete();
                    }
                }
                $Notification = Notification::where('user_id',$id)->get();
                if(count($Notification)>0){
                    foreach ($Notification as $n) {
                        $n->delete();
                    }
                }
                $UserAddress = UserAddress::where('user_id',$id)->get();
                if(count($UserAddress)>0){
                    foreach ($UserAddress as $n) {
                        $n->delete();
                    }
                }
                $ur = UserRequest::where('user_id',$id)->update(['user_id'=>null]);
            }
            if($user->role==2){
              
                $GroceryOrder = GroceryOrder::where('deliveryBoy_id',$id)
                ->whereIn('order_status',['PickUpGrocery','OutOfDelivery'])
                ->get();
                if(count($GroceryOrder)>0){
                    return response('Data is Connected with other Data', 400);   
                }
            }
            if($user->role==1){
            
                $GroceryItem = GroceryItem::where('user_id',$id)->get();
                if(count($GroceryItem)>0){
                    foreach ($GroceryItem as $value) {
                        $value->delete();
                    }
                }
                $GrocerySubCategory = GrocerySubCategory::where('owner_id',$id)->get();
                if(count($GrocerySubCategory)>0){
                    foreach ($GrocerySubCategory as $value) {
                        $value->delete();
                    }
                }
                    
                $GroceryOrder = GroceryOrder::where('owner_id',$id)->get();
                if(count($GroceryOrder)>0){
                    foreach ($GroceryOrder as $value) {
                        $Notification = Notification::where('order_id',$value->id)->get();
                        if(count($Notification)>0){
                            foreach ($Notification as $n) {
                                $n->delete();
                            }
                        }
                     
                        $GroceryOrderChild = GroceryOrderChild::where('order_id',$value->id)->get();
                        if(count($GroceryOrderChild)>0){
                            foreach ($GroceryOrderChild as $oc) {
                                $oc->delete();
                            }
                        }                   
                        $value->delete();
                    }
                }

                $gShops = GroceryShop::where('user_id',$id)->get();
                if(count($gShops)>0){
                    foreach ($gShops as $gShop) {                                              
                        $Coupon = Coupon::where('shop_id',$gShop->id)->get();
                        if(count($Coupon)>0){
                            foreach ($Coupon as $value) {
                                $value->delete();
                            }
                        }                                           
                        $gShop->delete();
                    }
                } 
            }
            $user->delete();
            return 'true';
        } catch (\Exception $e) {
            return response('Data is Connected with other Data', 400);
        }
    }

    // user over

    // driver start

    public function addDeliveryBoy(){
        $location = Location::where('status',0)->get();
        return view('mainAdmin.users.addDriver', compact('location'));
    }

    public function addDriver(Request $request){
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users',
            'phone' => 'bail|required|numeric',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|same:password|min:6'
        ]);
        $data = $request->all();
        $data['role']=2;
        $data['password']=Hash::make($data['password']);
        if (isset($request->image) && $request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        else{
            $data['image'] = 'user.png';
        }
        $data['otp'] = mt_rand(100000,999999);
        $user_verify = Setting::where('id',1)->first()->user_verify;
        if($user_verify==1){
            $data['verify'] = 0;
        }
        else if($user_verify==0){
            $data['verify'] = 1;
        }
        $user = User::create($data);
        return redirect('deliveryGuys');

    }

    public function editDriver($id){
        $data = User::findOrFail($id);
        $location = Location::where('status',0)->get();
        return view('mainAdmin.users.editDriver',['data'=>$data, 'location' => $location]);
    }

    public function updateDriver(Request $request,$id){
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users,email,' . $id . ',id',
            'phone' => 'bail|required|numeric',
        ]);
        $data = $request->all();

        if (isset($request->image) && $request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        User::findOrFail($id)->update($data);
        return redirect('deliveryGuys');
    }
    
    public function deliveryGuys(){
        $users = User::where('role',2)->orderBy('id', 'DESC')->get();
        return view('mainAdmin.users.deliveryGuys',['users'=>$users]);
    }

    // admin profile
    public function ownerProfileform(){
        $master = array();
        $master['shops'] = GroceryShop::where('user_id',Auth::user()->id)->get()->count();
        $master['users'] = User::where('role',0)->get()->count();
        $master['language'] = Language::where('status',1)->get();

        return view('admin.ownerProfile',['master'=>$master]);
    }

    public function editOwnerProfile(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users,email,' . $id . ',id',
        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        $language = Language::where('name',$request->language)->first();
        App::setLocale($request->language);
        session()->put('locale', $request->language);
        if($language){
            session()->put('direction', $language->direction);
        }

        User::findOrFail($id)->update($data);
        return redirect('ownerProfile');
    }

    public function changeOwnerPassword(Request $request){
        $request->validate([
            'old_password' => 'bail|required',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|same:password|min:6'
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)){
            User::findOrFail(Auth::user()->id)->update(['password'=>Hash::make($request->password)]);
            return back();
        }
        else{
            return Redirect::back()->with('error_msg','Current Password is wrong!');
        }
    }

    public function ResetPassword(){
        return view('auth.passwords.reset');
    }

    public function reset_password(Request $request){
        $user = User::where([['email',$request->email],['role',1]])->first();
        $password=rand(100000,999999);
        if($user){
            $content = NotificationTemplate::where('title','Forget Password')->first()->mail_content;
            $detail['name'] = $user->name;
            $detail['password'] = $password;
            $detail['shop_name'] = CompanySetting::where('id',1)->first()->name;
            try{
            Mail::to($user->email)->send(new ForgetPassword($content,$detail));
            } catch (\Exception $e) {
                
            }
            User::findOrFail($user->id)->update(['password'=>Hash::make($password)]);
            return Redirect::back()->with('success_msg','Please check your email new password will send on it.');
        }
        return Redirect::back()->with('error_msg','Invalid Email ID');
    }

    public function customerReport(){
        $user = User::where('role',0)->orderBy('id', 'DESC')->get();
        return view('mainAdmin.users.userReport',['users'=>$user]);
    }

    public function changeLanguage($lang){
        $language = Language::where('name',$lang)->first();
        App::setLocale($lang);
        session()->put('locale', $lang);
        if($language){
            session()->put('direction', $language->direction);
        }
        return redirect()->back();
    }

}
