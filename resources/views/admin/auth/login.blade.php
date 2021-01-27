<!DOCTYPE html>
<html>

<!-- Mirrored from radixtouch.in/templates/admin/smart/source/light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Jul 2018 23:55:09 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Excel , import, spread sheet , google spreadsheet" />
    <meta name="author" content="Online Spread Sheet" />
    <title>Online Spread Sheet | Login</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('assets/plugins/iconic/css/material-design-iconic-font.min.css')}}">
    <!-- bootstrap -->
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/extra_pages.css')}}">
	<!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}" /> 
    <style type="text/css">
    	.wrap-login100 {
		    width: 422px;
		    border-radius: 10px;
		    overflow: hidden;
		    padding: 26px 32px 19px 31px;
		    background: #9152f8;
		    background: -webkit-linear-gradient(top, #69e652, #54af4cc2);
<<<<<<< HEAD
		    background: -o-linear-gradient(top, #69e652, #54af4cc2);
		    background: -moz-linear-gradient(top, #69e652, #54af4cc2);
		    background: linear-gradient(top, #69e652, #54af4cc2);
=======
<<<<<<< HEAD
		    background: -o-linear-gradient(top, #69e652, #54af4cc2);
		    background: -moz-linear-gradient(top, #69e652, #54af4cc2);
		    background: linear-gradient(top, #69e652, #54af4cc2);
=======
		    background: -o-linear-gradient(top, #007bff, #5992d0);
		    background: -moz-linear-gradient(top, #007bff, #5992d0);
		    background: linear-gradient(top, #007bff, #5992d0);
>>>>>>> b4c920d2663870fe6cf850e51a3b33cea0b6eb23
>>>>>>> 23eca530b2df8216f2c70fc526e1fa5d49d2fa34
		}
		.login100-form-logo {
		    font-size: 60px;
		    color: #333333;
		    display: -webkit-box;
		    display: -webkit-flex;
		    display: -moz-box;
		    display: -ms-flexbox;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    width: 147px;
		    height: 148px;
		    border-radius: 16%;
		    background-color: white;
		    margin: 0 auto;
		}
		.login100-form-logo img {
		    width: 139px;
		    border-radius: 0%;
		    box-shadow: 0px 5px 25px 0px rgba(0,0,0,0.2);
		}
    </style>
</head>
<body>
    <div class="limiter">
		<div class="container-login100 page-background">
			<div class="wrap-login100">   
				@if($errors->any())
				<div class="alert alert-danger" role="alert">
					{{ implode('', $errors->all(':message')) }}
				  </div>
				@endif            
                <form class="login100-form validate-form" action="{{route('auth.login')}}" method="post">
                    @csrf
					<span class="login100-form-logo">
						<img alt="" src="{{asset('assets/img/logo.png')}}">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Login
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter Email">
						<label class="text-light"><i class="fa fa-user"></i> Email</label>
						<input class="input100" type="text" name="email" placeholder="Email">
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<label class="text-light"><i class="fa fa-lock"></i> Password</label>
						<input class="input100" type="password" name="password" placeholder="Password">
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
    <!-- start js include path -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}" ></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" ></script>
    <script src="{{ asset('assets/js/pages/extra-pages/pages.js')}}" ></script>
    <!-- end js include path -->
</body>

</html>