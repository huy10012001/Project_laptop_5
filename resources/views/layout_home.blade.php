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
<style>

	.shoppingcart button
	{
		border: 2px solid white !important;
  		padding: 14px 20px;
  		font-size: 16px;
          cursor: pointer;
          height: 50px;

	}
	.khonghoatdong {
    opacity: 0.7;
    background-color: #ccc;

}

.cart_product {
    position: relative;


}
.cart_product .badge
{
    position: absolute;
    top:-10px;
    width: 100px;
    color:black;
    background-color: red;
}
.cart_product img
{
    margin-top:10px;
}
#loginModal
{
	z-index: 5000;
}
.img-fluid {
    width: 100px;
    height: 70px;
}

.users .dropbtn {
	width: 150px;
    background-color: #0099ff;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
border: 2px solid white;

  }

  .users .dropdown {
    position: relative;
    display: inline-block;
  }

  .users .dropdown-content {
	display: none;
	position: absolute;
    background-color:white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
 	 z-index: 1;
	padding-bottom: 10px;
  }

  .users .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .users .dropdown-content a:hover {background-color: #ddd;}

  .users .dropdown:hover .dropdown-content {display: block;}

  .users .dropdown:hover .dropbtn {background-color: #61a2d0;}
/*drowdown*/
</style>
</head><!--/head-->

<script type="text/javascript">
//load lại trang khi user bấm back
if(!!window.performance && window.performance.navigation.type === 2)
{

    window.location.reload();
}
//search

//tạo tài khoản

//Show phần modal đăng nhập
	function dangnhap()
	{
		$('#uploadTabLogin').addClass('active');
		$('#liLogin').addClass('active');
	}

	function  dangky()
	{

		$('#browseTabLogin').addClass('active');
		$('#liRegister').addClass('active');
		//$('.users .dropdown-content').css('display','block');

	}
//Hàm log out
function logOut()
{
	$.ajax({
			type:  "GET",
      		url:	 " {{ asset('/logout')}}",
      		data:{logout:'true'},
			datatype: 'json',
			success:function(data)
           	{
				 location.reload();

           	}
       	}
    );
}
//hàm update số lượng item ở modal
function updateCart(qty,product_id,order_id,timecreate)
{
	$.ajax({
		type:  "GET",
    	url:	 " {{ asset('cart/update')}}",
      	data:{qty:qty,order_id:order_id,product_id:product_id,timecreate:timecreate},
		datatype: 'json',
		success:function(data)
        {
			if(data.status)
			{
				if($("#noFindItem").text().length<80)
				$("#noFindItem").append("không tìm thấy item ");
			}
            else if(qty!="" && qty >0 && qty<=10)
       		{
					//dùng scrip hoặc ajax cập nhập lại giá tổng tiền
				var total=0;
				$("tbody").find("tr").each(function() {
				var qty = $(this).find('td .input-qty').val();
				var price= $(this).find('td.price').text().replace(" đ","");

				if(!!qty)
				{
					var amount=qty*price+" đ"
					$(this).find('td.amount').html(amount);
					var total=data.total +" đ"
					$('#total').html(total);

				}
 			});
		}}
    });
}
//Hàm xóa số lượng item ở modal
function deleteCartModal(product_id,order_id,emn,timecreate)
{

	$.ajax({
		type:  "GET",//type là get
      	url: " {{ asset('cart/delete')}}",//truy cập tới url cart/delete
      	data:{ order_id:order_id,product_id:product_id,timecreate:timecreate},//pass tham số vào key
		datatype: 'json',
        success:function(data)
        {
			if(data.status)
			{
				if($("#noFindItem").text().length<80)
				$("#noFindItem").append("không tìm thấy item ");
			}
			else
			{
				var total=data.total +" đ"
					$('#total').html(total);

				$(emn).closest( "tr" ).hide();
			}
		}
    });
}

//Khi nhập số lượng bé hơn 1 hoặc lớn 10 ở modl
function updateModal(qty)
{
		//Nếu nhập bé hơn 1 thì mặc định là 1
	if($(qty).val()<1)
	{
		var error="số lượng phải từ 1 tới 10 và không được trống";
		$(qty).val(1);
	}
	else if($(qty).val()>10)
	{
		var error="số lượng phải từ 1 tới 10 và không được trống";
		$(qty).val(10);
	}
}

//Hàm add giỏ hàng
function AddCart(product_id)
{


    $.ajax({
    type:  "GET",
    url: "{{ asset('Addcart')}}",
    data: { product_id: product_id },
    datatype: 'json',
	error:function(xhr)
      {
         var x=xhr.responseText;
            x=$.parseJSON(x);
         console.log(x.message);
	},
    success: function (data)
	{
       	if(data.status=="error")
        {
            alert(data.message);
        }
      	location.reload();
	}});
}


$(document).ready(function()
{

	 $('.textsearch').on('keyup',function(){

                $value = $(this).val();

                $.ajax({
                    type: 'get',
                    url:  " {{ asset('/livesearch')}}",
                    data: {
                        'search': $value
                    },
					error:function(xhr)
            {
                var x=xhr.responseText;
                 x=$.parseJSON(x);
                     console.log(x.message);

             },
                    success:function(data){
						console.log(data);
						if(data.status!="")
						{$('.resultsearch').show();
						$('.resultsearch tbody').html(data.status);
						}
                    }
                });
            })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

	$("#loginModal").on('hide.bs.modal', function(){
		$('#uploadTabLogin').removeClass('active');
		$('#browseTabLogin').removeClass('active');
		$('#liLogin').removeClass('active');
		$('#liRegister').removeClass('active');
 	});
	 //search
	 $('#search').submit(function(e)
    {
		var x=$('.textsearch').val();
		e.preventDefault();
        $.ajaxSetup(
        {
            headers:
            {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
		window.location.href = "/search?keyword="+x;

    });
    //đăng nhập và đăng ký
    $('#login').submit(function(e)
    {
        e.preventDefault();
        $.ajaxSetup(
        {
            headers:
            {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
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

                    if(data.status=="Thành công" ||data.status=="admin")
                    {
                      location.reload();
                    }
                    else
                    $("#dangnhap").html(data.status)
                    $("#dangnhap").css('color','red');

           	    }
        	});

    });
         //đăng ký  mua hàng khi user chua đăng nhập
    $('#register').submit(function(e)
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
      		url:	 " {{ asset('/postRegisterCheckOut')}}",
      		data:$('#register').serialize(),
			datatype: 'json',
			error:function(xhr)
            {
               var x=xhr.responseText;
                  x=$.parseJSON(x);
                           console.log(x.message);

                        },
			success:function(data)
           	{

                if(data.status=="Thành công")
                {
					location.reload();
                }


           	}
        });
    });
});
 /*
	if (Cookies.get('modal')=="showed") {
    // show dialog...
	$("#cartModal").modal("show");
}

$("#cartModal").on('show.bs.modal', function(){

	Cookies.set('modal', 'showed');

});

  $("#cartModal").on('hide.bs.modal', function(){

	Cookies.remove('modal');

  });
  function checkOut()
	{

		Cookies.remove('modal');

	}*/



	//logOut


</script>
<body>

	<header id="header" ><!--header-->
		<div class="header_top" ><!--header_top-->
			<div class="container">
				<div class="row" >
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
		</div>
			<!--Search-->
		<div class="header-middle"   style="background:#0099ff">
            <div class="container">
				<div class="row" >
					<div class="col-sm-2">
                    		<a href=""><img src="{{URL::asset('/images/logolap1.jpg')}}" alt="" style="width:150px; height:40px"></a>
                	</div>
                	<div class="col-sm-6" >
                    		<div  class="search">
							<form id="search"   method="get" >
							{{csrf_field()}}
                         	 	<input style="float:left;width:80%;height:40px" type="text" placeholder=" tìm kiếm sản phẩm mà bạn mong muốn.." name="search" class="textsearch">
                          		<button   style="float:left;width:20%;height:40px" type="submit" class="search"><i class="fa fa-search"></i> Tìm kiếm</button>

							</form>

							<table hidden class="resultsearch table table-bordered table-hover" style="background-color: white;">
                                <thead>
                                    <tr>

										<th></th>
                                        <th>ID</th>
                                        <th>Tên sản phẩn</th>

                                        <th>Gía</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                      		</div>
					</div>
					@if(!Session::has('key'))
					<div class="col-sm-2" >
							<div class="users"  >

                        		<div class="dropdown" >

									  <button class="dropbtn" style="text-align: center">

                                        <i class="fa fa-user" aria-hidden="true"></i> &nbsp; <b>Đăng Nhập</b> </button>
                          			<div class="dropdown-content" >
									<!--modal-->
									<!-- Button trigger modal -->
										<button type="button" onclick="dangnhap()" id="target1"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal" style="width: 100%;">Đăng nhập    </button>
										<button type="button" onclick="dangky()" id="target2"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal" style="width: 100%; margin-top:0px;">Tạo tài khoản    </button>
									</div>
                        		</div>
							</div>

					</div>
					@else
					<div class="col-sm-2" >
							<div class="users"  >

                        		<div class="dropdown" >

									  <button class="dropbtn" style="text-align: center">

									   <b>Chào {{Session::get('key')->name}}</b> <br>  </button>
                          			<div class="dropdown-content">
									<!--modal-->
									<!-- Button trigger modal -->
										<button type="button"  onclick="logOut()" id="target1"  class="btn btn-primary btn-lg" style="width: 100%;">Đăng xuất   </button>

									</div>
                        		</div>
							</div>

					</div>


					@endif

					<div class="col-sm-2 shoppingcart">

                       		<button  type="button"data-toggle="modal" data-target="#cartModal" style="background: none; border:none; ">
							   <div classs>
							   <i class="fa fa-shopping-cart" style="color:white;"></i>
							   <b style="color: white;">  giỏ hàng</b>

							   @if(isset($totalQty))
							   <span class="label label-warning">{{$totalQty}}</span>
							   @endif

							   <div>
                        	</button>

					</div>
					<div class="clear" style="clear: both;"></div>
				</div>
			</div>
		</div>
			<!--end Search-->
        <!--/header_top-->



		<div class="header-bottom"    style="background:  #0099ff;margin-bottom:20px"><!--header-bottom-->
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
								<li><a href="{{ URL::to('/home') }}" class="active"  style="color: rgb(250, 245, 245);"><i class="fa fa-home" aria-hidden="true"></i> &nbsp; Trang Chủ</a></li>

								@if(isset($category) && $category->count()>0)
								<li class="dropdown"><a href="#"  style="color: rgb(250, 245, 245);"><i class="fa fa-laptop" aria-hidden="true"></i> &nbsp; Sản Phẩm</a>
                                    <ul role="menu"  style="word-break: break-all;" class="sub-menu">
									@foreach($category as $c)

										<li><a href="{{ URL::to('/'.Str::slug($c->name)) }}" >{{$c->name}}</a></li>


									@endforeach
                                    </ul>
								</li>
								@endif
								<li class="dropdown"><a href="#" style="color: rgb(250, 245, 245);"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;Về Chúng Tôi</a>
										<ul role="menu" class="sub-menu">
											<li><a href="blog.html" style="color: rgb(250, 245, 245);">thông tin về shop</a></li>
											<li><a href="blog-single.html" style="color: rgb(250, 245, 245);">thông tin LapTop-shop</a></li>
										</ul>
									</li>

									<li><a href="{{ URL::to('/contact') }}" style="color: rgb(250, 245, 245);"><i class="fa fa-phone-square" aria-hidden="true"></i> &nbsp;
                                        liên hệ</a></li>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div><!--/header-bottom-->
        </header><!--/header-->



	<!--slider-->
	@yield('slide')
	<!--/slider-->

		<section>
			<div class="container">
				<div class="row">
					<!--tìm theo chi tiết-->
					@yield('detail_home')
					<!--end tìm theo chi tiéte-->

					<!--sản phẩm-->
					@yield('product')
					<!--end sản phẩm-->
					@yield('detail')
					<!--ccontact-->
					@yield('contact')
					<!--end contact-->
					@yield('dell')
					<!--sản phẩm dell-->




					<!--login-->
					@yield('login')
					<!--end login-->

					<!--cart_detail-->
					@yield('cart_detail')
					<!--end cart detail-->
				</div>
			</div>
		</section>
<!-- Modal  login-->
<div class="modal fade" id="loginModal" data-backdrop="static"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
					<button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

					</button>


				</div>
				<div class="modal-body" style="display: block; z-index:1;">
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" id="liLogin" ><a href="#uploadTabLogin" aria-controls="uploadTab" role="tab" data-toggle="tab">ĐĂng Nhập</a>

							</li>
							<li role="presentation" id="liRegister" ><a href="#browseTabLogin" aria-controls="browseTab" role="tab" data-toggle="tab">ĐĂNG KÍ</a>

							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane " id="uploadTabLogin" >
								<form   id="login" method="post" action="javascrip:void(0)" >
								{{ csrf_field() }}
								<h3  style="text-align: center;">Đăng Nhập</h3>
									<h5 style="color: rgb(12, 12, 12);" >Email:</h5>
									<input type="email" class="form-control" name="email" required><br>
									<h5 style="color: rgb(15, 15, 15);">Password:</h5>
									<input type="password"   required name="password"  class="form-control" ><br>
									<div id="dangnhap"></div>
									<button type="submit"  class="btn btn-primary" style=" border-radius: 15px;">đăng nhập</button>

									<p style="color: rgb(26, 24, 24);">bạn đã có tài khoản?



								</p>

								</form></div>
							<div role="tabpanel" class="tab-pane" id="browseTabLogin"   >
								<form  id="register" method="post" action="javascrip:void(0)">
									{{ csrf_field() }}
									<h3 style="text-align: center;">Tạo tài khoản</h3>
									<h5 style="color: rgb(12, 12, 12);" >Họ và tên:</h5>
									<input type="text" class="form-control" name="name" required placeholder="Họ và tên"><br>
									<h5 style="color: rgb(12, 12, 12);" >SĐT:</h5>
									<input type="text" class="form-control" name="SĐT" required placeholder="Nhập số điện thoại"><br>
									<h5 style="color: rgb(12, 12, 12);" >Địa chỉ:</h5>
									<input type="text" class="form-control" name="address" required><br>
									<h5 style="color: rgb(12, 12, 12);" >Email:</h5>
										<input type="email" class="form-control" name="email" required placeholder="email"><br>
										<h5 style="color: rgb(15, 15, 15);">Mật Khẩu:</h5>
										<input type="password"   required name="password"  class="form-control" placeholder="Mật khẩu"><br>
										<button type="submit" class="btn btn-primary" style=" border-radius: 15px;">xác nhận tạo tài khoảng</button>
									<p>Khi bạn nhấn Đăng ký, bạn đã đồng ý thực hiện mọi giao dịch mua bán theo điều kiện sử dụng và chính sách của LapTop-shop.</p>
									</form>
							</div>
						</div>


					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
			</div>


<!--modal alert-->
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

	</div>

		<div class="modal fade"  id="cartModal" role="dialog" aria-labelledby="exampleModalLabel"  data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">
                                Your Shopping Cart
                        </h5>
                        <button type="button" onclick="javascript:window.location.reload()"  class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
							</button>
							<div id="noFindItem" style="color:red;"></div>
                    </div>
                    <div class="modal-body">
                     <!--Trường hợp user chưa đăng nhập thao tác với session-->
                    @if(Session::has('cart'))
						<div class="table table-responsive">
							<table class="table table-image">
                                <thead>
                                <tr>

									<th scope="col">sản phẩm</th>
									<th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng </th>
                                    <th scope="col">Tổng cộng</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                                </thead>
                                <tbody class="cart-body">
									@php  $sum=0 @endphp
									@foreach(Session::get('cart')->items as $product)
										@if(App\Product::find($product['id']))
											@if(App\Product::find($product['id'])->status=="1")
											<tr>
											<td class="image"><img  height="100px" width="100px" src="{{ url('images/'.App\Product::find($product['id'])->image) }}" alt="" />
                                    		</td>
                                    		<td class="" style="word-break: break-all;">{{App\Product::find($product['id'])->name}}</td>
                                      		<!--Trường hợp còn hàng(status là 1)-->

											<td class="price">{{App\Product::find($product['id'])->price}} đ</td>
											<td class="buttons_added qty ">
											<input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{$product['qty']}}"
                                             onchange="updateModal(this);updateCart(this.value,<?php echo $product['id'] ?>,'',<?php echo $product['time_at'] ?>)">
											</td>
                                    		<td class = "amount">{{App\Product::find($product['id'])->price*$product['qty']}} đ</td>
                                    		<td>
												@php $sum+=App\Product::find($product['id'])->price*$product['qty'] @endphp
                                    		<a href="#" onclick="deleteCartModal(<?php echo $product['id'] ?>,'',this,<?php echo $product['time_at']?>)">
                                        	<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        	</svg>
                                    		</a>
											</td>
											</tr>
											@else
											<tr class="khonghoatdong" >
												<td class="image">

													<img  height="100px" width="100px" src="{{ url('images/'.App\Product::find($product['id'])->image) }}" alt="" />
                                    			</td>
                                    			<td class="" style="word-break: break-all;">{{App\Product::find($product['id'])->name}}</td>
                                      			<!--Trường hợp còn hàng(status là 1)-->

												  <td class="price">{{App\Product::find($product['id'])->price}} đ</td>
                                				<td class="qty"> </td>
                               		 			<td class = "amount"></td>
                                	 			<td>
												 <a href="#" onclick="deleteCartModal(<?php echo $product['id'] ?>,'',this,<?php echo $product['time_at']?>)">
                                        	<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        	</svg>
                                    		</a>
											</td>
											</tr>
											<tr class="khonghoatdong"><td colspan="6">
										 <span class="badge" >Không hoạt động</span>
										 </td>

										@endif
										 @endif

									@endforeach
								</tbody>
							</table>
						</div>
                        <div class="d-flex justify-content-end">
                                <h5>Total: <span class="price text-success" id="total" >
                                {{$sum}} đ</span></h5>
                        </div>
                            <!--Trường hợp user  đăng nhập thao tác với database-->
					@elseif(isset($orders))
					<div class="table table-responsive">
						<table class="table table-image">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng cộng</th>
                                <th scope="col">Xóa</th>
                            </tr>
                            </thead>
                                <tbody>
									 @foreach($orders->product as $p)

									  @if($p->status=="1")
									<tr>

										<td class="image"><img  width="100px"  height="100px" src="{{ url('images/'.$p->image) }}" alt="" />
                                        </td>
                                    	<td style="word-break: break-all;">{{$p->name}}</td>
                                      	<!--Trường hợp còn hàng(status là 1)-->
										<td class="price">{{$p->pivot->price }} đ</td>


										<td class="qty">
                                        <div class="buttons_added">
                                            <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{ $p->pivot->qty}}"
                                         onchange="updateModal(this);updateCart(this.value,'{{$p->id}}','{{$orders->id}}','{{$p->pivot->created_at}}')">
										</div></td>
                                    	<td class = "amount">{{$p->pivot->amount }} đ </td>
                                    	<td>
                                        <a href="#"  onclick="deleteCartModal('{{$p->id}}','{{$orders->id}}',this,'{{$p->pivot->created_at}}')">
                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          </svg>
                                       </a>
									   </td>
									</tr>
									 @else

									   <tr class="khonghoatdong" >

										<td class="image">

										<img  width="100px"  height="100px" src="{{ url('images/'.$p->image) }}" alt="" />
                                        </td>
                                    	<td style="word-break: break-all;">{{$p->name}}</td>

										<td class="price">{{$p->pivot->price }}  đ</td>
                                      	<td class="qty"> </td>
                                    	<td class = "amount"></td>
                                    	<td>
                                      	<a href="#"  onclick="deleteCartModal('{{$p->id}}','{{$orders->id}}',this,'{{$p->pivot->created_at}}')">
                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                      	</a>
										   </td>
										 </tr>
										 <tr class="khonghoatdong"><td colspan="6">
										 <span class="badge" >Không hoạt động</span>
										 </td>
										</tr>
										</div>
										@endif

								  	@endforeach
								</tbody>
							</table>
							</div>
                            <div class="d-flex justify-content-end">
                                <h5>Total: <span class="price text-success" id="total" >
                                {{ $orders->total }} đ</span></h5>
							</div>
							<!--end cart body-->
                			@endif
							</div><!--/cart model-->
                            <div class="modal-footer border-top-0 d-flex justify-content-between">
                              <button onclick="javascript:window.location.reload()"yyyyyyyyyyyy type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right:400px;">Close</button>
							  <a href="{{url('/cart')}}" style="background: none; color:black;"> <button type="button"  class="btn btn-success" ><b>kiểm tra</b> </button></a>

							</div>
                </div>
            </div>
        </div>
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
								@if(isset($category) && $category->count()>0)
								<ul class="nav nav-pills nav-stacked">


									@foreach($category as $c)

										<li><a href="{{ URL::to('/'.Str::slug($c->name)) }}" >{{$c->name}}</a></li>


									@endforeach

								</ul>
								@endif
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
