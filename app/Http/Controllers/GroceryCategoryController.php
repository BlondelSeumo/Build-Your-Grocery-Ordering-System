<?php

namespace App\Http\Controllers;

use App\GroceryCategory;
use App\GroceryShop;
use App\GroceryItem;
use Illuminate\Http\Request;

class GroceryCategoryController extends Controller
{
    public function index()
    {
        $data = GroceryCategory::orderBy('id', 'DESC')->paginate(7);
        foreach ($data as $item) {
            $shop = GroceryShop::get();       
            $shops = array();
            foreach ($shop as $value) {            
                $likes=array_filter(explode(',',$value->category_id));          
                if(count(array_keys($likes,$item->id))>0){
                    if (($key = array_search($item->id, $likes)) !== false) {
                        array_push($shops,$value->id); 
                    }
                }
            }    
            $item->total_shop = count($shops);  
        }
        return view('mainAdmin.GroceryCategory.viewGroceryCategory',['categories'=>$data]);
    }

    public function create()
    {
        return view('mainAdmin.GroceryCategory.addGroceryCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:grocery_category',
            'status' => 'bail|required',
            'image' => 'bail|required',
        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        GroceryCategory::create($data);
        return redirect('GroceryCategory');
    }

    public function edit($id)
    {
        $data = GroceryCategory::findOrFail($id);
        return view('mainAdmin.GroceryCategory.editGroceryCategory',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required|unique:grocery_category,name,' . $id . ',id',
            'status' => 'bail|required',
        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        GroceryCategory::findOrFail($id)->update($data);

        return redirect('GroceryCategory');
    }

    public function destroy($id)
    {
        try {
            $item = GroceryItem::where('category_id',$id)->get();           
            if(count($item)==0){
                $delete = GroceryCategory::find($id);
                $delete->delete();
                return 'true';
            }     
            else{
                return response('Data is Connected with other Data', 400);
            }                               
        } catch (\Exception $e) {
            return response('Data is Connected with other Data', 400);
        }
    }
}
