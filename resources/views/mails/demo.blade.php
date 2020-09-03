<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | LapTop_shop</title>
   <style>
   
  .breadcrumbs {
  position: relative;
}
.table-striped>tbody>tr:nth-child(odd)>td,.table-striped>tbody>tr:nth-child(odd)>th{background-color:#f9f9f9}
.breadcrumbs .breadcrumb {
  background:transparent;
  margin-bottom: 75px;
  padding-left: 0;
}

.breadcrumbs .breadcrumb li a {
  background:#FE980F;
  color: #FFFFFF;
  padding: 3px 7px;
}

.breadcrumbs .breadcrumb li a:after {
  content:"";
  height:auto;
  width: auto;
  border-width: 8px;
  border-style: solid;
  border-color:transparent transparent transparent #FE980F;
  position: absolute;
  top: 11px;
  left:48px;

}

.breadcrumbs .breadcrumb > li + li:before {
  content: " ";
}

#cart_items .cart_info 
{
  border: 1px solid #E6E4DF;
 
}


#cart_items .cart_info .cart_menu 
{
  background: #FE980F;
  color: #fff;
  font-size: 16px;
  font-family: 'Roboto', sans-serif;
  font-weight: normal;
}

#cart_items .cart_info .table.table-condensed thead tr
 {
  height: 51px;
}


#cart_items .cart_info .table.table-condensed tr 
{
  border-bottom: 1px solid#F7F7F0
}

#cart_items .cart_info .table.table-condensed tr:last-child {
  border-bottom: 0
}

.cart_info table tr td {
  border-top: 0 none;
  vertical-align: inherit;
}


/* Create four equal columns that floats next to each other */
.col-sm-6 {
  float: left;
  width: 40%;
  padding: 10px;
 /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
#cart_items .cart_info .image
 {
  padding-left: 30px;
}


#cart_items .cart_info .cart_description h4 
{
  margin-bottom: 0
}

#cart_items .cart_info .cart_description h4 a 
{
  color: #363432;
  font-family: 'Roboto',sans-serif;
  font-size: 20px;
  font-weight: normal;

}

#cart_items .cart_info .cart_description p 
{
  color:#696763
}


#cart_items .cart_info .cart_price p 
{
  color:#696763;
  font-size: 18px
}


#cart_items .cart_info .cart_total_price 
{
  color: #FE980F;
  font-size: 24px;
}
  
</style>
</head>


	<div class="container">
  <img style=" margin-right:5em;" width="100px" height="80px" 
                            src="{{ $message->embed('images/laptop.png')}}"/> 
                            <br>
                            <p>590 CMT8 F11 Quận 3 TPHCM</p>
 <p>0909090909</p>
    <p>Shop rất vui thông báo đơn hàng {{$demo->order->id }} của quý khách đã được tiếp nhận và đang trong quá trình xử lý.
    ..</p>
    <p>Thông tin đơn hàng  {{ $demo->order->id }} ( {{$demo->order->date}} )</p>



    
<div class="row">
    <div class="col-sm-6" >Thông tin thanh toán<br/>
       Tên: {{ $demo->user->name}}<br/>
       Email: {{ $demo->user->email}}
    </div>
      <div class="col-sm-6" >Địa chỉ giao hàng<br/>
     Tên người nhận: {{ $demo->order->name}}<br/>
     Địa chỉ: {{ $demo->order->address}}<br/>
     Số điện thoại: {{ $demo->order->phone}}<br/>
      </div>
</div>
 
    
    
   

    <section id="cart_items" style="margin-top: 20px;">
        <div class="row">
          <div class="col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">


				<table class="cart_info"  >
					<thead>
						<tr class="cart_menu" style="color: black;">
							<td class="image"></td>
							<th class="description">Tên sản phẩm</th>
							<th class="price">giá</th>
							<th class="quantity">số lượng</th>
							<th class="total">tổng tiền</th>
							<th></th>
						</tr>
                    </thead>
                    
					
                    @foreach($demo->order->product as $p)
                     <!--Trường hợp còn hàng(status là 1)-->
                   
						<tr>
                            <td class="cart_product" >
                            <img style=" margin-right:5em;" width="100px" height="80px" 
                            src="{{ $message->embed('images/'.$p->image)}}"/> 
                         
                      
						    <td class="cart_name">
							<h4 >{{$p->name}}</h4>
                            </td>
                            <td class="cart_price">
						    <p> {{number_format($p->pivot->price,0,",",".") }} đ</p>
                            </td>
                          
                 
                     <td class=""  style="text-align: center;">
						        
                            {{  $p->pivot->qty}}
                      
						        </td>

						        <td class="cart_total">
							    <p class="cart_total_price">{{number_format($p->pivot->amount,0,",",".") }} đ</p>
						        </td>

                                </td>

                    <!-- end chi tiết giỏ hàng user-->
                    
                        </tr>
					@endforeach
					
				</table>
          
        </ol>
      </div>
      </div></div></section>
      <table class="table-striped">
     <tr>
        <td > Thành tiền:</td>
        <td> {{number_format($demo->order->total,0,",",".") }} đ<br><p>đã bao gồm thuế (VAT)</p></td>
    </tr>
    </table>
      Cám ơn bạn</div>


<br/>
