@extends('layout_home')
@section('userviewOrder')
    @if(isset($myViewOrder) )
     
    <h1 style="text-align: center">Thông tin đơn hàng {{$myViewOrder->id}}</h1>
<table id="product" class="table table-bordered table-hover">
                           
                           
       <tbody>
                             <tr><td>Tên người nhận:{{$myViewOrder->name}}</td></tr>
                                <tr><td>Email:{{App\User::find($myViewOrder->user_id)->email}}</td></tr>
                                <tr><td>Số điện thoại:{{$myViewOrder->phone}}</td></tr>
                                <tr><td>Địa chỉ:{{$myViewOrder->address}}</td></tr>
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
                      
                                @foreach($myViewOrder->product as $o_p)
                                <tr> 
                                   
                                    <td>  <img style=" margin-right:5em;" width="100px" height="80px" 
                                    src="{{ url('images/'.$o_p->image) }}"
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
             @if($myViewOrder->status=="1")
                đang xử lý
             @else
                đã hoàn thành
             @endif
             </label>     
            <p> TỔng tiền:{{number_format(App\Order::find($myViewOrder->id)->total,0,",",".")}} đ</p>      
 </div>                      
                  
    @elseif(Session::has('key'))


    <div class="container" style="background:rgb(219, 242, 248);height:500px;margin-bottom:10px"  style="position: relative;">
     <div style="position:absolute;
             left:50%; margin-left:-60px;top:30%;
            ">
     <img  
        src="https://frontend.tikicdn.com/_desktop-next/static/img/mascot_fail.svg" alt=""   ><br>
        <h6  style="margin-left:-20px">Không tìm thấy đơn hàng bạn đã mua.</h6><br>
        <button type="button" onclick=""  style="margin-left:10px"><a href="{{ asset('/home')}}" style="background:none; color:black; ">Tiếp Tục mua sắm</a></button>
 

    </div>
</br>
    @else
    <div class="container" style="background:rgb(219, 242, 248);height:500px;margin-bottom:10px"  style="position: relative;">
     <div style="position:absolute;
             left:50%; margin-left:-60px;top:30%;
            ">
        <img  
        src="https://frontend.tikicdn.com/_desktop-next/static/img/mascot_fail.svg" alt=""   ><br>
             <div class="users" style="margin-left:-65px">
            <div class="dropdown">
                <label>Bạn cần </label>
                <button class="btn btn-warning" style="text-align: center; border-radius: 5px;">

                    &nbsp; <b> Đăng Nhập Tài Khoản</b> </button><label> để có thể theo dõi đơn hàng</label>
                <div class="dropdown-content">
                    <!--modal-->
                    <!-- Button trigger modal -->
                    <button type="button" onclick="dangnhap()" id="target1" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal" style="width: 100%; border-radius: 5px; ">Đăng nhập </button>
                    <button type="button" onclick="dangky()" id="target2" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal" style="width: 100%; margin-top:10px; border-radius: 5px;">Tạo tài khoản </button>
                    <!--login google-->

                    <a class="btn btn-outline-dark" href="{{ URL::to('auth/google') }}" role="button" style="text-transform:none">
                        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                        đăng nhập với google
                    </a>

                    <!--login google-->
                    <!--login github-->
                    <a id="github-button" href="{{ URL::to('auth/github') }}" class="btn btn-block btn-social btn-github">
                        <i class="fa fa-github"></i>
                        <p style="padding-left: 20px;color:white"> Đăng nhập với git hub</p>
                    </a>
                    <!--login github-->
                </div>
            </div>
        </div>
     
      
 

    </div>
    <div class="container">
       
    </div>
    @endif
@endsection
