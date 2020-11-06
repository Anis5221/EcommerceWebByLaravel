<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;
class HomeController extends Controller
{
    public function index()
    {

        $all_publish_product = DB::table('products')
                                    ->join('categories', 'products.categorie_id', 'categories.categorie_id')
                                    ->join('manufectures', 'products.manufecture_id', 'manufectures.manufecture_id')
                                    ->select('products.*', 'categories.categorie_name', 'manufectures.manufecture_name')
                                    ->where('products.publication_status', 1)
                                    ->limit(9)
                                    ->get();

        $manage_publish_product = view('frontend\index_main')
                                ->with('all_publish_product', $all_publish_product);
        return view('welcome')
                ->with('frontend\index_main', $manage_publish_product);
    }
}
