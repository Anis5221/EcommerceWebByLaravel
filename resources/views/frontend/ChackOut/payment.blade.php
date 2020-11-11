@extends('welcome')
@section('category_slider_brand')
<section id="cart_items">
    <div class="container col-sm-12">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                 $contents=ShoppingCart::all();

            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contents as $v_contents) {?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to($v_contents->image)}}" height="80px" width="80px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_contents->name}}</a></h4>
                            
                        </td>
                        <td class="cart_price">
                            <p>{{$v_contents->price}}</p>
                        </td>
                        <td class="cart_quantity">
                        <div class="cart_quantity_button">
                           
                                <input class="cart_quantity_input" type="text" name="qty" value="{{$v_contents->qty}}" autocomplete="off" size="2">
                                
                                
                        </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$v_contents->total}}</p>
                        </td>
                        <td class="cart_delete">

                            <a class="cart_quantity_delete" href="{{URL::to('/delete-item/'.$v_contents->__raw_id)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                   <?php }?>
                    
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="paymentCont">
                            <div class="headingWrap">
                                    <h3 class="headingTop text-center">Select Your Payment Method</h3>	
                                  
                            </div>
                        <form action="{{url('/payment-option-selected/')}}" method="POST">
                            @csrf
                            <div class="paymentWrap">
                                <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
                                    <label class="btn paymentMethod active">
                                        <div class="method visa"></div>
                                        <input type="radio" name="payment_method" value="Visa Card"> 
                                    </label>
                                    <label class="btn paymentMethod">
                                        <div class="method master-card"></div>
                                        <input type="radio" name="payment_method" value="Mester Card"> 
                                    </label>
                                    <label class="btn paymentMethod">
                                        <div class="method amex"></div>
                                        <input type="radio" name="payment_method" value="Bkash">
                                    </label>
                                     <label class="btn paymentMethod">
                                         <div class="method vishwa"></div>
                                        <input type="radio" name="payment_method" value="Hand Cash"> 
                                    </label>
                                   
                                 
                                </div>        
                            </div>
                            <div class="footerNavWrap clearfix">
                                <div class="btn btn-success pull-left btn-fyi"><span class="glyphicon glyphicon-chevron-left"></span> CONTINUE SHOPPING</div>
                                <button type="submit" class="btn btn-success pull-right btn-fyi">CHECKOUT<span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>
                        </form>
                        </div>
            
        </div>
    </div>
</section><!--/#do_action-->
@endsection