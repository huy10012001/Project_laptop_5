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
#loginModal
{
	z-index: 5000;
}
.img-fluid {
    width: 100px;
    height: 70px;
}

.users .dropbtn {
    background-color: #3c9add;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
  }

  .users .dropdown {
    position: relative;
    display: inline-block;
  }

  .users .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
 	 z-index: 1;
	
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
//Show phần modal đăng nhập
function  menuDangNhap()
{
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
				var price= $(this).find('td.price').text();
				if(!!qty)
				{ 
					$(this).find('td.amount').html(qty*price);
					total+=qty*price;
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
				$("#total").html(data.total);//dữ liệu từ response
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
    success: function (data) 
	{
       	if(data.status=="error")
        {
            alert(data.message);
        }
      	location.reload();
	}});
}

$(document).ready(function(){
	//loalad lại trang khi modal đóng
	
 	$("#AlertModal").on('hide.bs.modal', function(){
		location.reload();
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
			<!--Search-->
			<div class="container-fluid"   style="background:  #0099ff;padding-top:10px;">
            <div class="row ">
				<div class="col-sm-2">
                    <a href=""><img src="{{URL::asset('/images/logolap1.jpg')}}" alt="" style="width:150px; height:40px"></a>
                </div>
                <div class="col-sm-6"  >
                    <div  class="search-container "  >
                        <form action="/action_page.php" >
                          <input style="float:left;width:80%;height:40px" type="text" placeholder="tìm kiếm sản phẩm mà bạn mong muốn.." name="search" class="textsearch">
                          <button   style="float:left;width:10%;height:40px" type="submit" class="search"><i class="fa fa-search"></i></button>
                        </form>
                      </div>
				</div>
				@if(!Session::has('key'))
				<div class="col-sm-2">
                    <div class="users" >
                        <div class="dropdown">
                            <button class="dropbtn"> <i class="fa fa-user" aria-hidden="true"></i>	&nbsp;  <b>Tài khoản </b> </button>
                            <div class="dropdown-content">
									<!--modal-->
									<!-- Button trigger modal -->
							<button type="button" id="target"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal">Launch demo modal</button>
						<!-- Modal -->
						<div class="modal fade" id="loginModal" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   						 <div class="modal-dialog">
        				<div class="modal-content">
            			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Modal title</h4>

            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Upload</a>

                        </li>
                        <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Browse</a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab">upload Tab</div>
                        <div role="tabpanel" class="tab-pane" id="browseTab">browseTab</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">Save changes</button>
            </div>
        </div>
    </div>
		</div>
					<!--end modal-->
                              <a href="#">tạo tài khoản</a>
                              <a href="#">Link 3</a>

                            </div>
                        </div>
					</div>
				</div>



                <div class="col-sm-2">
				
                    <div class="cart1">
                       	<button type="button"data-toggle="modal" data-target="#cartModal" style="background: none; border:none; "><i class="fa fa-shopping-cart" style="color:white;"></i>
                        <b style="color: white;">  giỏ hàng   </b>
                        </button>
					</div>
				</div>	
				@else
				<div class="col-sm-2">
                   
                       <button class="dropbtn"> <i class="fa fa-user" aria-hidden="true"></i>	&nbsp;  <b>{{Session::get('key')->name}}</b> </button>
					   <a class="btn btn-primary btn-sm"   onclick="logOut()">
                                        <i class="fas fa-folder"></i> Đăng xuất
                                    </a> 
				</div>
				
				<div class="col-sm-2">
                    <div class="cart1">
                       	<button type="button"data-toggle="modal" data-target="#cartModal" style="background: none; border:none; "><i class="fa fa-shopping-cart" style="color:white;"></i>
                        <b style="color: white;">  giỏ hàng   </b>
                        </button>
					</div>
				</div>	
				@endif
			</div>
			</div>
			<!--end Search-->
        </div><!--/header_top-->
       
          

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
								<li><a href="{{ URL::to('/home') }}" class="active"  style="color: rgb(250, 245, 245);">Trang Chủ</a></li>
								<li class="dropdown"><a href="#"  style="color: rgb(250, 245, 245);">Sản Phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach(App\category::withTrashed()->get() as $c)
										@if($c->product->count()>0)
								<li><a  href="{{ URL::to('/'.$c->name) }}" >{{$c->name}}</a></li>
										@endif
									@endforeach
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#" style="color: rgb(250, 245, 245);">Về Chúng Tôi<i class="fa fa-angle-down"></i></a>
										<ul role="menu" class="sub-menu">
											<li><a href="blog.html" style="color: rgb(250, 245, 245);">thông tin về shop</a></li>
											<li><a href="blog-single.html" style="color: rgb(250, 245, 245);">thông tin LapTop-shop</a></li>
										</ul>
									</li>

									<li><a href="{{ URL::to('/contact') }}" style="color: rgb(250, 245, 245);">liên hệ</a></li>
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
		<div class="modal fade" id="cartModal" role="dialog" aria-labelledby="exampleModalLabel"  data-backdrop="static" data-keyboard="false" aria-hidden="true">
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
                                    <th scope="col"></th>
                                    <th scope="col">sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng cộng</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                                </thead>
                                <tbody class="cart-body">
                                	@foreach(Session::get('cart')->items as $product)
										<tr>		
											<td class="image"><img  height="100px" width="100px" src="{{ url('images/'.App\Product::withTrashed()->find($product['id'])->image) }}" alt="" />
                                    		</td>
                                    		<td class="" style="word-break: break-all;">{{App\Product::withTrashed()->find($product['id'])->name}}</td>
                                      		<!--Trường hợp còn hàng(status là 1)-->
                                    		@if($product['status']==1)
											<td class="price">{{$product['price']}}</td>
											<td class="buttons_added qty ">
											<input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{$product['qty']}}"
                                             onchange="updateModal(this);updateCart(this.value,<?php echo $product['id'] ?>,'',<?php echo $product['time_at'] ?>)">
											</td>
                                    		<td class = "amount">{{$product['amount']}}</td>
                                    		<td>
                                    		<a href="#" onclick="deleteCartModal(<?php echo $product['id'] ?>,'',this,<?php echo $product['time_at']?>)">
                                        	<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        	</svg>
                                    		</a>
                                    		</td>
											@else
                                			<td class="image"><img  height="100px" src="{{ url('images/'.App\Product::withTrashed()->find($product['id'])->image) }}" alt="" />
                                			</td>
                                			<td>{{$product['price']}}</td>
                                			<td class="qty"> </td>
                               		 		<td class = "amount"></td>
                                	 		<td>
                                    		<a href="#" onclick="deleteModal(this);deleteCartModal(<?php echo $product['id'] ?>,'',<?php echo $product['time_at']?>)">
                                    		<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    		<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    		<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    		</svg>
                                    		</a>
                                			</td>
											@endif
										</tr>	 
									@endforeach
								</tbody>
							</table>
						</div>
                        <div class="d-flex justify-content-end">
                                <h5>Total: <span class="price text-success" id="total" >
                                {{Session::get('cart')->totalPrice}}</span></h5>
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
									<tr>
										<td class="image"><img  width="100px"  height="100px" src="{{ url('images/'.$p->image) }}" alt="" />
                                        </td>
                                    	<td style="word-break: break-all;">{{$p->name}}</td>
                                      	<!--Trường hợp còn hàng(status là 1)-->
										<td class="price">{{$p->pivot->price }}</td>
                                       <!--Trường hợp còn hàng(khác trashed)-->
                                    	@if(!($p->trashed()))
										<td class="qty">
                                        <div class="buttons_added">
                                            <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{ $p->pivot->qty}}"
                                         onchange="updateModal(this);updateCart(this.value,'{{$p->id}}','{{$orders->id}}','{{$p->pivot->created_at}}')">
										</div></td>
                                    	<td class = "amount">{{$p->pivot->amount }}</td>
                                    	<td>
                                        <a href="#"  onclick="deleteCartModal('{{$p->id}}','{{$orders->id}}',this,'{{$p->pivot->created_at}}')">
                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          </svg>
                                       </a>
                                       </td>
                                   		@else
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
										@endif
									</tr>
								  	@endforeach
								</tbody>
							</table>
							</div>
                            <div class="d-flex justify-content-end">
                                <h5>Total: <span class="price text-success" id="total" >
                                {{ $orders->total }}</span></h5>
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
								<ul class="nav nav-pills nav-stacked">
								@foreach(App\Category::all() as $c)
								@if($c->product->count()>0)
									<li><a href="{{ URL::to('/'.Str::slug($c->name)) }}" >{{$c->name}}</a></li>
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
