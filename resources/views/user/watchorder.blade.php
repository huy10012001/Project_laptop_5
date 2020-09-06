@extends('layout_home')
@section('useroder')
    @if(isset($myOrder) and $myOrder->count()>0)
     
       <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              
                                <th>Mã đơn hàng</th>
                                <th >Ngày mua</th>
                                <th>Tên sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th >Trạng thái đơn hàng</th>
                             
                               
                            </tr>
                            </thead>
                           
                            <tbody>
                            @foreach($myOrder as $MOrder)
                            
                                
                             
                                <tr> 
                                    <td> <a  href="{{ url('myorder/view/'.$MOrder->id) }}">{{ $MOrder->id}}</a></td>
                                   @php
                                   $time = strtotime($MOrder->date);
                                    $newformat = date('d/m/Y',$time);
                                     @endphp
                                    <td style="white-space: nowrap;">{{$newformat}}</td>
                                    
                                    @php 
                                        $count=$MOrder->product->count();
                                        $nameproduct="";
                                        foreach($MOrder->product->take(2) as $n)
                                            $nameproduct.=$n->name.",";
                                        if($count==1)
                                            $nameproduct=str_replace(',','', $nameproduct);
                                        if($count>2)
                                            $nameproduct.="...và ".($count-2)." sản phẩm khác";
                                    @endphp
                                    <td>{{ $nameproduct}}</td>
                                    <td>{{number_format($MOrder->total,0,",",".")}}</td>
                                    <td style="white-space: nowrap;" >
                                    @if($MOrder->status==2)
                                    đã hoàn thành
                                    @else
                                    đang xử lý
                                    @endif
                                    </td>
                                </tr>
                             
                               
                                @endforeach
                          
                           
                            </tbody>
                         
                        </table>
                  
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
             <div class="users" style="margin-left:-50px">
            <div class="dropdown">
                <label>Bạn cần </label>
                <button class="btn btn-warning" style="text-align: center; border-radius: 5px;">

                    &nbsp; <b> Đăng Nhập Tài Khoản</b> </button><label> để có thể xem hóa đơn</label>
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
