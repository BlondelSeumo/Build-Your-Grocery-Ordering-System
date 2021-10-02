<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lang_name' => 'bail|required|unique:language,name',
            'file' => 'bail|required',
            'icon' => 'bail|required',
            'direction' => 'bail|required',
        ]); 
       
        $data['name'] = $request->lang_name;
        $data['status'] = 1;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = $request->lang_name. '.' . $image->getClientOriginalExtension();
            $destinationPath =resource_path('/lang');
            $image->move($destinationPath, $name);
            $data['file'] = $name;
        }    
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $iconPath = public_path('/images/upload');
            $icon->move($iconPath, $iconName);
            $data['icon'] = $iconName;
        }               
        $a = Language::create($data);
        return back();
    }

    public function changelangStatus(Request $request){        
        Language::findOrFail($request->id)->update(['status'=>$request->status]);
        $data = Language::findOrFail($request->id);
        return response()->json(['success'=>true,'msg'=>null ,'data' =>$data ], 200);        
    }
}
