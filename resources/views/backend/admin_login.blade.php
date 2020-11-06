<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="{{asset("backend/css/admin_login_style.css")}}" />
</head>
<body>
<div class="container">

	<section id="content">

	<form action="{{url('/admin_login')}}" method="POST">
		@csrf
			<h1>Login Form</h1>
			<p class="alert-danger my-2">
				<?php
				$messege = Session::get('messege');
				 if($messege){
					 echo $messege;
					 Session::put('messege',null);
				 }
				?>
			</p>
			<div>
				<input type="text" placeholder="Username" name="admin_name" required="" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" name="admin_password" required="" id="password" />
			</div>
			<div>
				<input type="submit" value="Log in" />
				<a href="#">Lost your password?</a>
				<a href="#">Register</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>