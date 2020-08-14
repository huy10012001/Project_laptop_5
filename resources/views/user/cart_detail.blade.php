
<style>

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

//Hàm update item ở giỏ hàng
function onChange(qty,product_id,order_id,timecreate)
{
   $.ajax({
			type:  "GET",//type là get
      		url: " {{ asset('cart/update')}}",//truy cập tới url cart/delete
      		data:{ qty:qty, order_id:order_id,product_id:product_id,timecreate:timecreate},//pass tham số vào key
			datatype: 'json',
           error:function(data)
           {
               alert('co loi');
           },
         	success:function(data)
            {
                 
                //khi số lượng bé hơn 1 và lớn hơn 10
                if(data.soluong=="1")
                {
                    $("#AlertModal .modal-body").html("Số lượng phải từ 1 tới 10");
                    $("#AlertModal").modal("show");
                }
                //khi không tìm thấy item
                else if(data.status)
                 {
               
                    $("#AlertModal .modal-body").html("không tìm thấy item");
                    $("#AlertModal").modal("show");
                }
                else
                {
                  location.reload();
                }
			 }
    });
}
//Hàm xóa item ở giỏ hàng
function deleteCart(product_id,order_id,timecreate)
{
    $.ajax({
		type:  "GET",//type là get
      	url: " {{ asset('cart/delete')}}",//truy cập tới url cart/delete
      	data:{ order_id:order_id,product_id:product_id,timecreate:timecreate},//pass tham số vào key
		datatype: 'json',
        error:function(data)
        {
            alert('lỗi');
        },
        success:function(data)
        {	
           
            //khi không tìm thấy item
           
            if(data.status)
            {
                $("#AlertModal .modal-body").html("không tìm thấy item");
                $("#AlertModal").modal("show");
            }
            else
            {
                location.reload();
            }
        }
    });
}
//hàm tiến hành đặt
function dat(login)
{
    var user_id =$("input[name=id]").val();
    $.ajax({
        type:  "GET",
      	url:	 " {{ asset('/isDangNhap')}}",
      	data: { check:"true" ,user_id:user_id,status:login},
		datatype: 'json',
        error:function(data)
        {
            alert('có lỗi')
        }
        ,
		success:function(data)
        {
            //khi đăng nhập  bằng tài khoản khác  hoặc vừa đăng nhập ở bên tab khác
            if(data.status=="phiên kết thúc")
            {
                $("#AlertModal .modal-body").html("phiên làm việc không đúng hoặc hết hạn, mời bạn đăng nhập lại");
                $("#AlertModal").modal("show");
                window.location.href = "{{ asset('/home')}}"; 
            }
            else if(data.status=="đăng nhập")
            {
                window.location.href = "{{ asset('/order')}}"; 
                      
            }
            //Thoát đăng nhập tab khác
            else if(data.status=="thoát đăng nhập")
            {
                $('#modalCheckOut').modal('show');
            }
        }
    });
           
}
    //sbmit form data use ajax
 $(document).ready(function()
{
    //đăng nhập mua hàng khi user chua đăng nhập
    $('#loginCheckOut').submit(function(e)
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
      		    data:$('#loginCheckOut').serialize(),
			    datatype: 'json',
                error:function(data)
                {
                    alert('loi');
                },
			    success:function(data)
           	    { 
                    
                    if(data.status=="Thành công" ||data.status=="admin")
                    {
                       window.location.href = "{{asset('/order')}}"; 
                    }
                    else
                    $("#dangnhap").html(data.status)
                    $("#dangnhap").css('color','red');
              
           	    }
        	});
           
    });
         //đăng ký  mua hàng khi user chua đăng nhập
    $('#registerCheckOut').submit(function(e)
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
      		data:$('#registerCheckOut').serialize(),
			datatype: 'json',
			success:function(data)
           	{
                 
                if(data.status=="Thành công")
                {
                       window.location.href = "{{asset('/order')}}"; 
                }
                   
             
           	}
        });
    });
});

</script>
@extends('layout_home')
@section( 'cart_detail')
<!-- Phần sửa lại  nếu có session -->
<div id="no"></div>

@if(Session::has('key'))
<input type="hidden" name="id" value="{{Session::get('key')->id}}">
@endif
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
							<td class="nameproduct">Tên sản phẩm</td>
							<td class="price">giá</td>
							<td class="quantity">số  lượng</td>
							<td class="total">tổng tiền</td>
							<td><p style="width:30px"></p></td>
						</tr>
                    </thead>
                    @php $sum=0;$totalqty=0 @endphp
					@foreach(Session::get('cart')->items as $product)
						    
                            <!--Trường hợp còn hàng(status là 1)-->
                          
                            @if(App\Product::find($product['id'])->status=="1")
                            <tr>
                            <td class="image"><img  height="100px" width="100px" src="{{ url('images/'.App\Product::find($product['id'])->image) }}" alt="" /> 
                            <td class="cart_name">
                           <h4 style="word-break: break-all;">{{App\Product::find($product['id'])->name}}</h4>
                           </td>
                           <td class="cart_price">
                           <p> {{App\Product::find($product['id'])->price}}</p>
                           </td> 
                            <td class="">
							<div class="buttons_added">
                             <input aria-label="quantity"
                             class="input-qty" max="10" min="1" name="" required  type="number" 
                             value="{{$product['qty']}}"
                             onChange="onChange(this.value,<?php echo $product['id']?>,'',<?php echo $product['time_at'] ?>
                             )">
                            </div>
                            </td>
                            <td class="cart_amount">
                           <p> {{App\Product::find($product['id'])->price*$product['qty']}} </p>
                             @php $sum+=App\Product::find($product['id'])->price*$product['qty']; @endphp
                             @php $totalqty+=$product['qty']; @endphp
                            </td> 
						    <td class="cart_delete">
						        <button class="cart_quantity_delete" href=""    onclick="deleteCart(<?php echo $product['id'] ?>,'',<?php echo $product['time_at']?>)"><i class="fa fa-times"></i></button>
                              </td>
                            <!--Trường hợp hết hàng show giá + dòng đã hết hàng-->
                            @else
                            <tr class="khonghoatdong">
                                <td class="cart_product">
                                <span class="badge">Không hoạt động</span>
                                    <img  height="100px" width="100px" src="{{ url('images/'.App\Product::find($product['id'])->image) }}" alt="" /> 
                                <td class="cart_name">
                                <h4 style="word-break: break-all;">{{App\Product::find($product['id'])->name}}</h4>
                                </td>
                                <td>{{App\Product::find($product['id'])->price}}</td>
                                <td></td>
                                <td></td>
                                <td class="cart_delete">
						        <button class="cart_quantity_delete" href=""    onclick="deleteCart(<?php echo $product['id'] ?>,'',<?php echo $product['time_at']?>)"><i class="fa fa-times"></i></button>
                                </td>   
                                </tr>
                            @endif
                      
                    @endforeach
				</table>
            </div>
        </div>
        <div class="col-sm-3">
        <table class="table table-striped" style="margin-top:110px;" >
                <tr>
                    <td>tổng số lượng : </td>
                    <td> {{$totalqty}}</td>

                    

                </tr>

            </table >
            <table class="table table-striped"  >
                <tr>
                    <td>tạm tính: </td>
                    <td> {{$sum}}

                    </td>

                </tr>

            </table >
            <table class="table table-striped">
             <tr>
                <td> Thành tiền:</td>
                <td> {{$sum}} <br><p>đã bao gồm thuế (VAT)</p></td>
            </tr>
            </table>
            <!-- Button trigger modal -->



  <!-- Modal -->
  <!--form đăng nhập cart-->
  <!--Neu user da dang nhap thi redirec toi trang checkout-->

  
  <button type="button" onclick="dat()" class="btn btn-primary "   data-target="#modalCheckOut">Tiến hành đặt </button>
<!-- Modal -->
<div class="modal fade" id="modalCheckOut"  data-backdrop="static"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <li role="presentation" class="active"><a href="#uploadTabCheckOut" aria-controls="uploadTab" role="tab" data-toggle="tab">ĐĂng Nhập</a>

                        </li>
                        <li role="presentation"><a href="#browseTabCheckOut" aria-controls="browseTab" role="tab" data-toggle="tab">ĐĂNG KÍ</a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTabCheckOut"> 
                            <form   id="loginCheckOut" method="post" action="javascrip:void(0)" >
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
                        <div role="tabpanel" class="tab-pane" id="browseTabCheckOut" method="post" action="javascrip:void(0)" >
                            <form  id="registerCheckOut" action="" method="post">
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
@elseif(isset($orders) && $orders->product->count()>0 )

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
							<td class="image"></td>
							<td class="nameproduct">Tên sản phẩm</td>
							<td class="price">giá</td>
							<td class="quantity">số lượng</td>
							<td class="total">tổng tiền</td>
                            <td><p style="width:30px"></p></td>
						</tr>
                    </thead>
                    <tbody class="cart-body" tyle="word-break:break-all;">
                        @php $totalqty=0 @endphp
                    @foreach($orders->product as $p)

                    @if($p->status=="1")
						<tr >
                            <td class="cart_product">
							   <img width="100px"  style=" margin-right:5em; height:100px" src="{{ url('images/'.$p->image) }}"/> 
						    </td>
						    <td class="cart_name" >
							<h4 style="word-break: break-all;" >{{$p->name}}</h4>
                            </td>
                            <td class="cart_price">
						    <p> {{$p->pivot->price }}</p>
                            </td>
                            <!--Trường hợp còn hàng(khác trashed)-->
                            
                            <td class="">
						        <div class="buttons_added">
                                <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" 
                                 value="{{ $p->pivot->qty}}"
                                 onChange="onChange(this.value,'{{$p->id}}','{{$orders->id}}','{{$p->pivot->created_at}}')">
                                </div>
						        </td>
                                @php $totalqty+=$p->pivot->qty @endphp
						        <td class="cart_total">
							    <p class="cart_total_price">{{$p->pivot->amount }}</p>
						        </td>
						        <td class="cart_delete">
						        <button class="cart_quantity_delete" href=""      onclick="deleteCart('{{$p->id}}','{{$orders->id}}','{{$p->pivot->created_at}}')">
                                <i class="fas fa-trash"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            <!--Trường hợp hết hàng -->
                            @else
                      
                            <tr class="khonghoatdong">
                            <td class="cart_product">
                            
                            <span class="badge">Không hoạt động</span>
             
                            <img width="100px"  style=" margin-right:5em; height:100px" src="{{ url('images/'.$p->image) }}"/> 
                          
                            </td>
						    <td class="cart_name" s>
							<h4 style="word-break: break-all;" >{{$p->name}}</h4>
                            </td>
                            <td class="cart_price">
						    <p> {{$p->pivot->price }}</p>
                            </td>
                                <td ></td>
                                <td></td>
                               
                                <td class="cart_delete">
						        <button class="cart_quantity_delete" href=""   onclick="deleteCart('{{$p->id}}','{{$orders->id}}','{{$p->pivot->created_at}}')"><i class="fa fa-times"></i></button>
                                
                            </td>        
                            </tr>
                            @endif
                        
                    @endforeach
                    </tbody>
				</table>
            </div>
        </div>
        <div class="col-sm-3">
        <table class="table table-striped" style="margin-top:110px;" >
                <tr>
                    <td>tổng số lượng : </td>
                    <td> {{$totalqty}}</td>

               </tr>

            </table >
            <table class="table table-striped">
                <tr>
                    <td>tạm tính: </td>
                    <td>{{ $orders->total  }} vnd

                    </td>

                </tr>

            </table >
            <table class="table table-striped">
             <tr>
                <td> Thành tiền:</td>


                <td>{{ $orders->total  }} vnd <br><p>đã bao gồm thuế (VAT)</p></td>
            </tr>
            </table>
            <!-- Button trigger modal -->

            <button type="button" onclick="dat('login')" class="btn btn-primary "   data-target="#modalCheckOut">Tiến hành đặt </button>
<!-- Modal -->
        <div class="modal fade" id="modalCheckOut" data-backdrop="static"   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
@else

<input type="text" class="form-control" id="validationDefault03" required disabled value="giỏ hàng trống vui lòng thực hiện lại">
<h3>Giỏ Hàng </h3><p>(0 sản phẩm)</p>
    <div class="container" style="background:rgb(219, 242, 248);" >
        <img src="https://salt.tikicdn.com/desktop/img/mascot@2x.png" alt="" class="empty__img" style="width:250px; height:250px; margin-left:400px;margin-top: 40px;" ><br>
        <p style="text-align: center;"><h6  style="text-align: center;">Không có sản phẩm nào trong giỏ hàng của bạn.</h6></p><br>
        <button type="button" onclick=""  class="btn btn-primary" style="margin-left: 500px;"><a href="{{ asset('/home')}}" style="background:none; color:black; ">Tiếp Tục mua sắm</a></button>
        <div class="clear" style="width:1000px;height:50px;"></div>

    </div>
</br>
@endif

@endsection

