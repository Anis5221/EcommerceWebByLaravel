<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use ShoppingCart;
class CartController extends Controller
{
    public function addCart(Request $request, $id){

      
       
        $cart_add_pro = Product::find($id);
            
         ShoppingCart::add($id, $cart_add_pro->product_name, $request->qty, $cart_add_pro->product_price, ['image' => $cart_add_pro->product_image]);
         if($request->qty == 1){
             return back();
         }
          return redirect()->to('/view-cart/');


    }

    public function viewCart(){

        
        $all_publish_category = Categorie::where('publication_status', 1)->get();

        $manage_publish_product = view('frontend\Cart\cart_view')
        ->with('all_publish_category', $all_publish_category);
        return view('welcome')
        ->with('frontend\Cart\cart_view', $manage_publish_product);
    }

    public function delete_cart_item($rawId){

        ShoppingCart::remove($rawId);
        return redirect()->to('/view-cart/');
    }

    public function update_cart_item(Request $request){

       
         ShoppingCart::update($request->__raw_id, $request->qty);
         return redirect()->to('/view-cart/');
    }
}
