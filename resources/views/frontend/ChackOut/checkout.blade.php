@extends('welcome')
@section('category_slider_brand')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 col-10 mx-auto">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form>
                                <input type="email" name="email" placeholder="Email">
                                <input type="text" name="fname" placeholder="First Name">
                                <input type="text" name="lname" placeholder="Last Name">
                                <input type="text" name="address" placeholder="Address">
                                <input type="text" name="phone" placeholder="Mobile Number">
                                <input type="text" name="city" placeholder="City">
                                <input type="password" placeholder="password">
                                <input type="submit" class="btn btn-dark" value="Submit">
                            </form>
                        </div>
                        
                    </div>
                </div>
                					
            </div>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

@endsection