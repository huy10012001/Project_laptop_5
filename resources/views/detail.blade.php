@extends('layout_home')
@section( 'detail')
<style>
.detail{
  border-style: solid  ;
  border-color: gray ;
  text-align: center;
  padding:15px;
  word-break:break-all;
  display: table-cell;

 
}

.col-container {
  display: flex;
  width: 100%;
  height: 100%;
}
.detail img
{
 width:100%;
  height: 200px;
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
                <td class="pro-detail-title"><a href="#" title="">laptop</a></td>
                <hr>
                <div class="row">
                  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <div class="img-box">
                      <img class="img-responsive" src="images/hinh.jpg" alt="img responsive">
                    </div>
                    <div class="img-slide">
                      <div class="panel panel-default text-center">
                        <div id="links">
                          <a href="images/hinh1.jpg" title="" data-gallery >
                            <img src="images/hinh.jpg" alt="" width="50%" height="20%">
                          </a>
                        </div>

                      </div>
                    </div>
                    <label class="btn btn-large btn-block btn-warning">xem</label>
                  </div>
                  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                    <div class="panel panel-info" style="margin: 0;">
                      <div class="panel-heading" style="padding:5px;">
                        <td class="panel-title">Khuyễn mãi - Chính sách</td>
                      </div>
                      <div class="panel-body">
                        <div class="khuyenmai">

                          <li><span class="glyphicon glyphicon-ok-sign"></span>Cài đặt phần miềm, tải nhạc - ứng dụng miến phí</li>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-info">
                      <div class="panel-body">
                        <div>
                          <li><span class="glyphicon glyphicon-hand-right"></span> Trong hộp :</li>
                          <li><span class="glyphicon glyphicon-hand-right"></span> Bảo hành chính hãng: thân máy 12 tháng, pin 12 tháng, sạc 12 tháng</li>
                          <li><span class="glyphicon glyphicon-hand-right"></span> Giao hàng tận nơi miễn phí trong 1 ngày</li>
                          <li><span class="glyphicon glyphicon-hand-right"></span> 1 đổi 1 trong 1 tháng với sản phẩm lỗi</li>
                        </div>
                      </div>
                    </div>
                    <div class="price">
                      <span class="btn btn-info btn-block "><strong>12000</strong> Vnd</span>
                      <a href="" class="btn btn-success btn-block">Thêm vào giỏ</a>
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
                    <td>aa</td>
                  </tr>
                  <td style="color: red">Bộ xử lí</td>
                  <tr>
                    <td>Hãng CPU :</td>
                    <td> aa</td>
                  </tr>
                  <tr>
                    <td>Công nghệ CPU :</td>
                    <td>aa</td>
                  </tr>
                  <tr>
                    <td>Loại CPU :</td>
                    <td>aa</td>
                  </tr>
                  <tr>
                    <td>Tốc độ CPU :</td>
                    <td> aa </td>
                  </tr>
                  <tr>
                    <td>Bộ nhớ đệm :</td>
                    <td>aa</td>
                  </tr>
                </tbody>

              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
              <div class="accordion-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Xem thông tin chi tiết
                </button>
                <!-- The Modal -->
                <div class="modal" id="myModal">
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
                          <td style="color: red">Thông tin dòng sản phẩm</td>
                          <tr>
                            <td>Model Series: </td>
                            <td>aa</td>
                          </tr>
                          <td style="color: red">Bộ xử lí</td>
                          <tr>
                            <td>Hãng CPU :</td>
                            <td> aa</td>
                          </tr>
                          <tr>
                            <td>Công nghệ CPU :</td>
                            <td>aa</td>
                          </tr>
                          <tr>
                            <td>Loại CPU :</td>
                            <td>aa</td>
                          </tr>
                          <tr>
                            <td>Tốc độ CPU :</td>
                            <td> aa </td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đệm :</td>
                            <td>aa</td>
                          </tr>
                          <tr>
                            <td>Tốc độ tối đa :</td>
                            <td>aa</td>
                          </tr>
                          <td style="color: red">Bo mạch</td>
                          <tr>
                            <td>Chipset :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Tốc độ Bus :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Hỗ trợ RAM tối đa :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Ram</td>
                          <tr>
                            <td>Dung lượng RAM :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Loại RAM :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Tốc độ BUS RAM :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Số lượng khe RAM :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Đĩa cứng</td>
                          <tr>
                            <td>Loại ổ đĩa :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Dung lượng ổ đĩa :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Khe cắm ổ SSD :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Đồ họa</td>
                          <tr>
                            <td>Chipset đồ họa :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đồ họa :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Kiểu thiết kế đồ họa :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Màn hình</td>
                          <tr>
                            <td>Kích thước màn hình :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Độ phân giải (W x H) :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Cảm ứng :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Âm thanh</td>
                          <tr>
                            <td>Kênh âm thanh :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Đĩa quang</td>
                          <tr>
                            <td>Có sẵn đĩa quang :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Tính năng mở rộng & cổng giao tiếp</td>
                          <tr>
                            <td>Cổng giao tiếp :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Tính năng mở rộng :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Giao tiếp mạng</td>
                          <tr>
                            <td>LAN :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Chuẩn Wi-Fi :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Kết nối không dây khác :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Card Reader</td>
                          <tr>
                            <td>Đọc thẻ nhớ :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Khe đọc thẻ nhớ :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Webcam</td>
                          <tr>
                            <td>Độ phân giải :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Hệ điều hành, phầm mềm có sẵn</td>
                          <tr>
                            <td>Hệ điều hành :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Phần mềm có sẵn :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">PIN/Battery</td>
                          <tr>
                            <td>Loại pin :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Kiểu pin :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Thông tin khác</td>
                          <tr>
                            <td>Cảm biến vân tay :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Đèn bàn phím :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Bàn phím số :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Phụ kiện kèm theo :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Kích thước & trọng lượng</td>
                          <tr>
                            <td>Kích Thước :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Trọng lượng :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Chất liệu :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Bảo hành</td>
                          <tr>
                            <td>Thời gian bảo hành :</td>
                            <td>aa </td>
                          </tr>
                          <td style="color: red">Thông tin hàng hóa</td>
                          <tr>
                          <tr>
                            <td>Xuất xứ :</td>
                            <td>aa </td>
                          </tr>
                          <tr>
                            <td>Năm sản xuất :</td>
                            <td>aa </td>
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
            <div class="carousel-inner" style="max-width:900px; max-height:600px !important;">
              <div class="item active">
                 <div class="col-container">
                <div class="col-sm-3 detail " >
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto">
                  <p>lap12312312333123312331233123312331233123312333333333333333333333top</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get"><a href="detail"> xem sản phẩm</a></button>
                </div>
                <div class="col-sm-3 detail">
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto">
                  <p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get">xem sản phẩm</button>
                </div>
                <div class="col-sm-3 detail" >
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto"><p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get">xem sản phẩm</button>
                </div>
                <div class="col-sm-3 detail">
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto"><p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get">xem sản phẩm</button>
                </div>
                 </div>
              </div>
              <div class="item">
              <div class="col-container">
                <div class="col-sm-3 detail">
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto"><p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get"><a href="detail"> xem sản phẩm</a></button>
                </div>
                <div class="col-sm-3 detail">
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto"><p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get">xem sản phẩm</button>
                </div>
                <div class="col-sm-3 detail">
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto"><p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get">xem sản phẩm</button>
                </div>
                <div class="col-sm-3 detail">
                  <img src="images/hinh.jpg" alt="" width="100%" height="100%" style="margin: auto"><p>laptop</p>
                  <p>giá</p>
                  <button type="button" class="btn btn-default get">xem sản phẩm</button>
                </div>
              </div>
              </div>
            </div>
            <br><br><br>
          </div>
        </div><br><br>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
      <h2> Hỏi đáp và thắc mắc</h2>
      <div class="accordion-group">
        <div class="accordion-heading">
          <p class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
            <div class="accordion-inner">
              <textarea name="" id="" cols="20" rows="5" placeholder="Viết bình luận của bạn"></textarea>
              <input type="submit" class="btn btn-primary" style="float: right" value="Send">
            </div>
            <br>
          </p>
        </div>
        <div id="collapseTwo" class="accordion-body collapse">
          <div class="accordion-inner">
            loman
          </div>
        </div>
        <button class="SeeMore btn-primary" data-toggle="collapse" href="#collapseTwo"><b class="caret"></b> Xem chi tiết</button>
      </div>
    </div>
  </div>
  <br>
</div>

@endsection