<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::orderBy('id', 'DESC')->paginate(7);
        return view('mainAdmin.banner.viewBanner',['banner'=>$data]);
    }

    public function create()
    {
        return view('mainAdmin.banner.addBanner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title1' => 'bail|required|unique:banner',
            'title2' => 'bail|required',
            'off' => 'bail|required',
            'status' => 'bail|required',
            'image' => 'bail|required',
            'url' => 'bail|required',
        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        Banner::create($data);
        return redirect('Banner');
    }
    
    public function edit($id)
    {
        $data = Banner::findOrFail($id);
        return view('mainAdmin.banner.editBanner',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title1' => 'bail|required|unique:banner,title1,' . $id . ',id',
            'title2' => 'bail|required',
            'off' => 'bail|required',
            'status' => 'bail|required',
            'url' => 'bail|required',
        ]);
        $data = $request->all();
        $b = Banner::findOrFail($id);

        if ($request->hasFile('image')) {
            if(\File::exists(public_path('/images/upload/'. $b->image))){
                \File::delete(public_path('/images/upload/'. $b->image));
            }
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        Banner::findOrFail($id)->update($data);
        return redirect('Banner');
    }

    public function destroy($id)
    {
        try {
            $delete = Banner::find($id);
            $delete->delete();
            if(\File::exists(public_path('/images/upload/'. $delete->image))){
                \File::delete(public_path('/images/upload/'. $delete->image));
            }
            return 'true';
        } catch (\Exception $e) {
            return response('Data is Connected with other Data', 400);
        }
    }
}
