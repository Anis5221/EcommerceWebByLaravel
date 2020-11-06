<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufecture;
use Session;
if(!isset($_SESSION)){
    session_start();
}
class ManufectureController extends Controller

{



    
    public function index(){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $brand = Manufecture::paginate(8);
        return view('backend\Manufecture\allmenufecture', compact('brand'));
    }

    public function add_manufecture(){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        return view("backend\Manufecture\add_manufecture");
    }

    public function insert(Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $insretmanu = new Manufecture;
        $insretmanu->manufecture_name = $request->manufecture_name;
        $insretmanu->manufecture_description = $request->manufecture_description;
        if($request->manpublication_status != null){
            $insretmanu->manpublication_status = $request->manpublication_status;
        }else{
            $insretmanu->manpublication_status = 0;
        }

        if($insretmanu->save()){
            session::put('message', "Brand Added Successefull");
            return redirect()->back();
        }
    }

    public function edit($manufecture_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $brand_item = Manufecture::where('manufecture_id',$manufecture_id)->first();
        return view('backend\Manufecture\editmanufecture', compact('brand_item'));
    }

    public function update($manufecture_id, Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
       

       if($request->manpublication_status == null){
        $publicationStatus = 0;
    }else{
        $publicationStatus = $request->manpublication_status;
    }
    $update_data = Manufecture::where('manufecture_id',$manufecture_id)
    ->update([
        'manufecture_name' => $request->manufecture_name,
        'manufecture_description' => $request->manufecture_description,
        'manpublication_status' => $publicationStatus]);
        if($update_data){
            session::put('message', 'Updated Success');
            return redirect()->to('/all-manufecture');
        }
    }

    public function destroy($manufecture_id)
    {        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $delete_category = Manufecture::where('manufecture_id',$manufecture_id)->delete();
        if($delete_category){
            session::put('message', 'Delete Successfull!!');
            return redirect()->back();
        }
    }


    public function unActive($manufecture_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $update_status = Manufecture::where('manufecture_id',$manufecture_id)->update(['manpublication_status' => 0]);
        
        return redirect()->Back();
    }

    public function active($manufecture_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $update_status = Manufecture::where('manufecture_id',$manufecture_id)->update(['manpublication_status' => 1]);
        
        return redirect()->Back();
    }
}
