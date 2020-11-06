@extends('welcome')
@section('category_slider_brand')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <p class="alert-danger my-2">
                        <?php
                        $messege = Session::get('messege');
                         if($messege){
                             echo $messege;
                             Session::put('messege',null);
                         }
                        ?>
                    </p>
                <form action="{{url('/faching-customer-login/')}}" method="POST">
                    @csrf
                        <input type="email" placeholder="Email" name="customer_email" />
                        <input type="password" placeholder="Password" name="password" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2> 
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p class="alert-danger my-2">
                        <?php
                        $messege = Session::get('message');
                         if($messege){
                             echo $messege;
                             Session::put('message',null);
                         }
                        ?>
                    </p>
                <form action="{{url('/insert-customer/')}}" method="POST">
                    @csrf
                        <input type="text" required placeholder="Name" name="customer_name"/>
                        <input type="email" required placeholder="Email Address" name="customer_email"/>
                        <input type="text" required placeholder="Phon Number" name="customer_phone"/>
                        <input id="pass1" type="password" placeholder="Password" name="password" required  />
                        
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
    
</section><!--/form-->
@endsection