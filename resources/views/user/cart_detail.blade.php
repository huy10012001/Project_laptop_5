<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
if(!!window.performance && window.performance.navigation.type === 2)
{
    console.log('Reloading');
    window.location.reload();
}


    //sbmit form data use ajax
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
			    success:function(data)
           	    {
                    if(data.status=="Thành công")
                    {
                       window.location.href = "http://stackoverflow.com"; 
                    }
                    else
                    $("#dangnhap").html(data.status)
                    $("#dangnhap").css('color','red');
               // location.reload();
					//var a=data.status;
					//alert(a);
          		//  document.getElementById("total").innerHTML = 123;
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
			    success:function(data)
           	    {
                    if(data.status=="Thành công")
                    {
                       window.location.href = "http://stackoverflow.com"; 
                    }
                   
               // location.reload();
					//var a=data.status;
					//alert(a);
          		//  document.getElementById("total").innerHTML = 123;
           	    }
        	});
        });
    });
  
    function onChange(qty,product_id,order_id)
    {
      
         $.get(
        " {{ asset('cart/update')}}",
         {
           qty:qty,order_id:order_id,product_id:product_id,
             function()
           {
             
               location.reload();
           }
       }
    );
       
    }
    
    function deleteCart(product_id,order_id)
    {
    $.get(
       " {{ asset('cart/delete')}}",
       {
         order_id:order_id,product_id:product_id,
         function()
           {
               location.reload();
           }
       }
    );
    }
</script>
@extends('layout_home')
@section( 'cart_detail')
<!-- Phần sửa lại  nếu có session -->

@if(Session::has('cart'))

	<section id="cart_items">
		<div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Giỏ hàng</a></li>
				  <li class="active">chi tiết giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
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
					@foreach(Session::get('cart')->items as $product)
						<tr>
                            <td class="cart_product">
							    <a href=""><img src="" alt=""> </a>
						    </td>
						    <td class="cart_name">
							<h4>{{App\Product::withTrashed()->find($product['id'])->name}}</h4>
                            </td>
                            <td class="cart_price">
						    <p> {{$product['price']}}</p>
                            </td>
                            <!--Trường hợp còn hàng(status là 1)-->
                            @if($product['status']==1)
                                
                            <td class="">
							<div class="buttons_added">
                             <input aria-label="quantity"
                             class="input-qty" max="10" min="1" name="" required  type="number" 
                             value="{{$product['qty']}}"
                             onChange="onChange(this.value,<?php echo $product['id'] ?>)">
                            </div>
							</td>
						        <td class="cart_total">
							    <p class="cart_total_price">{{$product['amount']}}</p>
						        </td>
						        <td class="cart_delete">
						        <a class="cart_quantity_delete" href=""    onclick="deleteCart(<?php echo $product['id'] ?>)"><i class="fa fa-times"></i></a>
                                </td>
                            
                            <!--Trường hợp hết hàng show giá + dòng đã hết hàng-->
                            @else
                               
                                <td></td>
                                <td></td>
                                <td class="cart_delete">
						        <a class="cart_quantity_delete" href=""    onclick="deleteCart(<?php echo $product['id'] ?>)"><i class="fa fa-times"></i></a>
                                </td>        
                            @endif
                        </tr>
                    @endforeach
				</table>
            </div>
        </div>
        <div class="col-sm-3">
            <table class="table table-striped" style="margin-top:110px;" >
                <tr>
                    <td>tạm tính: </td>
                    <td> {{Session::get('cart')->totalPrice}}

                    </td>

                </tr>

            </table >
            <table class="table table-striped">
             <tr>
                <td> Thành tiền:</td>
                <td> {{Session::get('cart')->totalPrice}} <br><p>đã bao gồm thuế (VAT)</p></td>
            </tr>
            </table>
            <!-- Button trigger modal -->



  <!-- Modal -->
  <!--form đăng nhập cart-->
  <!--Neu user da dang nhap thi redirec toi trang checkout-->


  <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">Tiến hành đặt </button>
<!-- Modal -->
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">vui lòng đăng nhập trước khi thanh toán</h4>

            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">ĐĂng Nhập</a>

                        </li>
                        <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">ĐĂNG KÍ</a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab"> 
                            <form   id="login" method="post" action="javascrip:void(0)" >
                            {{ csrf_field() }}
                            <h3  style="text-align: center;">Đăng Nhập</h3>
                                <h5 style="color: rgb(12, 12, 12);" >Email:</h5>
                                <input type="email" class="form-control" name="email" required><br>
                                <h5 style="color: rgb(15, 15, 15);">Password:</h5>
                                <input type="password"   required name="password"  class="form-control" ><br>
                                <div id="dangnhap"></div>
                                <button type="submit" class="btn btn-primary" style=" border-radius: 15px;">đăng nhập</button>
                                
                                <p style="color: rgb(26, 24, 24);">bạn đã có tài khoản?



                            </p>

                            </form></div>
                        <div role="tabpanel" class="tab-pane" id="browseTab" method="post" action="javascrip:void(0)" >
                            <form  id="register" action="" method="post">
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

<!-- end form đăng nhập cart-->
        </div>
        </div>

    </div>
    <div class="container" style="height: 100px;">

    </div>
            <script>//<![CDATA[
$('input.input-qty').each(function() {
  var $this = $(this),
    qty = $this.parent().find('.is-form'),
    min = Number($this.attr('min')),
    max = Number($this.attr('max'))
  if (min == 0) {
    var d = 0
  } else d = min
  $(qty).on('click', function() {
    if ($(this).hasClass('minus')) {
      if (d > min) d += -1
    } else if ($(this).hasClass('plus')) {
      var x = Number($this.val()) + 1
      if (x <= max) d += 1
    }
    $this.attr('value', d).val(d)
  })
})
//]]></script>

    </section> <!--/#cart_items-->
<!--Trường hợp user đã đăng nhập thao tác với datbase-->
@elseif(isset($orders))
@if(Session::has('qty'))
    {{Session::get('qty')}}
    {{ Session::forget('qty')}}
@endif
	<section id="cart_items">
		<div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Giỏ hàng</a></li>
				  <li class="active">chi tiết giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
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
					@foreach($orders->product as $p)
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
                            <!--Trường hợp còn hàng(khác trashed)-->
                            @if(!($p->trashed()))
                            <td class="">
						        <div class="buttons_added">
                                <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" 
                                 value="{{ $p->pivot->qty}}"
                                 onChange="onChange(this.value,'{{$p->id}}','{{$orders->id}}')">
                                </div>
						        </td>
						      
						        <td class="cart_total">
							    <p class="cart_total_price">{{$p->pivot->amount }}</p>
						        </td>
						        <td class="cart_delete">
						        <a class="cart_quantity_delete" href=""      onclick="deleteCart('{{$p->id}}','{{$orders->id}}',)">
                                <i class="fas fa-trash"><i class="fa fa-times"></i></a>
                                </td>
                            
                            <!--Trường hợp hết hàng -->
                            @else
                                <td ></td>
                                <td></td>
                               
                                <td class="cart_delete">
						        <a class="cart_quantity_delete" href=""   onclick="deleteCart('{{$p->id}}','{{$orders->id}}',)"><i class="fa fa-times"></i></a>
                                
                            </td>        
                            @endif
                        </tr>
                    @endforeach
				</table>
            </div>
        </div>
        <div class="col-sm-3">
            <table class="table table-striped" style="margin-top:110px;" >
                <tr>
                    <td>tạm tính: </td>
                    <td>{{ $orders->total  }}vnd

                    </td>

                </tr>

            </table >
            <table class="table table-striped">
             <tr>
                <td> Thành tiền:</td>
                <td>{{ $orders->total  }}vnd <br><p>đã bao gồm thuế (VAT)</p></td>
            </tr>
            </table>
            <!-- Button trigger modal -->

            <button type="button" class="btn btn-primary " onclick="location.href='https://topdev.vn/'">Tiến hành đặt </button>
<!-- end form đăng nhập cart-->
        </div>
        </div>

    </div>
    <div class="container" style="height: 100px;">

    </div>
            <script>//<![CDATA[
$('input.input-qty').each(function() {
  var $this = $(this),
    qty = $this.parent().find('.is-form'),
    min = Number($this.attr('min')),
    max = Number($this.attr('max'))
  if (min == 0) {
    var d = 0
  } else d = min
  $(qty).on('click', function() {
    if ($(this).hasClass('minus')) {
      if (d > min) d += -1
    } else if ($(this).hasClass('plus')) {
      var x = Number($this.val()) + 1
      if (x <= max) d += 1
    }
    $this.attr('value', d).val(d)
  })
})
//]]></script>

    </section> <!--/#cart_items-->
@endif
@endsection

