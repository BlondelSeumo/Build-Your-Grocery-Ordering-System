<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use App\Setting;
use App\GroceryShop;
use App\GroceryOrder;
use App\Currency;
use App\GroceryCategory;
use App\GroceryItem;
use Carbon\Carbon;
use App\Location;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shop_id = array();
        $master = array();
        $master['sales']= 0;
        $master['shops'] = GroceryShop::where('user_id',Auth::user()->id)->get()->count();
        $master['users'] = User::where('role',0)->get()->count();
        $master['delivery'] = User::where('role',2)->get()->count();
        $sales = GroceryOrder::get();
        $currency_code = Setting::where('id',1)->first()->currency;
        $currency = Currency::where('code',$currency_code)->first()->symbol;   

        foreach ($sales as $value) {
            $master['sales'] = $master['sales'] + $value->payment;
        }
        $users = User::where('role',0)->orderBy('id', 'DESC')->get();  
        foreach ($users as $value) {
            $value->orders = GroceryOrder::where([['customer_id',$value->id]])->get()->count();
        }
        $shops = GroceryShop::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        foreach (Auth::user()->shops as $value) {
            array_push($shop_id,$value->id);
        }
        $date = Carbon::now();
      
        $items = GroceryItem::orderBy('id', 'DESC')->get();
      
        $categories = GroceryCategory::orderBy('id','DESC')->get();
        $location = Location::orderBy('id', 'DESC')->get();
        $groceryOrders =  GroceryOrder::with(['customer','deliveryGuy'])->where([['order_status','Pending']])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.dashboard',['master'=>$master,'groceryOrders'=>$groceryOrders,'users'=>$users,'shops'=>$shops,'items'=>$items,'currency'=>$currency, 'locations' => $location, 'category' => $categories]);
    }
}
