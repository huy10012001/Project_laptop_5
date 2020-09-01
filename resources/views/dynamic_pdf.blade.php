
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng {{$p->id}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  h1 { font-family: "Dejavu Sans"; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } h3 { font-family: "Dejavu Sans"; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px; } p { font-family: "Dejavu Sans"; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px; } blockquote { font-family: "Dejavu Sans"; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; } pre { font-family: "Dejavu Sans"; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5714px; }
</style>
</head>

<body  style="font-family: DejaVu Sans">
<img style=" margin-right:5em;" width="100px" height="80px" 
                                    src="{{ public_path('images/laptop.png') }}"
 /> 
 <p>590 CMT8 F11 Quận 3 TPHCM</p>
 <p>0909090909</p>
 <div>
     
<h1 style="text-align: center">Thông tin đơn hàng {{$p->id}}</h1>
<table id="product" class="table table-bordered table-hover">
                           
                           
       <tbody>
                             <tr><td>Tên người nhận:{{$p->name}}</td></tr>
                                <tr><td>Email:{{App\User::find($p->user_id)->email}}</td></tr>
                                <tr><td>Số điện thoại:{{$p->phone}}</td></tr>
                                <tr><td>Địa chỉ:{{$p->address}}</td></tr>
                            </tbody>
                         
                        </table>
                  
 </div>
 <div>
 <h1 style="text-align: center ">Chi tiết hóa đơn</h1>
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                
                                <th>Giá</th>
                                <th >Số lượng</th>
                                <th>Thành tiền </th>
                               
                            </tr>
                            </thead>
                           
                            <tbody>
                      
                                @foreach($p->product as $o_p)
                                <tr> 
                                   
                                    <td>  <img style=" margin-right:5em;" width="100px" height="80px" 
                                    src="{{ public_path('images/'.$o_p->image) }}"
                                    /> </td>
                                    <td>{{ App\Product::
                                     find($o_p->pivot->product_id)->name}}</td>
                                     <td>{{number_format($o_p->pivot->price,0,",",".")}}</td>
                                    <td >{{$o_p->pivot->qty}}</td>
                                    <td>{{number_format($o_p->pivot->amount,0,",",".")}}</td>
                                   
                                </tr>
                                @endforeach
                          
                           
                            </tbody>
                         
                        </table>
                  
   

            <label for="txt-name">Trạng thái đơn hàng:
             @if($p->status=="1")
                đang xử lý
             @else
                đã hoàn thành
             @endif
             </label>     
            <p> TỔng tiền:{{number_format(App\Order::find($p->id)->total,0,",",".")}} đ</p>      
 </div>                      
                            <!-- /.card-body -->
</body>
</html>


<!-- Lưu tại resources/views/product/index.blade.php -->

    <!-- Content Header (Page header) -->
 
    <!-- Main content -->
   


