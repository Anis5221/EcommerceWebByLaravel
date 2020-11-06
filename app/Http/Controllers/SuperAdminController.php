<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
if(!isset($_SESSION)){
    session_start();
}

class SuperAdminController extends Controller
{
        
    public function index()
    {
        $this->AdminAuthCheck();
        return view("backend.dashboard");
    }

    public function logout(){
        Session::flush();
        return redirect()->to('/admin');
    }

    public function AdminAuthCheck(){

        $admin_id = Session::get('admin_id');
        if($admin_id){
            return;
        }else{
            return redirect()->to('/admin')->send();
        }
    }
}
