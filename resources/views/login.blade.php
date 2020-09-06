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
				error:function(xhr)
                        {
                            var x=xhr.responseText;
                            x=$.parseJSON(x);
                           console.log(x.message);

                        },
			    success:function(data)
           	    {

					if(data.status=="admin")
					{
						window.location.href ="{{ asset('/admin/laptopshop')}}"
					}

                    else
					{
						$("#AlertModal .modal-body").html("tài khoản không có trong hệ thống");
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
