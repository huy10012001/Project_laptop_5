




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
$(document).ready(function()
{
    $('#update input').keyup(function(e)
    {
		$(this).css('border','');
	});

    $( "#update" ).submit(function(e) {
        $('.error').each(function() {
			$(this).text('');
		});
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
      		    url:	 " {{ asset('/postDiaChiCheckOut')}}",
      		    data:$('#update').serialize(),
			    datatype: 'json',
				error:function(error)
            {
                $('.error').each(function() {
			        $(this).text('');
		        });
             		var x=error.responseText;
                  	x=$.parseJSON(x);
                  
					let errors = error.responseJSON.errors;
                    console.log(errors);

					//FOCUS vào lỗi đầu tiên
					var errorsfocus=Object.keys(errors)[0];
                    if(errorsfocus!="message")
					var nameFocus=$("#update input[name="+errorsfocus+"]");
                    else
                    var nameFocus=$("#update .yourmessage");
					nameFocus.focus();
					//nameFocus.focus();
					//console.log(a.val());
					//$(`.error[data-error="${errors[0]}"]`).focus();
      				for(let key in errors)
       			{
         			let errorDiv = $(`.error[data-error="${key}"]`);
         			if(errorDiv.length )
         			{

             			 errorDiv.text(errors[key][0]);
						 $("#formContact input[name="+key+"]").css('border','2px solid red');
         			}
					 //nếu không có lỗi

        		}
				//const propertyNames = Object.keys(errors);
				////$.each(errors, function( index, value ) {
					//$('#emailTontaiR').text(errors.email);
				//})
					//errors=JSON.stringify(errors.error);

              },
			    success:function(data)
           	    {

                    $("#update").hide();
                    $("#khach").show();
                    $("#khach input[name=name]").val(data.name) ;
                    $("#khach input[name=phone]").val(data.phone) ;
                    $("#khach input[name=address]").val(data.address) ;

           	    }
        	});
    });
});
if(performance.navigation.type == 2){
   location.reload(true);
}
    function Update()

    {
        //khi click update thi from update hien ra, form khach an di
      $('#khach').hide();
      $('#update').show();
    }


    function huy()
    {

        $('#update').hide();
        $('#khach').show();
    }
    function tienhanh()
    {
        var name=$("#khach input[name=name]").val() ;
        var khach=$("#khach input[name=phone]").val() ;
        var add=$("#khach input[name=address]").val() ;
        if(name==""||khach==""||add=="")
        {
            $("#AlertModal .modal-body").html("bạn chưa cập nhập đầy đủ thông tin"); 
            $("#AlertModal").modal("show");
        }
        else
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
                        $("#AlertModal .modal-body").html("Có lỗi xảy ra hoặc phiên làm việc kết thúc,xin vui lòng thử lại. ");
                            $("#AlertModal").modal("show");


                        setTimeout(function () {
                        window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
                        }, 1000); //will call the function after 2 secs.
                    }
                    //khi thoát đăng phienhập
                    else if(data.status=="thoát đăng nhập")
                    {
                        $("#AlertModal .modal-body").html("phiên làm việc hết hạn ");
                            $("#AlertModal").modal("show");

                        setTimeout(function () {
                        window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
                        }, 1000); //will call the function after 2 secs.
                    }
                    //Nếu chưa cập nhập xong thông báo
                    else if( $('#update').is(":visible"))
                    {
                        $("#AlertModal .modal-body").html("bạn chưa cập nhập xong");
                            $("#AlertModal").modal("show");
                    }
                    //Order

                    else
                    {
                        $("#waitModal").modal("hide");
                        $name= $("#khach  input[name=name]").val();
                        $phone=$("#khach input[name=phone]").val();
                        $add=$("#khach input[name=address]").val();

                        $.ajax({

                            type:  "GET",//type là get
                            url: " {{ asset('/getOrder')}}",//truy cập tới url cart/delete
                            data:{ name:$name,phone:$phone,address:$add,product_update:product_update},//pass tham số vào key

                            datatype: 'json',
                            beforeSend: function(){

                                $("#waitModal .modal-body").html("Bạn chờ tí nhé,..");
                                $("#waitModal").modal("show");
                            },
                            error:function(xhr)
                            {
                                var x=xhr.responseText;
                                x=$.parseJSON(x);
                            console.log(x.message);

                            },
                            success:function(data)
                            {


                                //nếu giỏ hàng thay đổi trong lúc order
                                if(data.status=="thay đổi")
                                {
                                    $("#waitModal").modal("hide");
                                    $("#AlertModal .modal-body").html("Giỏ hàng của bạn có sự thay đổi");
                                    $("#AlertModal").modal("show");
                                }

                            else if(data.status=="giỏ hàng của bạn trống")
                                {
                                    $("#waitModal").modal("hide");
                                    $("#AlertModal .modal-body").html("Giỏ hàng của bạn trống");
                                    $("#AlertModal").modal("show");
                                }


                                else
                            {
                            
                                    $("#waitModal").modal("hide");
                                    $("#AlertModal .modal-body").html("Bạn đã đặt hàng thành công, vui lòng check mail");
                                  
                                    $("#AlertModal").modal("show");
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
    }
</script>


@if(Session::has('key'))
<table>
<tr>
<td>
<!-- Form giỏ hàng -->
<!-- Nếu user đăng nhập -->
<div class="modal fade" id="waitModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body" style=" text-align: center;">
          <p>Bạn chờ tí nhé</p>
        </div>
        
      </div>
      
    </div>
  </div>
  
	</div>
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
							<td class="image"></td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">giá</td>
							<td class="quantity">số lượng</td>
							<td class="total">tổng tiền</td>
							<td></td>
						</tr>
                    </thead>

					@if(isset($orders))
                    @foreach($orders->product as $p)
                     <!--Trường hợp còn hàng(status là 1)-->
                    @if($p->status=="1")
						<tr>
                            <td class="cart_product" >
                            <img style=" margin-right:5em;" width="100px" height="80px" src="{{ url('images/'.$p->image) }}"/>

						    <td class="cart_name">
							<h4 >{{$p->name}}</h4>
                            </td>
                            <td class="cart_price">
						    <p style="white-space: nowrap;">	{{number_format($p->pivot->price,0,",",".")}} đ</p>
                            </td>
                            <input type="hidden"  value="{{$p->pivot->updated_at}}" class="product_update" />


                            <td class="" style="text-align: center;">
						             {{$p->pivot->qty}}
						     </td>

						        <td class="cart_total" style="white-space: nowrap;">
							    <p class="cart_total_price">	{{number_format($p->pivot->amount,0,",",".")}} đ</p>
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
   Họ và tên: <input   value="{{Session::get('key')->name}}"   type="text" class="form-control" name="name" required placeholder="Nhập số điện thoại" disabled><br>
    Số điện thoại<input   value=" {{Session::get('key')->phone}}"   type="text" class="form-control" name="phone" required placeholder="Nhập số điện thoại" disabled><br>

    địa chỉ:<input   value="{{Session::get('key')->address}}"   type="text" class="form-control" name="address" required placeholder="Nhập số điện thoại" disabled><br>
     <button id="updateX" type="button" onclick="Update()"  class="btn btn-primary ">Sửa</button>

 </form>

<form  id="update"  hidden method="post" action="javascrip:void(0)">
        {{csrf_field()}}
            <h5 style="color: rgb(12, 12, 12);" >Họ và tên <sup>*</sup></h5>
            <input   value="{{Session::get('key')->name}}" type="text" class="form-control" name="name" ><br>
            <div class="text-danger error" data-error="name"></div>
            <h5 style="color: rgb(12, 12, 12);" >SĐT <sup>*</sup></h5>
            <input    value="{{Session::get('key')->phone}}" type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"><br>
            <div class="text-danger error" data-error="phone"></div>
            <h5    style="color: rgb(12, 12, 12);" >Địa chỉ <sup>*</sup></h5>
            <input   value="{{Session::get('key')->address}}"  type="text" class="form-control" name="address"  placeholder="Nhập số điện thoại"><br>
            <div class="text-danger error" data-error="address"></div>
            <button id="huy " onclick="huy()" type="button"  class="btn btn-primary ">Hủy</button>
            <input type="submit"    id="oK" value="xác nhận"   class="btn btn-primary "/>

 </form>
</div>
 <div class="col-sm-4">
    <table class="table table-striped" style="margin-top:110px;" >
        <tr>
            <td>tạm tính: </td>
			@if(isset($orders) )
			<td>{{number_format($orders->total,0,",",".")}} đ
			</td>
			@else
			<td>0 đ
			</td>
			@endif

        </tr>

	</table >
	@if(isset($orders))
    <table class="table table-striped">
     <tr>
		<td> Thành tiền:</td>

        <td>	{{number_format($orders->total,0,",",".")}} đ<br><p>đã bao gồm thuế (VAT)</p></td>

    </tr>
    </table>
    <!-- Button trigger modal -->
   <input type="hidden" name="id" value="{{Session::get('key')->id}}">
    <button type="button" class="btn btn-primary " onclick="tienhanh()">Thanh toán </button>
	@else
	<table class="table table-striped">
     <tr>
		<td> Thành tiền:</td>

        <td>0 đ <br><p>đã bao gồm thuế (VAT)</p></td>

    </tr>
    </table>
    <!-- Button trigger modal -->Update



    
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
							<td class="image"></td>
							<td class="description">Tên sản phẩm</td>
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
<form  id="khach" action="">
   Họ và tên: <input    type="text" class="form-control" name="name" required placeholder="Nhập số điện thoại" disabled><br>
    Số điện thoại<input    type="text" class="form-control" name="phone" required placeholder="Nhập số điện thoại" disabled><br>

    địa chỉ:<input    type="text" class="form-control" name="address" required placeholder="Nhập số điện thoại" disabled><br>



                <button id="updateX" type="button" onclick="Update()"  class="btn btn-primary ">Sửa</button>

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

$( document ).ready(function() {
    $("#AlertModal .modal-body").html("Trang chỉ dành cho thành viên đăng ký");
 $("#AlertModal").modal("show");
});


 setTimeout(function () {
    window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
    }, 1000); //will call the function after 2 secs.


 //window.location.href = "{{URL::to('/home')}}"
</script>
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
</body>
</html>

