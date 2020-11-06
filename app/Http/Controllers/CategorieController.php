<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Session;
if(!isset($_SESSION)){
    session_start();
}
class CategorieController extends Controller
{

    public function index(){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        return view("backend\Categorie\addCategory");
    }

    public function all_category(){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $categorys = Categorie::paginate(6);
        return view('backend\Categorie\allCategory', compact('categorys'));

    }

    public function insert(Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $insertdata = new Categorie;
        
        $insertdata->categorie_name = $request->categorie_name;
        $insertdata->categorie_description = $request->categorie_description;
        if($request->publication_status != null){
        $insertdata->publication_status = $request->publication_status;
        }else{
            $insertdata->publication_status = 0;
        }
        
        $insertdata->save();

        if($insertdata){
            session::put('message', 'Categorie Added Successfull!!');
            return redirect()->to('/add-category');
        }else{
            echo "not success";
        }
    }

    public function unActive_category($categorie_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $update_status = Categorie::where('categorie_id',$categorie_id)->update(['publication_status' => 0]);
        
        return redirect()->Back();
    }

    public function active_category($categorie_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $update_status = Categorie::where('categorie_id',$categorie_id)->update(['publication_status' => 1]);
        
        return redirect()->Back();
    }

    public function edit_category($categorie_id)
    {        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $category_item = Categorie::where('categorie_id', $categorie_id)->first();
        return view("backend\Categorie\_editCategory", compact('category_item'));
    }


    public function update_category($categorie_id, Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        
        $update_category = Categorie::where('categorie_id',$categorie_id);
        // $update_category->categorie_name = $request->categorie_name;
        // $update_category->categorie_description = $request->categorie_description;
        // $update_category->publication_status = $request->publication_status;
        if($request->publication_status == null){
            $publicationStatus = 0;
        }else{
            $publicationStatus = $request->publication_status;
        }
        if($update_category->update(['categorie_name' =>$request->categorie_name,
                                       'categorie_description' => $request->categorie_description,
                                       'publication_status' => $publicationStatus
                                        ])){
            session::put('message', 'Update Successfull');
            return redirect()->to('/all-category');
        }

    }

    public function destroy_category($categorie_id)
    {        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $delete_category = Categorie::where('categorie_id',$categorie_id)->delete();
        if($delete_category){
            session::put('message', 'Delete Successfull!!');
            return redirect()->back();
        }
    }


    
    
}
