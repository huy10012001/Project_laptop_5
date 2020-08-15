@extends('layout.layout')
@section('title', 'chi tiết sản phẩm')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

//load lại trang khi user bấm back
$(document).ready(function()
{
     $('#detail').submit(function(e) {
      
        
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
      		url:	 " {{ asset('/postDetailProduct')}}",
      		data: $('#detail').serialize() ,
            
           
			datatype: 'json',
				error:function(data)
				{
					alert('loi roi')
				},
			   success:function(data)
            {
                    
                   location.reload();
              
           
                 }
        	});
    });
});
</script>
@if(isset($p) && !isset($detail))

<section class="content">
  <div class="container-fluid">
    <div class="card" style="margin-top:30px" >
      <div class="card-body" >
        
         <p class="card-text">Sản phẩm chưa có thông tin, mời bạn nhập</p>
          <button type="button" data-toggle="modal" data-target="#myModal"  id="them" class="btn btn-info">Cập Nhập thông tin</button>
      </div>
    </div>
  </div>
  </section>
  <div class="modal" id="myModal">
                   <div class="modal-dialog" >
            <div class="modal-content">

                      <!-- Modal Header -->
                <div class="modal-header">
                     <h4 >Thông tin kỹ thuật số chi tiết</h4>
                    <button type="button"  class="close" data-dismiss="modal">&times;</button>
                    
                </div>
            <div class="modal-body">
                     <form  id="detail" method="post" action="javascrip:void(0)"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                        <input name="product" type="hidden" value="{{$p->id}}">
                        <table class="table table-hover">
                          <tr style="color: red"><td>Thông tin dòng sản phẩm</td></tr>
                          <tr>
                            <td>Model Series: </td>
                            <td><input type="text" name="1"  required></td>
                          </tr>
                          <tr style="color: red" ><td>Bộ xử lý</td></tr>
                          
                          <tr>
                            <td>Hãng CPU :</td>
                            <td> <input type="text" name="2"  required></td>
                          </tr>
                           
                          <tr>
                            <td>Công nghệ CPU :</td>
                            <td><input type="text"  name="3"     required></td>
                          </tr>
                          <tr>
                            <td>Loại CPU :</td>
                            <td><input type="text"  name="4"    required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ CPU :</td>
                            <td> <input type="text"   name="5"   required></td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đệm :</td>
                            <td><input type="text"   name="6"    required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ tối đa :</td>
                            <td><input type="text"   name="7"   required></td>
                          </tr>
                          <td style="color: red">Bo mạch</td>
                          <tr>
                            <td>Chipset :</td>
                            <td><input type="text"  name="8"   required> </td>
                          </tr>
                          <tr>
                            <td>Tốc độ Bus :</td>
                            <td><input type="text"   name="9"    required> </td>
                          </tr>
                          <tr>
                            <td>Hỗ trợ RAM tối đa :</td>
                            <td><input type="text"  name="10"    required> </td>
                          </tr>
                          <td style="color: red">Ram</td>
                          <tr>
                            <td>Dung lượng RAM :</td>
                            <td><input type="text"  name="11"  required> </td>
                          </tr>
                          <tr>
                            <td>Loại RAM :</td>
                            <td><input type="text"  name="12"  required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ BUS RAM :</td>
                            <td><input type="text"  name="13" required> </td>
                          </tr>
                          <tr>
                            <td>Số lượng khe RAM :</td>
                            <td><input type="text"   name="14"   required> </td>
                          </tr>
                          <td style="color: red">Đĩa cứng</td>
                          <tr>
                            <td>Loại ổ đĩa :</td>
                            <td><input type="text"  name="15"   required> </td>
                          </tr>
                          <tr>
                            <td>Dung lượng ổ đĩa :</td>
                            <td><input type="text"  name="16" required> </td>
                          </tr>
                          <tr>
                            <td>Khe cắm ổ SSD :</td>
                            <td><input type="text"  name="17"   required> </td>
                          </tr>
                          <td style="color: red">Đồ họa</td>
                          <tr>
                            <td>Chipset đồ họa :</td>
                            <td><input type="text" name="18" required> </td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đồ họa :</td>
                            <td><input type="text" name="19"    required> </td>
                          </tr>
                          <tr>
                            <td>Kiểu thiết kế đồ họa :</td>
                            <td><input type="text"   name="20"  required> </td>
                          </tr>
                          <td style="color: red">Màn hình</td>
                          <tr>
                            <td>Kích thước màn hình :</td>
                            <td><input type="text" name="21"   required> </td>
                          </tr>
                          <tr>
                            <td>Độ phân giải (W x H) :</td>
                            <td><input type="text" name="22"  required> </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><input type="text"   name="23" required> </td>
                          </tr>
                          <tr>
                            <td>Cảm ứng :</td>
                            <td><input type="text"  name="24"  required> </td>
                          </tr>
                          <td style="color: red">Âm thanh</td>
                          <tr>
                            <td>Kênh âm thanh :</td>
                            <td><input type="text"   name="25" required> </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><input type="text" name="26"  required> </td>
                          </tr>
                          <td style="color: red">Đĩa quang</td>
                          <tr>
                            <td>Có sẵn đĩa quang :</td>
                            <td><input type="text" name="27"   required> </td>
                          </tr>
                          <td style="color: red">Tính năng mở rộng & cổng giao tiếp</td>
                          <tr>
                            <td>Cổng giao tiếp :</td>
                            <td><input type="text" name="28"     required> </td>
                          </tr>
                          <tr>
                            <td>Tính năng mở rộng :</td>
                            <td><input type="text" name="29"   required> </td>
                          </tr>
                          <td style="color: red">Giao tiếp mạng</td>
                          <tr>
                            <td>LAN :</td>
                            <td><input type="text"  name="30" required> </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><input type="text" name="31"   required> </td>
                          </tr>
                          <tr>
                            <td>Chuẩn Wi-Fi :</td>
                            <td><input type="text" name="32"   required> </td>
                          </tr>
                          <tr>
                            <td>Kết nối không dây khác :</td>
                            <td><input type="text" name="33"  required></td>
                          </tr>
                          <td style="color: red">Card Reader</td>
                          <tr>
                            <td>Đọc thẻ nhớ :</td>
                            <td><input type="text" name="34"  required> </td>
                          </tr>
                          <tr>
                            <td>Khe đọc thẻ nhớ :</td>
                            <td><input type="text" name="35" required> </td>
                          </tr>
                          <td style="color: red">Webcam</td>
                          <tr>
                            <td>Độ phân giải :</td>
                            <td><input type="text" name="36"  required> </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><input type="text"  name="37"   required> </td>
                          </tr>
                          <td style="color: red">Hệ điều hành, phầm mềm có sẵn</td>
                          <tr>
                            <td>Hệ điều hành :</td>
                            <td><input type="text" name="38"  required> </td>
                          </tr>
                          <tr>
                            <td>Phần mềm có sẵn :</td>
                            <td><input type="text" name="39"  required> </td>
                          </tr>
                          <td style="color: red">PIN/Battery</td>
                          <tr>
                            <td>Loại pin :</td>
                            <td><input type="text" name="40"  required> </td>
                          </tr>
                          <tr>
                            <td>Kiểu pin :</td>
                            <td><input type="text" name="41"   required> </td>
                          </tr>
                          <td style="color: red">Thông tin khác</td>
                          <tr>
                            <td>Cảm biến vân tay :</td>
                            <td><input type="text"  name="42" required> </td>
                          </tr>
                          <tr>
                            <td>Đèn bàn phím :</td>
                            <td><input type="text" name="43"  required> </td>
                          </tr>
                          <tr>
                            <td>Bàn phím số :</td>
                            <td><input type="text" name="44"  required> </td>
                          </tr>
                          <tr>
                            <td>Phụ kiện kèm theo :</td>
                            <td><input type="text" name="45"   required> </td>
                          </tr>
                          <td style="color: red">Kích thước & trọng lượng</td>
                          <tr>
                            <td>Kích Thước :</td>
                            <td><input type="text"   name="46"   required> </td>
                          </tr>
 
                          <tr>
                            <td>Trọng lượng :</td>
                            <td><input type="text" name="47"   required> </td>
                          </tr>
                          <tr>
                            <td>Chất liệu :</td>
                            <td><input type="text" name="48" required> </td>
                          </tr>
                          <td style="color: red">Bảo hành</td>
                          <tr>
                            <td>Thời gian bảo hành :</td>
                            <td><input type="text"  name="49"  required> </td>
                          </tr>
                          <td style="color: red">Thông tin hàng hóa</td>
                          <tr>
                          <tr>
                            <td>Xuất xứ :</td>
                            <td><input type="text" name="50"required> </td>
                          </tr>
                          <tr>
                            <td>Năm sản xuất :</td>
                            <td> <input type="text" name="51" id="username"  required> </td>
                          </tr>
                        
                        </table>
                        <input type="submit" class="btn btn-primary" value="Cập nhập"></input>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                       </form>
                      </div>
                      <!-- Modal footer -->
                   <div class="modal-footer">
                   
                  
                    </div>
                
             </div>
        </div>
    </div>
        


@else
<section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="offset-md-3 col-md-6">
                    <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">chi tiết sản phẩm {{$p->name}}</h3>
                </div>
                <div class="card-body">
                  <form   enctype="multipart/form-data">
                            {{ csrf_field() }}
                    <input name="product" type="hidden" value="{{$p->id}}"/>
                    <table class="table table-hover">
                      <tr style="color: red"><td colspan="2">Thông tin dòng sản phẩm</td>
                      </tr>
                      <tr>
                        <td>Model Series: </td>
                        <td><?php  echo json_decode($p->detail->description,true)['1'] ?></td>
                      </tr>
                      <tr style="color: red" ><td >Bộ xử lý</td></tr>
                      <tr>
                        <td>Hãng CPU :</td>
                        <td> <?php  echo json_decode($p->detail->description,true)['2'] ?></td>
                      </tr>
                      <tr>
                      <td>Công nghệ CPU :</td>
                      <td><?php  echo json_decode($p->detail->description,true)['3'] ?></td>
                      </tr>
                      <tr>
                      <td>Loại CPU :</td>
                      <td><?php  echo json_decode($p->detail->description,true)['4'] ?></td>
                      </tr>
                          <tr>
                            <td>Tốc độ CPU :</td>
                            <td> <?php  echo json_decode($p->detail->description,true)['5'] ?></td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đệm :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['6'] ?></td>
                          </tr>
                          <tr>
                            <td>Tốc độ tối đa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['7'] ?></td>
                          </tr>
                          <td style="color: red">Bo mạch</td>
                          <tr>
                            <td>Chipset :</td>
                            <td> <?php  echo json_decode($p->detail->description,true)['8'] ?></td>
                          </tr>
                          <tr>
                            <td>Tốc độ Bus :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['9'] ?> </td>
                          </tr>
                          <tr>
                            <td>Hỗ trợ RAM tối đa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['10'] ?></td>
                          </tr>
                          <td style="color: red">Ram</td>
                          <tr>
                            <td>Dung lượng RAM :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['11'] ?></td>
                          </tr>
                          <tr>
                            <td>Loại RAM :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['12'] ?></td>
                          </tr>
                          <tr>
                            <td>Tốc độ BUS RAM :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['13'] ?></td>
                          </tr>
                          <tr>
                            <td>Số lượng khe RAM :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['14'] ?></td>
                          </tr>
                          <td style="color: red">Đĩa cứng</td>
                          <tr>
                            <td>Loại ổ đĩa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['15'] ?></td>
                          </tr>
                          <tr>
                            <td>Dung lượng ổ đĩa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['16'] ?></td>
                          </tr>
                          <tr>
                            <td>Khe cắm ổ SSD :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['17'] ?></td>
                          </tr>
                          <td style="color: red">Đồ họa</td>
                          <tr>
                            <td>Chipset đồ họa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['18'] ?></td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đồ họa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['19'] ?></td>
                          </tr>
                          <tr>
                            <td>Kiểu thiết kế đồ họa :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['20'] ?></td>
                          </tr>
                          <td style="color: red">Màn hình</td>
                          <tr>
                            <td>Kích thước màn hình :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['21'] ?></td>
                          </tr>
                          <tr>
                            <td>Độ phân giải (W x H) :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['22'] ?></td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['23'] ?></td>
                          </tr>
                          <tr>
                            <td>Cảm ứng :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['24'] ?></td>
                          </tr>
                          <td style="color: red">Âm thanh</td>
                          <tr>
                            <td>Kênh âm thanh :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['25'] ?></td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['26'] ?></td>
                          </tr>
                          <td style="color: red">Đĩa quang</td>
                          <tr>
                            <td>Có sẵn đĩa quang :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['27'] ?></td>
                          </tr>
                          <td style="color: red">Tính năng mở rộng & cổng giao tiếp</td>
                          <tr>
                            <td>Cổng giao tiếp :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['28'] ?></td>
                          </tr>
                          <tr>
                            <td>Tính năng mở rộng :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['29'] ?></td>
                          </tr>
                          <td style="color: red">Giao tiếp mạng</td>
                          <tr>
                            <td>LAN :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['30'] ?></td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['31'] ?></td>
                          </tr>
                          <tr>
                            <td>Chuẩn Wi-Fi :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['32'] ?></td>
                          </tr>
                         <tr>
                            <td>Kết nối không dây khác :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['33'] ?></td>
                          </tr>
                          <td style="color: red">Card Reader</td>
                          <tr>
                            <td>Đọc thẻ nhớ :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['34'] ?></td>
                          </tr>
                          <tr>
                            <td>Khe đọc thẻ nhớ :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['35'] ?></td>
                          </tr>
                          <td style="color: red">Webcam</td>
                          <tr>
                            <td>Độ phân giải :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['36'] ?></td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['37'] ?></td>
                          </tr>
                          <td style="color: red">Hệ điều hành, phầm mềm có sẵn</td>
                          <tr>
                            <td>Hệ điều hành :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['38'] ?></td>
                          </tr>
                          <tr>
                            <td>Phần mềm có sẵn :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['39'] ?></td>
                          </tr>
                          <td style="color: red">PIN/Battery</td>
                          <tr>
                            <td>Loại pin :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['40'] ?></td>
                          </tr>
                          <tr>
                            <td>Kiểu pin :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['41'] ?></td>
                          </tr>
                          <tr>
                            <td>Cảm biến vân tay :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['42'] ?></td>
                          </tr>
                          <tr>
                            <td>Đèn bàn phím :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['43'] ?></td>
                          </tr>
                          <tr>
                            <td>Bàn phím số :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['44'] ?></td>
                          </tr>
                          <tr>
                            <td>Phụ kiện kèm theo :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['45'] ?></td>
                          </tr>
                          <td style="color: red">Kích thước & trọng lượng</td>
                          <tr>
                            <td>Kích Thước :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['46'] ?></td>
                          </tr>
 
                          <tr>
                            <td>Trọng lượng :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['47'] ?></td>
                          </tr>
                          <tr>
                            <td>Chất liệu :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['48'] ?></td>
                          </tr>
                          <td style="color: red">Bảo hành</td>
                          <tr>
                            <td>Thời gian bảo hành :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['49'] ?></td>
                          </tr>
                         <td style="color: red">Thông tin hàng hóa</td>
                          <tr>
                          <tr>
                            <td>Xuất xứ :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['50'] ?></td>
                          </tr>
                          <tr>
                            <td>Năm sản xuất :</td>
                            <td><?php  echo json_decode($p->detail->description,true)['51'] ?></td>
                          </tr>
                         
                        </table>  
                        <button type="button" data-toggle="modal" data-target="#myModal"  id="them" class="btn btn-info">Cập Nhập thông tin</button>

                      </form>
                      
                      
                  </div>
              </div>
                     
         </div>
    </div>
      
</section>
    
             
    <!-- Main content -->
   
     <div class="modal" id="myModal">
                   <div class="modal-dialog" >
            <div class="modal-content">

                      <!-- Modal Header -->
                <div class="modal-header">
                     <h4 >Thông tin kỹ thuật số chi tiết</h4>
                    <button type="button"  class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                      <!-- Modal body -->
              
                     <div class="modal-body">
                     <form  id="detail" method="post" action="javascrip:void(0)"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                        <input name="product" type="hidden" value="{{$p->id}}">
                        <table class="table table-hover">
                          <tr style="color: red"><td>Thông tin dòng sản phẩm</td></tr>
                          <tr>
                            <td>Model Series: </td>
                            <td><input type="text" name="1" value="<?php  echo json_decode($p->detail->description,true)['1'] ?>" required></td>
                          </tr>
                          <tr style="color: red" ><td>Bộ xử lý</td></tr>
                          
                          <tr>
                            <td>Hãng CPU :</td>
                            <td> <input type="text" name="2" value="<?php  echo json_decode($p->detail->description,true)['2'] ?>" required></td>
                          </tr>
                          
                          <tr>
                            <td>Công nghệ CPU :</td>
                            <td><input type="text"  name="3"   value="<?php  echo json_decode($p->detail->description,true)['3'] ?>"  required></td>
                          </tr>
                          <tr>
                            <td>Loại CPU :</td>
                            <td><input type="text"  name="4"  value="<?php  echo json_decode($p->detail->description,true)['4'] ?>"  required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ CPU :</td>
                            <td> <input type="text"   name="5"   value="<?php  echo json_decode($p->detail->description,true)['5'] ?>" required></td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đệm :</td>
                            <td><input type="text"   name="6"   value="<?php  echo json_decode($p->detail->description,true)['6'] ?>" required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ tối đa :</td>
                            <td><input type="text"   name="7"   value="<?php  echo json_decode($p->detail->description,true)['7'] ?>" required></td>
                          </tr>
                          <td style="color: red">Bo mạch</td>
                          <tr>
                            <td>Chipset :</td>
                            <td><input type="text"  name="8"   value="<?php  echo json_decode($p->detail->description,true)['8'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Tốc độ Bus :</td>
                            <td><input type="text"   name="9"   value="<?php  echo json_decode($p->detail->description,true)['9'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Hỗ trợ RAM tối đa :</td>
                            <td><input type="text"  name="10"  value="<?php  echo json_decode($p->detail->description,true)['10'] ?>"  required> </td>
                          </tr>
                          <td style="color: red">Ram</td>
                          <tr>
                            <td>Dung lượng RAM :</td>
                            <td><input type="text"  name="11"  value="<?php  echo json_decode($p->detail->description,true)['11'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Loại RAM :</td>
                            <td><input type="text"  name="12"  value="<?php  echo json_decode($p->detail->description,true)['12'] ?>" required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ BUS RAM :</td>
                            <td><input type="text"  name="13"  value="<?php  echo json_decode($p->detail->description,true)['13'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Số lượng khe RAM :</td>
                            <td><input type="text"   name="14"  value="<?php  echo json_decode($p->detail->description,true)['14'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Đĩa cứng</td>
                          <tr>
                            <td>Loại ổ đĩa :</td>
                            <td><input type="text"  name="15"  value="<?php  echo json_decode($p->detail->description,true)['15'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Dung lượng ổ đĩa :</td>
                            <td><input type="text"  name="16"  value="<?php  echo json_decode($p->detail->description,true)['16'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Khe cắm ổ SSD :</td>
                            <td><input type="text"  name="17"  value="<?php  echo json_decode($p->detail->description,true)['17'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Đồ họa</td>
                          <tr>
                            <td>Chipset đồ họa :</td>
                            <td><input type="text" name="18"  value="<?php  echo json_decode($p->detail->description,true)['18'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đồ họa :</td>
                            <td><input type="text" name="19"   value="<?php  echo json_decode($p->detail->description,true)['19'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Kiểu thiết kế đồ họa :</td>
                            <td><input type="text"   name="20"  value="<?php  echo json_decode($p->detail->description,true)['20'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Màn hình</td>
                          <tr>
                            <td>Kích thước màn hình :</td>
                            <td><input type="text" name="21"  value="<?php  echo json_decode($p->detail->description,true)['21'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Độ phân giải (W x H) :</td>
                            <td><input type="text" name="22"  value="<?php  echo json_decode($p->detail->description,true)['22'] ?>"  required> </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><input type="text"   name="23"  value="<?php  echo json_decode($p->detail->description,true)['23'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Cảm ứng :</td>
                            <td><input type="text"  name="24" value="<?php  echo json_decode($p->detail->description,true)['24'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Âm thanh</td>
                          <tr>
                            <td>Kênh âm thanh :</td>
                            <td><input type="text"   name="25" value="<?php  echo json_decode($p->detail->description,true)['25'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><input type="text" name="26"  value="<?php  echo json_decode($p->detail->description,true)['26'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Đĩa quang</td>
                          <tr>
                            <td>Có sẵn đĩa quang :</td>
                            <td><input type="text" name="27"  value="<?php  echo json_decode($p->detail->description,true)['27'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Tính năng mở rộng & cổng giao tiếp</td>
                          <tr>
                            <td>Cổng giao tiếp :</td>
                            <td><input type="text" name="28"   value="<?php  echo json_decode($p->detail->description,true)['28'] ?>"  required> </td>
                          </tr>
                          <tr>
                            <td>Tính năng mở rộng :</td>
                            <td><input type="text" name="29"  value="<?php  echo json_decode($p->detail->description,true)['29'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Giao tiếp mạng</td>
                          <tr>
                            <td>LAN :</td>
                            <td><input type="text"  name="30"  value="<?php  echo json_decode($p->detail->description,true)['30'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><input type="text" name="31"  value="<?php  echo json_decode($p->detail->description,true)['31'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Chuẩn Wi-Fi :</td>
                            <td><input type="text" name="32"  value="<?php  echo json_decode($p->detail->description,true)['32'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Kết nối không dây khác :</td>
                            <td><input type="text" name="33" value="<?php  echo json_decode($p->detail->description,true)['33'] ?>" required></td>
                          </tr>
                          <td style="color: red">Card Reader</td>
                          <tr>
                            <td>Đọc thẻ nhớ :</td>
                            <td><input type="text" name="34" value="<?php  echo json_decode($p->detail->description,true)['34'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Khe đọc thẻ nhớ :</td>
                            <td><input type="text" name="35"  value="<?php  echo json_decode($p->detail->description,true)['35'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Webcam</td>
                          <tr>
                            <td>Độ phân giải :</td>
                            <td><input type="text" name="36"  value="<?php  echo json_decode($p->detail->description,true)['36'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><input type="text"  name="37"  value="<?php  echo json_decode($p->detail->description,true)['37'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Hệ điều hành, phầm mềm có sẵn</td>
                          <tr>
                            <td>Hệ điều hành :</td>
                            <td><input type="text" name="38"  value="<?php  echo json_decode($p->detail->description,true)['38'] ?>"required> </td>
                          </tr>
                          <tr>
                            <td>Phần mềm có sẵn :</td>
                            <td><input type="text" name="39" value="<?php  echo json_decode($p->detail->description,true)['39'] ?>" required> </td>
                          </tr>
                          <td style="color: red">PIN/Battery</td>
                          <tr>
                            <td>Loại pin :</td>
                            <td><input type="text" name="40"  value="<?php  echo json_decode($p->detail->description,true)['40'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Kiểu pin :</td>
                            <td><input type="text" name="41" value="<?php  echo json_decode($p->detail->description,true)['41'] ?>"  required> </td>
                          </tr>
                          <td style="color: red">Thông tin khác</td>
                          <tr>
                            <td>Cảm biến vân tay :</td>
                            <td><input type="text"  name="42" value="<?php  echo json_decode($p->detail->description,true)['42'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Đèn bàn phím :</td>
                            <td><input type="text" name="43"  value="<?php  echo json_decode($p->detail->description,true)['43'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Bàn phím số :</td>
                            <td><input type="text" name="44"  value="<?php  echo json_decode($p->detail->description,true)['44'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Phụ kiện kèm theo :</td>
                            <td><input type="text" name="45"  value="<?php  echo json_decode($p->detail->description,true)['45'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Kích thước & trọng lượng</td>
                          <tr>
                            <td>Kích Thước :</td>
                            <td><input type="text"   name="46"  value="<?php  echo json_decode($p->detail->description,true)['46'] ?>" required> </td>
                          </tr>
 
                          <tr>
                            <td>Trọng lượng :</td>
                            <td><input type="text" name="47"   value="<?php  echo json_decode($p->detail->description,true)['47'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Chất liệu :</td>
                            <td><input type="text" name="48"  value="<?php  echo json_decode($p->detail->description,true)['48'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Bảo hành</td>
                          <tr>
                            <td>Thời gian bảo hành :</td>
                            <td><input type="text"  name="49"  value="<?php  echo json_decode($p->detail->description,true)['49'] ?>"  required> </td>
                          </tr>
                          <td style="color: red">Thông tin hàng hóa</td>
                          <tr>
                          <tr>
                            <td>Xuất xứ :</td>
                            <td><input type="text" name="50" value="<?php  echo json_decode($p->detail->description,true)['50'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Năm sản xuất :</td>
                            <td> <input type="text" name="51" id="username"  value="<?php  echo json_decode($p->detail->description,true)['50'] ?>" required> </td>
                          </tr>
                         
                        </table>
                        <input type="submit" class="btn btn-primary" value="Cập nhập"></input>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                      </form>
                      </div>
                      <!-- Modal footer -->
                   <div class="modal-footer">
                   

                    </div>
                
             </div>
        </div>
    </div>
              
                  
        <!-- /.row -->
   
    @endif   
@endsection

