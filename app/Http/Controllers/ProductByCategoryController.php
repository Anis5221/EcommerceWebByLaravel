<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;
class ProductByCategoryController extends Controller
{
    public function index_of_pdbyct($categorie_id){

        $all_publish_product = DB::table('products')
        ->join('categories', 'products.categorie_id', 'categories.categorie_id')
        ->join('manufectures', 'products.manufecture_id', 'manufectures.manufecture_id')
        ->select('products.*', 'categories.categorie_name', 'manufectures.manufecture_name')
        ->where('products.publication_status', 1)
        ->where('products.categorie_id',$categorie_id)
        ->limit(9)
        ->get();

        $manage_publish_product = view('frontend\index_main')
            ->with('all_publish_product', $all_publish_product);
        return view('welcome')
        ->with('frontend\index_main', $manage_publish_product);
    }


    public function index_of_pdbymn($manufecture_id){

        $all_publish_product = DB::table('products')
        ->join('categories', 'products.categorie_id', 'categories.categorie_id')
        ->join('manufectures', 'products.manufecture_id', 'manufectures.manufecture_id')
        ->select('products.*', 'categories.categorie_name', 'manufectures.manufecture_name')
        ->where('products.publication_status', 1)
        ->where('products.manufecture_id',$manufecture_id)
        ->limit(9)
        ->get();

        $manage_publish_product = view('frontend\index_main')
            ->with('all_publish_product', $all_publish_product);
        return view('welcome')
        ->with('frontend\index_main', $manage_publish_product);
    }

    public function pruduct_view_by_id($id){

        $product_view = DB::table('products')
        ->join('categories', 'products.categorie_id', 'categories.categorie_id')
        ->join('manufectures', 'products.manufecture_id', 'manufectures.manufecture_id')
        ->select('products.*', 'categories.categorie_name', 'manufectures.manufecture_name')
        ->where('products.publication_status', 1)
        ->where('products.id',$id)
        ->first();
        
        $all_recommended_product = DB::table('products')
        ->join('categories', 'products.categorie_id', 'categories.categorie_id')
        ->join('manufectures', 'products.manufecture_id', 'manufectures.manufecture_id')
        ->select('products.*', 'categories.categorie_name', 'manufectures.manufecture_name')
        ->where('products.publication_status', 1)
        ->where('products.manufecture_id',$product_view->manufecture_id)
        ->where('products.categorie_id',$product_view->categorie_id)
        ->limit(3)
        ->get();


            
        $manage_publish_product = view('frontend\Product_Details\product_details')
            ->with('product_view', $product_view)->with('all_recommended_product', $all_recommended_product);
        return view('welcome')
        ->with('frontend\Product_Details\product_details', $manage_publish_product);
    }
    

}
