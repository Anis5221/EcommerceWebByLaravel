<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_Detail;
use DB;
class ManageOrderController extends Controller
{
    public function index(){
        
        $all_ordered_details = DB::table('order__details')
                               ->join('products', 'order__details.product_id', 'products.id')
                               ->join('orders', 'order__details.order_id', 'orders.id')
                               ->select('order__details.*', 'products.*', 'orders.*')
                               ->get();
                        
        $manage_all_order_view = view('backend\Manage_Product\manageProduct')
                                 ->with('all_ordered_detail', $all_ordered_details);
      return view("admin_dashboard")
              ->with('backend\Manage_Product\manageProduct', $manage_all_order_view);
        
    }


    public function view($id)
    {

        $all_ordered_details = DB::table('order__details')
                               ->join('products', 'order__details.product_id', 'products.id')
                               ->join('orders', 'order__details.order_id', 'orders.id')
                               ->where('order__details.id',$id)
                               ->select('order__details.*', 'products.*', 'orders.*')
                               ->first();

       $customer_details = DB::table('orders')
                               ->join('customers', 'orders.customer_id', 'customers.id')
                               ->where('customers.id', $all_ordered_details->customer_id)
                               ->first();
        
        $manage_all_info = view('backend\Manage_Product\view')
                                ->with('all_ordered_details',$all_ordered_details)->with('customer_details',$customer_details);
        
        return view('backend\Manage_Product\view', compact('customer_details','all_ordered_details'));
    }
                
}
