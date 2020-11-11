<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Session;
session_start();
class LoginController extends Controller
{
    public function index()
    {
        return view('frontend\Auth\Login');
    }

    public function insert(Request $request){

        $validatedData = $request->validate([
            'customer_name' => ['required', 'unique:customers', 'max:255'],
            'customer_email' => ['required','unique:customers'],
            'customer_phone' => ['required', 'max:11'],
        ]);

            $inser_cutomer_info = new Customer;
            // $inser_cutomer_info= $request->all();
            $inser_cutomer_info->customer_name = $request->customer_name;
            $inser_cutomer_info->customer_email=$request->customer_email;
            $inser_cutomer_info->customer_phone=$request->customer_phone;
            $inser_cutomer_info->password=$request->password;
            if($inser_cutomer_info->save()){
                $result = Customer::where('customer_email',$request->customer_email)->where('password', $request->password)->first();
                session :: put('customer_name', $result->customer_name);
                session :: put('customer_id', $result->id);
                return redirect()->to('/');
            }

    }
    public function login(Request $request){

        $customer_email_pass = Customer::all();

        $result = Customer::where('customer_email',$request->customer_email)->where('password', $request->password)->first();
        if(!$result){
            session :: put('messege', 'Email or password incorrect');
            return back();
        }else{
    
            session :: put('customer_name', $result->customer_name);
            session :: put('customer_id', $result->id);
            return redirect()->to('/');
        }
    }

    public function customer_logout(){
        Session::flush();
        return redirect()->to('/');
    }
}
