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
<script >


</script>
<script type="text/javascript">

//Ha2m show lai gio hang khi loadlai
$(document).ready(function(){
	if (Cookies.get('modal')=="showed") {
    // show dialog...
	$("#cartModal").modal("show");
}

   
$("#cartModal").on('show.bs.modal', function(){
	
	Cookies.set('modal', 'showed');
	//$.cookie('modal', 'showed');
	//$.cookie("test", 1);
});
 
  $("#cartModal").on('hide.bs.modal', function(){
	//$.removeCookie('showDialog');
//	$.removeCookie("test");
	//$.removeCookie('modal'); 
	Cookies.remove('modal');
	location.reload();
  });
});
	//logOut
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
					//var a=data.status;
					//alert(a);
          		//  document.getElementById("total").innerHTML = 123;
           		}
       		}
    	);
	}
	function updateCart(qty,product_id,order_id)
    {
		
		$.ajax({
				type:  "GET",
      			url:	 " {{ asset('cart/update')}}",
      		 	data:{qty:qty,order_id:order_id,product_id:product_id},
				datatype: 'json',
				success:function(data)
           		{
					//var a=data.status;
					//alert(a);
          		//  document.getElementById("total").innerHTML = 123;
           		}
       		}
    	);
	
		if(qty!="" && qty >0 && qty<=10)
       
		{
			//dùng scrip hoặc ajax cập nhập lại giá tổng tiền
			var total=0;
			$("tbody").find("tr").each(function() {
			var qty = $(this).find('td .input-qty').val();
			var price= $(this).find('td.price').text();
			if(!!qty)
			{ 
				$(this).find('td.amount').html(qty*price);
				total+=qty*price;
			}
 			 });
		
			
		}
    }
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

		 /*	$.ajax({
    		type:  "GET",
    	url: "{{ asset('Addcart')}}",
    
    data: { product_id: product_id },
    datatype: 'json',
    success: function (data) {
        if(data.status=="error")
        {
            alert(data.message);
        }
       
        location.reload();

    },
  
    });*/
    function deleteModal(emn)
	{
		$(emn).closest( "tr" ).hide();
	}
	function deleteCartModal(product_id,order_id)
 	{
		
		$.ajax({
			type:  "GET",//type là get
      		url: " {{ asset('cart/delete')}}",//truy cập tới url cart/delete
      		data:{ order_id:order_id,product_id:product_id},//pass tham số vào key
			datatype: 'json',
         	success:function(data)
           {	
			   
			
			$("#total").html(data.total);//dữ liệu từ response
               //location.reload();
			  
           }
       }
    	);

 	}
 
</script>
 
<style>

.img-fluid {
    width: 100px;
    height: 70px;
}
</style>

<body>



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
							<a href="{{ URL::to('/home')}}"><img src="{{ ('images/logo3.png') }}" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							@if(!Session::has('key'))
								<li ><button><a href="#" style="background: none; color:black;" ><i class="fa fa-user"></i> <b>tài khoản</b></a></button></li>
								<li><button><a href="{{ URL::to('/login') }}" style="background: none; color:black;"><i class="fa fa-lock"></i> <b>Đăng Nhập</b></a></button></li>
							@else
							<li ><button><a href="#" style="background: none; color:black;" ><i class="fa fa-user"></i> <b>{{App\User::find(Session::get('key'))->first()->name}}</b></a></button></li>
								<li><button><a  onclick="logOut()" style="background: none; color:black;"><i class="fa fa-lock"></i> <b>Đăng Xuất</b></a></button></li>
							@endif

							
                                <li>

                                        <button type="button"data-toggle="modal" data-target="#cartModal"><i class="fa fa-shopping-cart"></i>
                                        <b>  giỏ hàng   </b>
                                        </button>


                                <div class="modal fade" id="cartModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <h5 class="modal-title" id="exampleModalLabel">
                                                Your Shopping Cart
                                              </h5>
                                              <button type="button" onclick="javascript:window.location.reload()"  class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
												 <!--Trường hợp user chưa đăng nhập thao tác với session-->
											@if(Session::has('cart'))
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
                                                <tbody class="cart-body">
												<tr>
                                                    <td >
                                                      <img src="{{ ('fronend/images/logo3.png') }}" class="img-fluid img-thumbnail" alt="Sheep"  >
													</td>
													@foreach(Session::get('cart')->items as $product)
												   	
													   
														<td class="">{{App\Product::withTrashed()->find($product['id'])->name}}</td>
												      <!--Trường hợp còn hàng(status là 1)-->
														@if($product['status']==1)
														  
           												<td class="price">{{$product['price']}}</td>
                                                   		
                                                        <td class="buttons_added qty ">
														
                                                            <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{$product['qty']}}"
                                 							onchange="updateCart(this.value,<?php echo $product['id'] ?>,<?php echo $product['price'] ?>)">

														</td>
                                                   	 <td class = "amount">{{$product['amount']}}</td>
                                                   	 <td>
                                                      <a href="#" onclick="deleteModal(this);deleteCartModal(<?php echo $product['id'] ?>)">
                                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                          </svg>
                                                      </a>
													</td>
													
													</tr>
													
													@else
													<td>{{$product['price']}}</td>
                                                    <td class="qty"> </td>
                                                    <td class = "amount"></td>
                                                    <td>
                                                      <a href="#" onclick="deleteModal(this);deleteCartModal(<?php echo $product['id'] ?>)">
                                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                          </svg>
                                                      </a>
													</td>
													
												  	</tr>
													@endif
												  @endforeach	
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-end">
                                                <h5>Total: <span class="price text-success" id="total" >
												{{Session::get('cart')->totalPrice}}</span></h5>
											</div>
											 <!--Trường hợp user  đăng nhập thao tác với database-->
											@elseif(isset($orders))
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
                                                  <tr>
                                                    <td>
                                                      <img src="{{ ('fronend/images/logo3.png') }}" class="img-fluid img-thumbnail" alt="Sheep"  >
													</td>
													@foreach($orders->product as $p)
												   
													<td>{{$p->name}}</td>
												      <!--Trường hợp còn hàng(status là 1)-->
            									  
           											<td class="price">{{$p->pivot->price }}</td>
													   <!--Trường hợp còn hàng(khác trashed)-->
													@if(!($p->trashed()))
                                                    <td class="qty">
                                                        <div class="buttons_added">
															<input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{ $p->pivot->qty}}"
                                 						onchange="updateModal(this);updateCart(this.value,'{{$p->id}}','{{$orders->id}}')">

                                                        </div></td>
                                                    <td class = "amount">{{$p->pivot->amount }}</td>
                                                    <td>
                                                      <a href="#"  onclick="deleteModal(this);deleteCartModal('{{$p->id}}','{{$orders->id}}',)">
                                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                          </svg>
                                                      </a>
													</td>
													</tr>
													@else
													
                                                    <td class="qty"> </td>
                                                    <td class = "amount"></td>
                                                    <td>
                                                      <a href="#"  onclick="deleteModal(this);deleteCartModal('{{$p->id}}','{{$orders->id}}',)">
                                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                          </svg>
                                                      </a>
													</td>
													
													
												  	</tr>
													@endif
												  @endforeach	
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-end">
                                                <h5>Total: <span class="price text-success" id="total" >
												{{ $orders->total }}</span></h5>
											</div>
								@endif

													
                                            </div><!--/cart model-->
                                            <div class="modal-footer border-top-0 d-flex justify-content-between">
                                              <button onclick="javascript:window.location.reload()"yyyyyyyyyyyy type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right:400px;">Close</button>
                                              <button type="button" class="btn btn-success" ><a href="{{ URL::to('/cart-detail') }}" style="background: none; color:black;"><b>kiểm tra</b></a> </button>

                                            </div>
                                          </div>
                                        </div>
                                      </div>




                                </li>





							
							</ul>
						</div>
                    </div>
                    <!---->
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
								<li><a href="{{ URL::to('/home') }}" class="active">Trang Chủ</a></li>
								<li class="dropdown"><a href="#">Sản Phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach(App\Category::all() as $c)
										@if($c->product->count()>0)
										<li><a href=" {{url('product/'.$c->name)}}">{{$c->name}}</a></li>
										@endif
									@endforeach
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Về Chúng Tôi<i class="fa fa-angle-down"></i></a>
										<ul role="menu" class="sub-menu">
											<li><a href="blog.html">thông tin về shop</a></li>
											<li><a href="blog-single.html">thông tin LapTop-shop</a></li>
										</ul>
									</li>

									<li><a href="{{ URL::to('/contact') }}">liên hệ</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="search_box pull-right">
								<input type="text" placeholder="Search"/>
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
