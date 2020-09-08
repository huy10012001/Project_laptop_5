@extends('layout_home')
@section( 'detail')
@if(isset($p))

<style>
    .detail {
        border-style: solid;
        border-color: gray;
        text-align: center;
        padding: 15px;
        width: 24%;
        word-break: break-all;
        height: 450px;
        margin: 3px;
    }
    .detail img {
        height: 150px;
    }
    div p {
        margin: auto;
        width: 90%;
        padding: 10px;
    }
    .item1 {
        display: table;
        width: 100%;
    }
</style>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <div class="row">
                            <!-- hot new content -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                                <td class="pro-detail-title">Sản phẩm laptop <label> {{$p->name}}</label></td>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        <div class="img-box" style="margin-bottom:20px">
                                            <img class="img-responsive" width="100%" src="{{ url('images/'.$p->image) }}" alt="img responsive">
                                        </div>
                                        <button type="button" class="btn btn-large btn-block btn-warning" data-toggle="modal" data-target="#imgModal">
                                            Xem
                                        </button>
                                        <!-- The Modal -->
                                        <div class="modal" id="imgModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <td class="pro-detail-title">Laptop <label> {{$p->name}}</label></td>
                                                        <img src="{{ url('images/'.$p->image) }}" alt="" width="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                        <div class="panel panel-info" style="margin: 0;">
                                            <div class="panel-heading" style="padding:5px;">
                                                <td class="panel-title">Khuyễn mãi - Chính sách</td>
                                            </div>
                                            <div class="panel-body">
                                                <div>

                                                    <li><span class="glyphicon glyphicon-ok-sign"></span>Cài đặt phần miềm, tải nhạc - ứng dụng miến phí</li>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-info">
                                            <div class="panel-body">
                                                <div>
                                                    <li><span class="glyphicon glyphicon-hand-right"></span> Bảo hành chính hãng: thân máy 12 tháng, pin 12 tháng, sạc 12 tháng</li>
                                                    <li><span class="glyphicon glyphicon-hand-right"></span> Giao hàng tận nơi miễn phí trong 1 ngày</li>
                                                    <li><span class="glyphicon glyphicon-hand-right"></span> 1 đổi 1 trong 1 tháng với sản phẩm lỗi</li>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <p class="btn btn-info btn-block ">{{number_format($p->price)}} Vnd</p>
                                            <a href="" onclick="AddCart('{{$p->id}}')" class="btn btn-success btn-block">Thêm vào giỏ</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="table-responsive">
                        <div class="panel panel-success">
                            <table class="table table-borderless">

                                <thead class="panel panel-info">
                                    <tr class="panel-heading">
                                        <th class="panel-title" colspan="2">THÔNG TIN KỸ THUẬT SỐ</th>
                                    </tr>
                                </thead>
                                <tbody class="panel-body">
                                    <tr>
                                        <td>Model Series: </td>
                                        <td><?php echo json_decode($p->detail->description, true)['1'] ?></td>
                                    </tr>
                                    <tr style="color: red">
                                        <td>Bộ xử lý</td>
                                    </tr>
                                    <tr>
                                        <td>Hãng CPU :</td>
                                        <td> <?php echo json_decode($p->detail->description, true)['2'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Công nghệ CPU :</td>
                                        <td><?php echo json_decode($p->detail->description, true)['3'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Loại CPU :</td>
                                        <td><?php echo json_decode($p->detail->description, true)['4'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tốc độ CPU :</td>
                                        <td> <?php echo json_decode($p->detail->description, true)['5'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bộ nhớ đệm :</td>
                                        <td><?php echo json_decode($p->detail->description, true)['6'] ?></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                            
                        </div><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#DetailModal">
                                    Xem thông tin chi tiết
                                </button>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                            <div class="accordion-group">
                                
                                <!-- The Modal -->
                                <div class="modal" id="DetailModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Thông tin kỹ thuật số chi tiết</h4>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <td style="color: red">Thông tin dòng sản phẩm</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model Series: </td>
                                                        <td><?php echo json_decode($p->detail->description, true)['1'] ?></td>
                                                    </tr>
                                                    <tr style="color: red">
                                                        <td>Bộ xử lý</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hãng CPU :</td>
                                                        <td> <?php echo json_decode($p->detail->description, true)['2'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Công nghệ CPU :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['3'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Loại CPU :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['4'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tốc độ CPU :</td>
                                                        <td> <?php echo json_decode($p->detail->description, true)['5'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bộ nhớ đệm :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['6'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tốc độ tối đa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['7'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Bo mạch</td>
                                                    <tr>
                                                        <td>Chipset :</td>
                                                        <td> <?php echo json_decode($p->detail->description, true)['8'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tốc độ Bus :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['9'] ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hỗ trợ RAM tối đa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['10'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Ram</td>
                                                    <tr>
                                                        <td>Dung lượng RAM :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['11'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Loại RAM :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['12'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tốc độ BUS RAM :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['13'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Số lượng khe RAM :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['14'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Đĩa cứng</td>
                                                    <tr>
                                                        <td>Loại ổ đĩa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['15'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dung lượng ổ đĩa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['16'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Khe cắm ổ SSD :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['17'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Đồ họa</td>
                                                    <tr>
                                                        <td>Chipset đồ họa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['18'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bộ nhớ đồ họa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['19'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kiểu thiết kế đồ họa :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['20'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Màn hình</td>
                                                    <tr>
                                                        <td>Kích thước màn hình :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['21'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Độ phân giải (W x H) :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['22'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Công nghệ màn hình :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['23'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cảm ứng :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['24'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Âm thanh</td>
                                                    <tr>
                                                        <td>Kênh âm thanh :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['25'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thông tin thêm :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['26'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Đĩa quang</td>
                                                    <tr>
                                                        <td>Có sẵn đĩa quang :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['27'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Tính năng mở rộng & cổng giao tiếp</td>
                                                    <tr>
                                                        <td>Cổng giao tiếp :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['28'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tính năng mở rộng :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['29'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Giao tiếp mạng</td>
                                                    <tr>
                                                        <td>LAN :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['30'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Công nghệ màn hình :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['31'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chuẩn Wi-Fi :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['32'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kết nối không dây khác :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['33'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Card Reader</td>
                                                    <tr>
                                                        <td>Đọc thẻ nhớ :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['34'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Khe đọc thẻ nhớ :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['35'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Webcam</td>
                                                    <tr>
                                                        <td>Độ phân giải :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['36'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thông tin thêm :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['37'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Hệ điều hành, phầm mềm có sẵn</td>
                                                    <tr>
                                                        <td>Hệ điều hành :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['38'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phần mềm có sẵn :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['39'] ?></td>
                                                    </tr>
                                                    <td style="color: red">PIN/Battery</td>
                                                    <tr>
                                                        <td>Loại pin :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['40'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kiểu pin :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['41'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cảm biến vân tay :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['42'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Đèn bàn phím :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['43'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bàn phím số :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['44'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phụ kiện kèm theo :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['45'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Kích thước & trọng lượng</td>
                                                    <tr>
                                                        <td>Kích Thước :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['46'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Trọng lượng :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['47'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chất liệu :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['48'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Bảo hành</td>
                                                    <tr>
                                                        <td>Thời gian bảo hành :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['49'] ?></td>
                                                    </tr>
                                                    <td style="color: red">Thông tin hàng hóa</td>
                                                    <tr>
                                                    <tr>
                                                        <td>Xuất xứ :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['50'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Năm sản xuất :</td>
                                                        <td><?php echo json_decode($p->detail->description, true)['51'] ?></td>
                                                    </tr>


                                                </table>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning" role="alert">
                Sản phẩm cùng danh mục
            </div>
            <!--$lq là những sản phẩm đang hoạt động và đã cập nhập chi tiết thuộc cùng danh mục -->
            @if(isset($lq))
            @php
            $lienquan=$lq->where('product.id','!=', "$p->id")->get();
            @endphp

            @if($lienquan->count()>4)

            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                        </ol>
                        <div class="col-sm-3 " style="float: right">
                            <a href="#slider-carousel" data-slide="prev" data-toggle="popover" style="width: 10px;font-size: 30px;">prev </a>
                            <a href="#slider-carousel" data-slide="next" data-toggle="popover" style="width: 10px;font-size: 30px;border: red"> next</a>
                        </div><br><br><br>
                        <div class="carousel-inner">
                            <div class="item active item1 " style="height: 350px;">

                                @foreach($lienquan->take(4) as $product)

                                <div class="col-sm-3 detail">
                                    <img src="{{ url('images/'.$product->image) }}" width="100%" height="100%" style="margin: auto">
                                    <p>{{$product->name}}</p>
                                    <p>{{number_format($product->price)}}</p>
                                    <button type="button" class="btn btn-default get"><a href="{{ url('product/'.$product->slug) }}"></i> xem sản phẩm</a> </button>
                                </div>



                                @endforeach
                            </div>
                            <div class="item">
                                @foreach($lienquan->skip(4)->take(4) as $product)

                                <div class="col-sm-3 detail">
                                    <img src="{{ url('images/'.$product->image) }}" width="100%" height="100%" style="margin: auto">
                                    <p>{{$p->name}}</p>
                                    <p>{{number_format($p->price)}}</p>
                                    <button type="button" class="btn btn-default get"><a href="{{ url('product/'.$product->slug) }}"></i> xem sản phẩm</a></button>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <br><br><br>
                    </div>
                </div><br><br>
            </div>
        </div>
    </div>
    @elseif($lienquan->count()>0)

    <div class="item" style="margin-top:20px">
        @foreach($lienquan as $product)

        <div class="col-sm-3 detail">
            <img src="{{ url('images/'.$product->image) }}" width="100%" height="100%" style="margin: auto">
            <p>{{$product->name}}</p>
            <p>{{number_format($product->price)}}</p>


            <a href="{{ url('product/'.$product->slug) }}"><button type="button" class="btn btn-default get"> xem sản phẩm</button>
            </a>
        </div>

        @endforeach
        @else
        <div style="text-align: center;padding:120px">
            <p style="color:black;font-size:50px">
                không có sản phẩm cùng danh mục với sản phẩm bạn đang xem !
            </p>
        </div>
        @endif

        @endif



    </div>
    <br>

    @elseif(isset($noactive))
    <style>
        #khongtontai .image {
            text-align: center;
        }
        #khongtontai {
            height: 350px;
        }
    </style>
    <br>
    <div class="container" id="khongtontai" style="background:rgb(219, 242, 248);">
        <div class="image">
            <img src="images/khongtontai.png" alt="" style="  margin-top: 40px;"><br>
            <h6>Sản phẩm này không tồn tại,...</h6>
        </div>
        <div class="clear" style="width:1000px;height:50px;"></div>

    </div>
    @else
    <input type="text" class="form-control" id="validationDefault03" required disabled value="Sản phẩm đang cập nhập,vui lòng thực hiện lại">
    <br>
    <div class="container" style="background:rgb(219, 242, 248);">
        <img src="images/update.jpg" alt="" class="empty__img" style="width:100%; height:350px; margin-top: 40px;"><br>
        <p style="text-align: center;">
            <h6 style="text-align: center;">Sản phẩm đang cập nhập,...</h6>
        </p><br>
        <button type="button" onclick="" class="btn btn-primary" style="margin-left: 500px;"><a href="{{ asset('/home')}}" style="background:none; color:black; ">Tiếp Tục mua sắm</a></button>
        <div class="clear" style="width:1000px;height:50px;"></div>

    </div>
    @endif
    @if(!Session::has('key'))
    <div class="container">
        <div class="users">
            <div class="dropdown">
                <label>Bạn cần </label>
                <button class="btn btn-warning" style="text-align: center; border-radius: 5px;">

                    &nbsp; <b> Đăng Nhập Tài Khoản</b> </button><label> để có thể bình luận sản phẩm của shop</label>
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
    @else
    <!-- comment-->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
            @if(session('thongbao'))
            {{session('thongbao')}}
            @endif
            <div class="accordion-group">
                <div class="accordion-heading">
                    <form action="{{ url('comment/'.$p->id) }}" method="post" role="form">
                        <h4> Viết bình luận của bạn về sản phẩm {{$p->name}} <span class="glyphicon glyphicon-pencil"></span></h4>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    @foreach($p->comment as $cm)
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading">{{$cm->user->name}}
                <small>{{$cm->created_at->format('d/m/y H:i:s')}}</small> </h4>
            {{$cm->content}}
        </div>
    </div>
    <br>
    @endforeach
</div>

@endsection