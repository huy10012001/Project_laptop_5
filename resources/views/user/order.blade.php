




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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
</head><!--/head-->


<body>


		<section>
			<div class="container">
				<div class="row">
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
//load lại trang khi user bấm back
if(performance.navigation.type == 2){
   location.reload(true);
}
    function Update()

    {
        //khi click update thi from update hien ra, form khach an di
      $('#khach').hide();
      $('#update').show();
    }
    function getUpdate()
    {
        //khi bấm xác nhận sẽ lấy value từ input form update thay thế cho text form khach
        $('#ten').text('Họ và tên'+ $("input[name=name]").val());
        $('#phone').text('SDT:'+ $("input[name=phone]").val());
        $('#add').text('DIA CHI :'+ $("input[name=address]").val());
        $('#update').hide();
        $('#khach').show();
    }
    function huy()
    {

        $('#update').hide();
        $('#khach').show();
    }
    function tienhanh()
    {
       
        var product_update =[];
        $(".product_update").each(function() {
        product_update.push($(this).val());
        });

        var user_id =$("input[name=id]").val();
        $.ajax({
            type:  "GET",
      		url:	 " {{ asset('/isDangNhap')}}",
      		data: { check:"true",user_id:user_id,status:"login" },
			datatype: 'json',
            error:function(data)
            {
                alert('lỗi rồi bạn');
            }
            ,
			success:function(data)
           	{
               
             
                //Khi order mới cập nhập hoặc khi đăng nhập tài khoản khác
                if(data.status=="phiên kết thúc")
                {
                    alert("Có lỗi xảy ra hoặc phiên làm việc kết thúc,xin vui lòng thử lại. ");
                    setTimeout(function () {
                    window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
                    }, 1000); //will call the function after 2 secs.
                }
                //khi thoát đăng phienhập
                else if(data.status=="thoát đăng nhập")
                {
                    alert("phiên làm việc hết hạn");
                    setTimeout(function () {
                    window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
                     }, 1000); //will call the function after 2 secs.
                }
                //Nếu chưa cập nhập xong thông báo
                else if( $('#update').is(":visible"))
                {
                    alert("bạn chưa cập nhập xong");
                }
                //Order
             
                else 
                {
                    $name= $("input[name=name]").val();
                    $phone=$("input[name=phone]").val();
                    $add=$("input[name=address]").val();

		            $.ajax({
			            type:  "GET",//type là get
      		            url: " {{ asset('/getOrder')}}",//truy cập tới url cart/delete
      		            data:{ name:$name,phone:$phone,address:$add,product_update:product_update},//pass tham số vào key
			          
                        datatype: 'json',
                        error:function(data)
                        {
                            alert('lỗi rồi');
                            
                        },
         	            success:function(data)
                        {
                          
                        
                            //nếu giỏ hàng thay đổi trong lúc order
                            if(data.status=="thay đổi")
                                alert("Bạn vừa thay đổi giỏ hàng, vui lòng load lại trang");
						   else if(data.status=="giỏ hàng của bạn trống")
                                alert("giỏ hàng của bạn trống");

                          
                            else 
                          {
                              alert('Bạn đã đặt hàng thành công');
                              setTimeout(function () {
                             window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
                              }, 3000); //will call the function after 2 secs.
                            }
                        }
                    });
                }
           	}
        });
    }
</script>


@if(Session::has('key'))
<table>
<tr>
<td>
<!-- Form giỏ hàng -->
<!-- Nếu user đăng nhập -->

 <section id="cart_items">
		<div class="container">
            <div class="row">
                <div class="col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
                 <h3>2.Kiểm tra Thông tin và thanh toán</h3>
                 @if(isset($orders))
                     @if($orders->total==0)
                     <div class="alert alert-danger">
                     <strong>Giỏ hàng của bạn đang trống!</strong> 
                    </div>
                     @endif
                @else
                    <div class="alert alert-danger">
                     <strong>Giỏ hàng của bạn đang trống!</strong> 
                     </div>
                @endif
                </ol>
                
            </div>
          
			<div class="table-responsive cart_info" style="margin-top: -40px;">
				<table class="table table-condensed" >
					<thead>
						<tr class="cart_menu" style="color: black;">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">giá</td>
							<td class="quantity">số lượng</td>
							<td class="total">tổng tiền</td>
							<td></td>
						</tr>
                    </thead>
                    
					@if(isset($orders))
					@foreach($orders->product as $p)
                    @if(!($p->trashed()))
						<tr>
                            <td class="cart_product">
							    <a href=""><img src="" alt=""> </a>
						    </td>
						    <td class="cart_name">
							<h4>{{$p->name}}</h4>
                            </td>
                            <td class="cart_price">
						    <p> {{$p->pivot->price }}</p>
                            </td>
                            <input type="hidden"  value="{{$p->pivot->updated_at}}" class="product_update" />
                            <!--Trường hợp còn hàng(khác trashed)-->

                            <td class="">
						        <div class="buttons_added">
                                <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number"
                                 value="{{ $p->pivot->qty}}"
                                readonly>
                                </div>
						        </td>

						        <td class="cart_total">
							    <p class="cart_total_price">{{$p->pivot->amount }}</p>
						        </td>

                                </td>

                    <!-- end chi tiết giỏ hàng user-->
                     @endif
                        </tr>
					@endforeach
					@endif
					
				</table>
            </div>
        </div>

        </div>

    </div>
 </td>
 <!-- end form giỏ hàng của user-->


</tr></table>


<div class="comtainer">
    <div class="row">
        <div class="col-sm-8" style="margin-top: 80px;">
    <div id="dialog" hidden>Your non-modal dialog</div>
<form  id="khach" action="">
  <h5  id="ten" style="color: rgb(12, 12, 12);" >Họ và tên: {{Session::get('key')->name}}</h5>
    <h5  id="phone"style="color: rgb(12, 12, 12);" >SĐT:  {{Session::get('key')->phone}}</h5>

    <h5  id="add"  style="color: rgb(12, 12, 12);" >Địa chỉ: {{Session::get('key')->address}}</h5> 

       
     
      

                <button id="updateX" type="button" onclick="Update()"  class="btn btn-primary ">Sửa</button>

 </form>

<form  id="update" hidden action="">


                                <h5 style="color: rgb(12, 12, 12);" >Họ và tên:</h5>
                                <input   value="{{Session::get('key')->name}}"  type="text" class="form-control" name="name" required ><br>
                                <h5 style="color: rgb(12, 12, 12);" >SĐT:</h5>
                                <input    value="{{Session::get('key')->phone}}"   type="text" class="form-control" name="phone" required placeholder="Nhập số điện thoại"><br>
                                <h5    style="color: rgb(12, 12, 12);" >Địa chỉ:</h5>
                                <input   value="{{Session::get('key')->address}}"   type="text" class="form-control" name="address" required placeholder="Nhập số điện thoại"><br>
                <button id="huy " onclick="huy()" type="button"  class="btn btn-primary ">Huy</button>
                <button  id="oK" onclick="getUpdate()"    type="button"   class="btn btn-primary ">xác nhận</button>
 </form>
</div>
 <div class="col-sm-4">
    <table class="table table-striped" style="margin-top:110px;" >
        <tr>
            <td>tạm tính: </td>
			@if(isset($orders) ) 
			<td>{{ $orders->total }}vnd
			</td>
			@else
			<td>0 vnd
			</td>
			@endif

        </tr>

	</table >
	@if(isset($orders)) 
    <table class="table table-striped">
     <tr>
		<td> Thành tiền:</td>
	
        <td>{{ $orders->total  }}
		vnd <br><p>đã bao gồm thuế (VAT)</p></td>
		
    </tr>
    </table>
    <!-- Button trigger modal -->
   <input type="hidden" name="id" value="{{Session::get('key')->id}}">
    <button type="button" class="btn btn-primary " onclick="tienhanh()">Tiến hành đặt </button>
	@else
	<table class="table table-striped">
     <tr>
		<td> Thành tiền:</td>
	
        <td>0 vnd <br><p>đã bao gồm thuế (VAT)</p></td>
		
    </tr>
    </table>
    <!-- Button trigger modal -->
   <input type="hidden" name="id" value="{{Session::get('key')->id}}">
    <button type="button" class="btn btn-primary " onclick="tienhanh()">Tiến hành đặt </button>
	@endif
	
</div>

</div>
<div class="clear" style="width:1000px;height:50px;"></div>
</div>





</section>


 <!--Nếu user chưa đăng nhập truy cập trang order-->
 @else 
<script>
 alert("phiên làm việc hết hạn");
 setTimeout(function () {
    window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
    }, 1000); //will call the function after 2 secs.


 //window.location.href = "{{URL::to('/home')}}"
</script> 
<table>
<tr>
<td>
<!-- Form giỏ hàng -->
<!-- Nếu phiên làm việc hết hạn-->

 <section id="cart_items">
		<div class="container">
            <div class="row">
                <div class="col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				 <h3>2.Kiểm tra Thông tin và thanh toán</h3>
				</ol>
			</div>
			<div class="table-responsive cart_info" style="margin-top: -40px;">
				<table class="table table-condensed" >
					<thead>
						<tr class="cart_menu" style="color: black;">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">giá</td>
							<td class="quantity">số lượng</td>
							<td class="total">tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					
				</table>
            </div>
        </div>

        </div>

    </div>
 </td>
 <!-- end form giỏ hàng của user-->


</tr></table>


<div class="comtainer">
    <div class="row">
        <div class="col-sm-8" style="margin-top: 80px;">
    <div id="dialog" hidden>Your non-modal dialog</div>
<form  id="khach"  action="">
   Họ và tên:  
    Số điện thoại:

    địa chỉ:
    <button id="updateX" type="button"  class="btn btn-primary ">Sửa</button>

 </form>


</div>
 <div class="col-sm-4">
    <table class="table table-striped" style="margin-top:110px;" >
        <tr>
            <td>tạm tính: </td>
            <td>0 vnd

            </td>

        </tr>

    </table >
    <table class="table table-striped">
     <tr>
        <td> Thành tiền:</td>
        <td>0 vnd <br><p>đã bao gồm thuế (VAT)</p></td>
    </tr>
    </table>
    <!-- Button trigger modal -->
   <input type="hidden" name="id">
    <button type="button" class="btn btn-primary " >Tiến hành đặt </button>

</div>

</div>
<div class="clear" style="width:1000px;height:50px;"></div>
</div>





</section>
 
@endif
		
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
								@foreach(App\Category::all() as $c)
								@if($c->product->count()>0)
									<li><a href=" {{url('product/'.$c->name)}}">{{$c->name}}</a></li>
								@endif
								@endforeach
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
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="single-widget">
                                <h2>Địa Chỉ và Liên Hề</h2>
                                <ul class="nav nav-pills nav-stacked">

                                    <li><a href="#">- Thời gian mở cửa 8:00-22:00</a></li>
                                    <li><a href="#">- Từ Thứ 2 đến chủ nhật </a></li>

                                </ul>
                            </div>
                        </div>
                    </div> 

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

