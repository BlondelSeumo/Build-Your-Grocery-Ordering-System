<?php

namespace App\Http\Controllers;

use App\NotificationTemplate;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Auth;
use Redirect;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data  = NotificationTemplate::orderBy('id', 'DESC')->get();
        return view('mainAdmin.notification.viewNotification',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mainAdmin.notification.addNotification');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    
        $request->validate([
            'title' => 'bail|required|unique:notification_template',
            'subject' => 'bail|required',
            'mail_content' => 'bail|required',        
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        NotificationTemplate::create($data);
        return redirect('NotificationTemplate');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationTemplate $notificationTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = NotificationTemplate::findOrFail($id);
        return response()->json(['data' =>$data ,'success'=>true], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'subject' => 'bail|required',
            'mail_content' => 'bail|required',        
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        NotificationTemplate::findOrFail($id)->update($data);
        return redirect('NotificationTemplate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationTemplate $notificationTemplate)
    {
        //
    }

    public function sendTestMail(Request $request){        
        $request->validate([
            'email' =>'bail|required',
            'template_id' =>'bail|required',
        ]);
        $content = NotificationTemplate::findOrFail($request->template_id)->mail_content;
        try{
            Mail::to($request->email)->send(new TestMail($content));
        }
        catch (\Exception $e) {
           
        }        
        
        $msg =array(
            'icon'=>'fas fa-thumbs-up',
            'msg'=>'Test mail is send successfully',
            'heading'=>'Success',
            'type' => 'default'
        );
        return Redirect::back()->with('msg',$msg);
    }
}
