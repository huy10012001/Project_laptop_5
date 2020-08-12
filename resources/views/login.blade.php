<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | LapTop_shop</title>
    <link href="{{ asset('fronend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('fronend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/style_overview.css') }}" rel="stylesheet">
    <link href="{{ asset('fronend/css/style.css') }}" rel="stylesheet">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <!-- /fonts -->

</head><!--/head-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

	 $(document).ready(function()
    {
        //đăng nhập mua hàng khi user chua đăng nhập
     
        $('#login').submit(function(e)
        {
            e.preventDefault();
            $.ajaxSetup(
                {
                    headers:
                    {
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                }
            );
           
            $.ajax({
			    method:'post',
      		    url:	 " {{ asset('/postLoginCheckOut')}}",
      		    data:$('#login').serialize(),
			    datatype: 'json',
				error:function(data)
				{
					alert('loi roi')
				},
			    success:function(data)
           	    {
					 
					if(data.status=="admin")
					{
						window.location.href ="{{ asset('/admin/product/index')}}"
					}					
                    
                    else
					{
						$("#AlertModal .modal-body").html("tài khoảng không có trong hệ thống");
                    	$("#AlertModal").modal("show");
					}
                   
               // location.reload();
					//var a=data.status;
					//alert(a);
          		//  document.getElementById("total").innerHTML = 123;
           	    }
        	});
           
        });
	});
</script>
<body>
<div class="modal fade" id="AlertModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body" style=" text-align: center;">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +08 123 456 789</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i>laptopshop@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container" >
				<div class="row">
					<div class="col-sm-4" >
						<div class="logo pull-left">
							<a href="{{ URL::to('/home')}}"><img src="{{ ('public/fronend/images/logo3.png') }}" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#" style=" border-radius: 5px; background:rgb(243, 244, 245); color:rgb(24, 22, 22);  box-sizing: border-box; border: 1px solid blue;"><i class="fa fa-user"></i> tài khoản</a></li>


								<li><a href="cart.html"  style=" border-radius: 5px; background:rgb(236, 239, 240); color:rgb(15, 15, 15);  box-sizing: border-box;  border: 1px solid blue;"><i class="fa fa-shopping-cart"></i> giỏ hàng</a></li>
								<li><a href="{{ URL::to('/login') }}"  style=" border-radius: 5px; background:rgb(249, 250, 250); color:rgb(14, 13, 13);  box-sizing: border-box;  border: 1px solid blue;"><i class="fa fa-lock"></i> đăng nhập</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ URL::to('/home') }}" class="active" >Trang Chủ</a></li>
								<li class="dropdown"><a href="#" style="color: white;">Sản Phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ URL::to('/product') }}">Dell</a></li>
										<li><a href="product-details.html">HP</a></li>
										<li><a href="checkout.html">ASUS</a></li>
										<li><a href="cart.html">MacBook</a></li>
										<li><a href="login.html">Huawei</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#" style="color: white;">Về Chúng Tôi<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">thông tin sản phẩm</a></li>
										<li><a href="blog-single.html">thông tin LapTop-shop</a></li>
                                    </ul>
                                </li>

								<li><a href="{{ URL::to('/contact') }}" style="color: white;">liên hệ</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->


	<section>
        <div class="container-fluit">
		<h1 class="w3ls">Đăng Nhập</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">LAPTOP-SHOP</h2>
		<p class="agileits2">đem đến tương lai cho bạn.</p>
	</div>
	<div class="content-agile2">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
				<form id="login" method="post" action="javascrip:void(0)" >
        {{ csrf_field() }}		
            <h5 style="color: white;" >Email:</h5>
            <input type="email" class="form-control" name="email" required><br>
            <h5 style="color: white;">Password:</h5>
            <input type="password"   required name="password"  class="form-control" ><br>
            <button type="submit" class="btn btn-primary" style=" border-radius: 15px;">đăng nhập</button>
            <p style="color: white;">bạn đã có tài khoản?  <a href="#">Đăng kí</a></p>

		</form>
		{{-- <script type="text/javascript">
			window.onload = function () {
				document.getElementById("password1").onchange = validatePassword;

			}
			function validatePassword(){

				var pass1=document.getElementById("password1").value;
				if(pass1!=pass2)
					document.getElementById("password2").setCustomValidity("Passwords Don't Match");
				else
					document.getElementById("password2").setCustomValidity('');
					//empty string means no validation error
			}
        </script> --}}
        <br>

		<ul class="social-agileinfo wthree2">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-youtube"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
		</ul>
    </div>
</div>
</div>
</div>
	<div class="clear"></div>
</div>









        </div>
	</section>

	<footer id="footer"><!--Footer-->


		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>CHÍNH SÁCH VÀ HỖ TRỢ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phương Thức Thanh toán</a></li>
								<li><a href="#">Phương Thức vận chuyển</a></li>
								<li><a href="#">Giao Hàng Tận nhà</a></li>
								<li><a href="#">Quy Định Bảo hành</a></li>
								<li><a href="#">Quy Định Đặt Cọc</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Hãng Laptop </h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Dell</a></li>
								<li><a href="#">Asus</a></li>
								<li><a href="#">MacBook</a></li>
								<li><a href="#">HP</a></li>
								<li><a href="#">Huewai</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Địa Chỉ và Liên Hề</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="https://www.google.com/maps/place/FPT-Aptech+Computer+Education+HCM/@10.7865832,106.6639139,17z/data=!4m12!1m6!3m5!1s0x31752ed2392c44df:0xd2ecb62e0d050fe9!2sFPT-Aptech+Computer+Education+HCM!8m2!3d10.7865832!4d106.6661026!3m4!1s0x31752ed2392c44df:0xd2ecb62e0d050fe9!8m2!3d10.7865832!4d106.6661026?hl=vi-VN">- Đ/C :590 Cách Mạng Tháng Tám, Phường 11, Quận 3, Hồ Chí Minh 723564, Việt Nam</a></li>
                                <li><a href="#">- Số điện thoại liên hệ:  +08 123 456 789</a></li>
                                <li><a href="#">- email: Laptopshop@gmail.com</a></li>
                                <li><a href="#">- Thời gian mở cửa 8:00-22:00</a></li>
                                <li><a href="#">- Từ Thứ 2 đến chủ nhật </a></li>
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>

							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>MAP</h2>
							<ul class="nav nav-pills nav-stacked">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.322629018092!2d106.66391391406837!3d10.786583192314618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ed2392c44df%3A0xd2ecb62e0d050fe9!2sFPT-Aptech%20Computer%20Education%20HCM!5e0!3m2!1svi!2s!4v1595300155497!5m2!1svi!2s" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
							</ul>
						</div>
					</div>


                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-8">
                            <div class="single-widget">
                                <h2>Địa Chỉ và Liên Hề</h2>
                                <ul class="nav nav-pills nav-stacked">

                                    <li><a href="#">- Thời gian mở cửa 8:00-22:00</a></li>
                                    <li><a href="#">- Từ Thứ 2 đến chủ nhật </a></li>

                                </ul>
                            </div>
                        </div>
                    </div> --}}

				</div>
			</div>
        </div>
        <div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2020 laptop-shop Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Nhóm 5</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



    <script src="{{ asset('fronend/js/jquery.js') }}"></script>
	<script src="{{ asset('fronend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('fronend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('fronend/js/price-range.js') }}"></script>
    <script src="{{ asset('fronend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('fronend/js/main.js') }}"></script>
</body>
</html>
