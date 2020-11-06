<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Session;
use Illuminate\Http\Request;
session_start();
class AdminController extends Controller
{
    
    public function index()
    {
        return view('backend\admin_login');
    }

    public function adminLogin(Request  $request){
            
        $useremial = $request->admin_name;
        $userpassword = md5($request->admin_password);
        $result = Admin::where('admin_email',$useremial)->where('admin_password', $userpassword)->first();
        if(!$result){
            session :: put('messege', 'Email or password incorrect');
            return redirect()->to('/admin');
        }else{
            session :: put('admin_name', $result->admin_name);
            session :: put('admin_id', $result->admin_id);
            return redirect()->to('/dashboard');
          
        }
   }
}
