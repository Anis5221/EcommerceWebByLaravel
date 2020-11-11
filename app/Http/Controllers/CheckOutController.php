<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Order_Detail;
use ShoppingCart;

use Session;
use DB;
if(!isset($_SESSION)){
    session_start();
}
class CheckOutController extends Controller
{
    public function index(){

        return view('frontend\ChackOut\checkout');
    }

    public function insert_shipping_info(Request $request)
    {
          $data = array();
          $data['shipping_name'] = $request->shipping_name;
          $data['shipping_email'] = $request->shipping_email;
          $data['fname'] = $request->fname;
          $data['lname'] = $request->lname;
          $data['address'] = $request->address;
          $data['phone_number'] = $request->phone_number;
          $data['city'] = $request->city;
           $shipping_id = DB::table('shippings')->insertGetId($data);

            Session::put('shipping_id', $shipping_id);
            return redirect()->to('/payment-view/');
        
    }

    public function payment_view(){

        return view('frontend\ChackOut\payment');
    }

    public function payment_of_customer(Request $request){
        $status = "panding";
        $customer_id = Session::get('customer_id');
        $shipping_id = Session::get('shipping_id');
        $payment_getway = $request->payment_method;

        // inserting Payment data on payment table using Payment model and geting the last inserted of payment id
        $payment_data = new Payment;
        $payment_data->paymant_method = $payment_getway;
        $payment_data->paymant_status = $status;
        $payment_data->save();
        $payment_id = $payment_data->id;

        // inserting Order data on orders table using Order model and getting last inserted order id of order data
        $order_data = new Order;
        $order_data->customer_id = $customer_id;
        $order_data->shipping_id = $shipping_id;
        $order_data->payment_id = $payment_id;
        $order_data->total_order = ShoppingCart::total();
        $order_data->order_status = $status;
        $order_data->save();
        $order_id = $order_data->id;

        // inserting Order Details or order_details table using Order_Detail model and getting id of order details
        
         $getdata_of_cart = ShoppingCart::all();
         foreach($getdata_of_cart as $order_data) {
            $order_details_data = new Order_Detail;
            $order_details_data->order_id = $order_id;
            $order_details_data->product_id = $order_data->id;
            $order_details_data->product_name = $order_data->name;
            $order_details_data->Product_price = $order_data->price;
            $order_details_data->product_seles_quantity = $order_data->qty;
            $order_details_data->save();
            
         }
        
        //  if($payment_getway == "Visa Card"){
        //     echo "Visa Card";
        //  }else if($payment_getway == "Mester Card"){
        //     echo "Master Card";
        //  }else if($payment_getway == "Bkash"){
        //     echo "Bkash";
        //  }else if($payment_getway == "Hand Cash"){
        //     echo "Hand Cash";
        //  }else{
        //      echo "you are not select any one of Method";
        //  }

        $post_data = array();
$post_data['store_id'] = "gener5fa81d686913c";
$post_data['store_passwd'] = "gener5fa81d686913c@ssl";
$post_data['total_amount'] = ShoppingCart::total() ;
$post_data['currency'] = "BDT";
$post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
$post_data['success_url'] = "http://127.0.0.1:8000/payment-view";
$post_data['fail_url'] = "http://www.testgeteway.com:8000/admin";
$post_data['cancel_url'] = "http://localhost/new_sslcz_gw/cancel.php";
# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

# EMI INFO
$post_data['emi_option'] = "1";
$post_data['emi_max_inst_option'] = "9";
$post_data['emi_selected_inst'] = "9";

# CUSTOMER INFORMATION
$post_data['cus_name'] = "Test Customer";
$post_data['cus_email'] = "test@test.com";
$post_data['cus_add1'] = "Dhaka";
$post_data['cus_add2'] = "Dhaka";
$post_data['cus_city'] = "Dhaka";
$post_data['cus_state'] = "Dhaka";
$post_data['cus_postcode'] = "1000";
$post_data['cus_country'] = "Bangladesh";
$post_data['cus_phone'] = "01711111111";
$post_data['cus_fax'] = "01711111111";

# SHIPMENT INFORMATION
$post_data['ship_name'] = "testgenere7sq";
$post_data['ship_add1 '] = "Dhaka";
$post_data['ship_add2'] = "Dhaka";
$post_data['ship_city'] = "Dhaka";
$post_data['ship_state'] = "Dhaka";
$post_data['ship_postcode'] = "1000";
$post_data['ship_country'] = "Bangladesh";

# OPTIONAL PARAMETERS
$post_data['value_a'] = "ref001";
$post_data['value_b '] = "ref002";
$post_data['value_c'] = "ref003";
$post_data['value_d'] = "ref004";

# CART PARAMETERS
$post_data['cart'] = json_encode(array(
    array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
    array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
    array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
    array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
));
$post_data['product_amount'] = "100";
$post_data['vat'] = "5";
$post_data['discount_amount'] = "5";
$post_data['convenience_fee'] = "3";


# REQUEST SEND TO SSLCOMMERZ
$direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $direct_api_url );
curl_setopt($handle, CURLOPT_TIMEOUT, 30);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($handle, CURLOPT_POST, 1 );
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


$content = curl_exec($handle );

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle))) {
	curl_close( $handle);
	$sslcommerzResponse = $content;
} else {
	curl_close( $handle);
	echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
	exit;
}

# PARSE THE JSON RESPONSE
$sslcz = json_decode($sslcommerzResponse, true );

if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
	echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
	# header("Location: ". $sslcz['GatewayPageURL']);
	exit;
} else {
	echo "JSON Data parsing error!";
}
    }


}
