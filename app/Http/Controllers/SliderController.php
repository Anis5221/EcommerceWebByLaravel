<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Session;
use File;
if(!isset($_SESSION)){
    session_start();
}
class SliderController extends Controller
{
    
    public function index(){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        return view('backend\Slider\add_slider');
    }

    public function insert(Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $this->validate($request, [
            'image' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ]);
        $insert_slider = new Slider;
        $image = $request->file('image');
        if($image){
            $imguniqename = hexdec(uniqid());
            $imgorginalname = strtolower($image->getClientOriginalName());
            $imagefullname = $imguniqename.'.'.$imgorginalname;
            $imgpath = 'backend/slider_image/';
            $image->move($imgpath, $imagefullname);
            $imageurl = $imgpath.$imagefullname;
            $insert_slider->slider_image =$imageurl;
        }
        if($request->publication_status == null){
            $insert_slider->publication_status = 0;
        }else{
            $insert_slider->publication_status = $request->publication_status;
        }

        if($insert_slider->save()){
            Session :: put('message', 'Slider Inserted Success');
            return back();
        }
    }


    public function show(){

        $all_slider_image = Slider::all();
        $manage_slider = view('backend\Slider\all_slider')->with('all_slider_image', $all_slider_image);
        return view('backend\dashboard')
                ->with('backend\Slider\all_slider', $manage_slider);
    }





    public function unActive($id){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        $update_status = Slider::find($id);
        $update_status ->publication_status = 0;
        if($update_status->save()){
            return redirect()->Back();
        }
        
    }

    public function active($id){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        $update_status = Slider::find($id);
        $update_status->publication_status = 1;
        if($update_status->save()){
            return redirect()->Back();
        }
        
        
    }

    public function destroy($id){

        $delete_slider = Slider::find($id);
        if(File::exists($delete_slider->slider_image)){
            unlink($delete_slider->slider_image);
        }
        if($delete_slider->delete()){
            return back();
        }
    }
}
