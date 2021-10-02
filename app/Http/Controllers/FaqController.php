<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $data = Faq::orderBy('id', 'DESC')->paginate(7);
        return view('mainAdmin.faq.viewFaq',['faq'=>$data]);
    }

    public function create()
    {
        return view('mainAdmin.faq.addFaq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required',
            'description' => 'bail|required',
            'status' => 'bail|required',
        ]);
        $data = $request->all();
        Faq::create($data);
        return redirect('Faq');
    }

    public function edit($id)
    {
        $data = Faq::findOrFail($id);
        return view('mainAdmin.faq.editFaq',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'bail|required',
            'description' => 'bail|required',
            'status' => 'bail|required',
        ]);
        $data = $request->all();
        Faq::findOrFail($id)->update($data);
        
        return redirect('Faq');
    }

    public function destroy($id)
    {
        try {
            $delete = Faq::find($id);
            $delete->delete();
            return 'true';
           
        } catch (\Exception $e) {
            return response('Data is Connected with other Data', 400);
        }
    }
}
