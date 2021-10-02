<?php

namespace App\Http\Controllers;

use App\Location;
use App\Coupon;
use App\Notification;
use App\GrocerySubCategory;
use App\GroceryOrder;
use App\GroceryOrderChild;
use App\GroceryItem;
use App\GroceryShop;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::orderBy('id', 'DESC')->paginate(10);
        return view('mainAdmin.location.viewLocation',['locations'=>$location]);
    }

    public function create()
    {
        return view('mainAdmin.location.addLocation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:location',
            'status' => 'bail|required',
            'latitude' => 'bail|required|numeric',
            'longitude' => 'bail|required|numeric',
            'radius' => 'bail|required|numeric',
            'description' => 'bail|required',
        ]);
        $data = $request->all();

        if(isset($request->popular)){ $data['popular'] = 1; }
        else{ $data['popular'] = 0; }
        Location::create($data);
        return redirect('Location');
    }

    public function edit($id)
    {
        $data = Location::findOrFail($id);
        return view('mainAdmin.location.editLocation',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required|unique:location,name,' . $id . ',id',
            'status' => 'bail|required',
            'latitude' => 'bail|required|numeric',
            'longitude' => 'bail|required|numeric',
            'radius' => 'bail|required|numeric',
            'description' => 'bail|required',
        ]);
        $data = $request->all();

        if(isset($request->popular)){ $data['popular'] = 1; }
        else{ $data['popular'] = 0; }
           
        Location::findOrFail($id)->update($data);
        return redirect('Location');
    }

    public function destroy($id)
    {
        try {          
            $Groceryshop = GroceryShop::where('location',$id)->get();
            if($Groceryshop){
                foreach ($Groceryshop as $value) {
                    $GroceryItem = GroceryItem::where('shop_id',$value->id)->get();
                    if($GroceryItem){
                        foreach ($GroceryItem as $i) {
                            $i->delete();
                        } 
                    }  
                    $GrocerySubCategory = GrocerySubCategory::where('shop_id',$value->id)->get();                   
                    if($GrocerySubCategory){
                        foreach ($GrocerySubCategory as $g) {                           
                            $g->delete();
                        } 
                    }
                  
                    $Coupon = Coupon::where('location_id',$value->id)->get();
                    if($Coupon){
                        foreach ($Coupon as $c) {
                            $c->delete();
                        } 
                    }                                       

                    $Order = GroceryOrder::where('shop_id',$value->id)->get();
                    if($Order){
                        foreach ($Order as $item) {                    
                            $Notification = Notification::where('order_id',$item->id)->get();
                            if($Notification){
                                foreach ($Notification as $n) {
                                    $n->delete();
                                } 
                            }
                            $OrderChild = GroceryOrderChild::where('order_id',$item->id)->get();
                            if($OrderChild){
                                foreach ($OrderChild as $oc) {
                                    $oc->delete();
                                } 
                            }                                              
                            $item->delete();
                        } 
                    } 
                    $value->delete();
                } 
            }

            $delete = Location::findOrFail($id);
            $delete->delete();
            return 'true';
        } catch (\Exception $e) {
            return response('Data is Connected with other Data', 400);
        }
    }
}
