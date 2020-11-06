<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use File;
use DB;
class ProductController extends Controller
{
   

    public function index()
    {
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        return view('backend\Product\add_product');
    }

    public function insert(Request $request){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $this->validate($request, [
            'image' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ]);

        $insert_product = new Product;
        $insert_product->product_name = $request->product_name;
        $insert_product->categorie_id = $request->category_id;
        $insert_product->manufecture_id = $request->brand_id;
        $insert_product->product_short_description = $request->product_short_description;
        $insert_product->product_long_description = $request->product_long_description;
        $insert_product->product_price = $request->product_price;
        

        if($request->hasfile('image'))
        {
            echo 'success';
            $image = $request->file('image');
            $uniqimgname = hexdec(uniqid());
            $name=$image->getClientOriginalName();
            $imagefullname = $uniqimgname.'.'.$name;
            $imagepath ="backend/product_image/" ;
            $image->move($imagepath, $imagefullname);  
            $imageurl = $imagepath.$imagefullname;
            $insert_product->product_image = $imageurl;  
           
        }



        // $image = $request->file('image');
        
        //     if($image){
        //         echo '$imageurl'; 
        //         $image_uniqname = hexdec(uniqid());
        //         $imageoriginal = strtolower($image->getClientOriginalName());
        //         $imagefullname = $image_uniqname.".".$imageoriginal;
        //         $imagepath = "public/backend/product_image";
        //         $imageurl = $imagepath.$imagefullname;
                
        //         // $image->move($imagepath, $imagefullname);
        //         // $insert_product->product_image = $imageurl;
        //     }

        $insert_product->product_size = $request->product_size;
        $insert_product->product_color = $request->product_color;
        if($request->publication_status != null){
        $insert_product->publication_status = $request->publication_status;
        }else{
            $insert_product->publication_status = 0;
        }

        if($insert_product->save()){
            echo 'success';
        }
    }


    public function show(){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $allproduct = DB::table('products')
                          ->join('categories', 'categories.categorie_id', 'products.categorie_id')
                          ->join('manufectures', 'manufectures.manufecture_id', 'products.manufecture_id')
                          ->select('products.*', 'categories.categorie_name', 'manufectures.manufecture_name')
                          ->get();  
        $manage_view = view('backend\Product\all_product')
                            ->with('allproduct', $allproduct);
        return view('admin_dashboard')
                    ->with('backend\Product\all_product', $manage_view);
    }

    public function edit($id){
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();
        $edit_product = Product::find($id);

        return view('backend\Product\edit_product', compact('edit_product'));
    }

    public function update($id, Request $request){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        $insert_product =Product :: find($id);
        $insert_product->product_name = $request->product_name;
        $insert_product->categorie_id = $request->category_id;
        $insert_product->manufecture_id = $request->brand_id;
        $insert_product->product_short_description = $request->product_short_description;
        $insert_product->product_long_description = $request->product_long_description;
        $insert_product->product_price = $request->product_price;
        

        if($request->hasfile('image'))
        {
            echo 'success';
            $image = $request->file('image');
            $uniqimgname = hexdec(uniqid());
            $name=$image->getClientOriginalName();
            $imagefullname = $uniqimgname.'.'.$name;
            $imagepath ="backend/product_image/" ;
            if(File :: exists($request->old_image)){
                unlink($request->old_image);
            }
            $image->move($imagepath, $imagefullname);  
            $imageurl = $imagepath.$imagefullname;
            $insert_product->product_image = $imageurl;  
           
        }

        $insert_product->product_size = $request->product_size;
        $insert_product->product_color = $request->product_color;
        if($request->publication_status != null){
        $insert_product->publication_status = $request->publication_status;
        }else{
            $insert_product->publication_status = 0;
        }

        if($insert_product->update()){
            return redirect()->to('/all-product');
        }

    }

    public function unActive($id){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        $update_status = Product::find($id);
        $update_status ->publication_status = 0;
        if($update_status->save()){
            return redirect()->Back();
        }
        
    }

    public function active($id){

        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        $update_status = Product::find($id);
        $update_status->publication_status = 1;
        if($update_status->save()){
            return redirect()->Back();
        }
        
        
    }

    public function destroy($id)
    {
        $Auth = new SuperAdminController;
        $Auth->AdminAuthCheck();

        
        $st = Product::findorfail($id);
        if(File::exists($st->product_image)){
            unlink($st->product_image);
        }
        $st->delete();
        return redirect()->back();
    }
}
