<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategorie;
use DB;
use Session;
if(!isset($_SESSION)){
    session_start();
}
class SubCategorieController extends Controller
{

    public function insert(Request $request)
    {
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
         $subCategory = new SubCategorie;
         $subCategory->subcategorie_name = $request->subcategorie_name;
         $subCategory->subcategorie_description = $request->subcategorie_description;
         $subCategory->maincategorie_id = $request->maincategory_id;
         if($request->subpublication_status != null){
            $subCategory->subpublication_status = $request->subpublication_status;
            }else{
            $subCategory->subpublication_status = 0;
            }
        

        // $subcatinsert = array();
        // $subcatinsert['subcategorie_name'] = $request->subcategorie_name;
        // $subcatinsert['subcategorie_description'] = $request->subcategorie_description;
        // $subcatinsert['subpublication_status'] = $request->subcategorie_description;
        //DB::table('sub_categories')->insert($subcatinsert)
        if($subCategory->save()){
            Session::put('massege', 'Sub Category Added');
            return back();
        }

    }

    public function index(){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $subcategory = DB::table('sub_categories')
                       ->join('categories','categories.categorie_id','sub_categories.maincategorie_id')
                       ->select('sub_categories.*', 'categories.categorie_name')->paginate(8);
        return view('backend\Categorie\SubCategory\show', compact('subcategory'));
    }

    public function update(Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        if($request->subpublication_status == null){
            $publicationStatus = 0;
        }else{
            $publicationStatus = $request->subpublication_status;
        }
        $editsubcategory = SubCategorie::where('subcategorie_id',$request->cat_id)
        ->update([
            'subcategorie_name' => $request->name,
            'subcategorie_description' => $request->des,
            'subpublication_status' => $publicationStatus]);
            if($editsubcategory){
                session::put('message', 'Updated Success');
                return back();
            }
        
    }

    public function destroy($subcategorie_id)
    {
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $delete_category = SubCategorie::where('subcategorie_id',$subcategorie_id)->delete();
        if($delete_category){
            session::put('message', 'Delete Successfull!!');
            return redirect()->back();
        }
    }


    public function unActive_category($categorie_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $update_status = SubCategorie::where('subcategorie_id',$categorie_id)->update(['subpublication_status' => 0]);
        
        return redirect()->Back();
    }

    public function active_category($categorie_id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck(); 
        $update_status = SubCategorie::where('subcategorie_id',$categorie_id)->update(['subpublication_status' => 1]);
        
        return redirect()->Back();
    }
}
