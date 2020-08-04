@extends('layout_home')
@section( 'cart_detail')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

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
    function tienhanh(orderId)
    {
       
        $.ajax({
            type:  "GET",
      		url:	 " {{ asset('/isDangNhap')}}",
      		data: { check:"true",order_id:orderId,status:"login" },
			datatype: 'json',
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
                //khi thoát đăng nhập
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
      		            data:{ name:$name,phone:$phone,address:$add},//pass tham số vào key
			            datatype: 'json',
         	            success:function(data)
                        {
                            //nếu giỏ hàng thay đổi trong lúc order
                            if(data.status=="change")
                                alert("giỏ hàng của bạn vừa thay đổi, xin vui lòng load lại trang trước khi thanh toán");
                            else
                                location.href = "https://www.w3schools.com";
                        }
                    });
                }
           	}
        });
    }
</script>


@if(Session::has('key'))
<table>
<tr >
    <td>
    <div id="dialog" hidden>Your non-modal dialog</div>
<form  id="khach" action="">
                                
      <h5  id="ten" style="color: rgb(12, 12, 12);" >Họ và tên:{{Session::get('key')->name}}</h5> 
      <h5  id="phone"style="color: rgb(12, 12, 12);" >SĐT: {{Session::get('key')->phone}}</h5>
       <h5  id="add"  style="color: rgb(12, 12, 12);" >Địa chỉ:{{Session::get('key')->address}}</h5>
                          
                <button id="updateX" type="button" onclick="Update()">Sửa</button>    
                    
 </form>
 
<form  id="update" hidden action="">
                                
                               
                                <h5 style="color: rgb(12, 12, 12);" >Họ và tên:</h5> 
                                <input   value="{{Session::get('key')->name}}"  type="text" class="form-control" name="name" required ><br>
                                <h5 style="color: rgb(12, 12, 12);" >SĐT:</h5> 
                                <input    value="{{Session::get('key')->phone}}"   type="text" class="form-control" name="phone" required placeholder="Nhập số điện thoại"><br>
                                <h5    style="color: rgb(12, 12, 12);" >Địa chỉ:</h5>
                                <input   value="{{Session::get('key')->address}}"   type="text" class="form-control" name="address" required placeholder="Nhập số điện thoại"><br>
                <button id="huy " onclick="huy()" type="button">Huy</button>    
                <button  id="oK" onclick="getUpdate()"    type="button" >Xa1c nhan</button>               
 </form>
 </td>         
 <td>
@if(isset($orders))
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
           <input type="hidden" name="id" value="{{Session::get('key')->id}}">
            <button type="button" class="btn btn-primary " onclick="tienhanh('{{$orders->id}}',)">Tiến hành đặt </button>
<!-- end form đăng nhập cart-->
        </div>
        </div>

    </div>
 </td>  
 @endif     
 <!-- end nếu user đăng nhập-->
 @else
<script>
 alert("phiên làm việc hết hạn");
 setTimeout(function () {
    window.location.href = "{{URL::to('/home')}}" //will redirect to your blog page (an ex: blog.html)
    }, 1000); //will call the function after 2 secs.


 //window.location.href = "{{URL::to('/home')}}"
</script>
@endif
                   
 </tr></table>