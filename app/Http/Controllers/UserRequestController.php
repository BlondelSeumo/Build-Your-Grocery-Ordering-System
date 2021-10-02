<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRequest;

class UserRequestController extends Controller
{
    public function index()
    {
        $req = UserRequest::orderBy('id', 'DESC')->paginate(10);
        return view('admin.UserRequest.viewUserRequest',['user_req'=>$req]);
    }

    public function show($id)
    {
        $req = UserRequest::find($id);
        return view('admin.UserRequest.singleUserRequest',['user_req'=>$req]);
    }
    
    public function destroy($id)
    { 
        $delete = UserRequest::find($id);
        $delete->delete();
        return 'true';
    }
}
