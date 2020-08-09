<!-- lưu tại /resources/views/product/create.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

//load lại trang khi user bấm back
/*
$(document).ready(function()
{

    var detail=   $('#textDescription').val();
    var myObj = JSON.parse(detail);
    var array = $.map(myObj, function(value, index) {
           return [value];
          });
    $('#description').html("Modal Series:"+array[0]+",Bộ xử lý:" +array[1] +",...");
    $( "#detail" ).submit(function(e ) {
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
      		data:$('#detail').serialize(),
			    datatype: 'json',
				error:function(data)
				{
					alert('loi roi')
				},
			    success:function(data)
          {
            $("#myModal").modal("hide");
           
            var myObj=data.name;
           
            var array = $.map(myObj, function(value, index) {
           return [value];
          });
            
            
            $('#textDescription').val(JSON.stringify(myObj));
           
            $('#description').html("Modal Series:"+array[0]+",Bộ xử lý:" +array[1] +",...");
            }
        	});
    });
});*/
</script>
@extends('layout.layout')
@section('title', 'product - create new')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cập nhập sản phẩm {{$p->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- xử lý hiện thông báo lỗi -->
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                        {{Session::forget('message')}}
                         @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (\Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                    <!-- form start -->
                        <form role="form" method="post" action="{{ url('admin/product/postUpdate/'.$p->id) }}" 
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="txt-name">Category Name</label>
                                    <select name="category">
                                    <option value="@php echo  App\Product::find($p->id)->category->id @endphp"
                                     selected  hidden> 
                                         {{App\Product::find($p->id)->category->name}}
                                     </option> 
                                        @foreach(App\category::all() as  $category)
                                      
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                            
  
  
                                        @endforeach
                                    </select>

                                </div>
                               
                                <div class="form-group">
                                    <label for="txt-name">Produc Name</label>
                                    <input type="text" class="form-control" id="txt-name" name="name" value="{{$p->name}}"
                                           placeholder="Input Product Name">
                                </div>
                               
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" id="txt-name" name="price" value="{{$p->price}}"
                                           placeholder="Input Product Name">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input  id="textDescription"  value="{{$p->description}}" class="form-control" type="hidden" name="description" />
                                    <textarea id="description" class="form-control" rows="3" readonly>
                                    
                                    </textarea>
                                    <button type="button"   class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        Cập nhập
                                    </button>
                                    
                                </div>
                                <div class="form-group">

                                    <label for="image">Image</label>   
                                    <br/> 

                                    <img class="img-fluid"  id="output" src="{{ url('images/'.$p->image) }}"/>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="your_input"  type="file" class="custom-file-input"  name="image" onchange="loadFile(event)">
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
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
                        <table class="table table-hover">
                          <tr style="color: red"><td>Thông tin dòng sản phẩm</td></tr>
                          <tr>
                            <td>Model Series: </td>
                            <td><input type="text" name="1" value="<?php  echo json_decode($p->description,true)['1'] ?>" required></td>
                          </tr>
                          <tr style="color: red" ><td>Bộ xử lý</td></tr>
                          
                          <tr>
                            <td>Hãng CPU :</td>
                            <td> <input type="text" name="2" value="<?php  echo json_decode($p->description,true)['2'] ?>" required></td>
                          </tr>
                           
                          <tr>
                            <td>Công nghệ CPU :</td>
                            <td><input type="text"  name="3"   value="<?php  echo json_decode($p->description,true)['3'] ?>"  required></td>
                          </tr>
                          <tr>
                            <td>Loại CPU :</td>
                            <td><input type="text"  name="4"  value="<?php  echo json_decode($p->description,true)['4'] ?>"  required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ CPU :</td>
                            <td> <input type="text"   name="5"   value="<?php  echo json_decode($p->description,true)['5'] ?>" required></td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đệm :</td>
                            <td><input type="text"   name="6"   value="<?php  echo json_decode($p->description,true)['6'] ?>" required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ tối đa :</td>
                            <td><input type="text"   name="7"   value="<?php  echo json_decode($p->description,true)['7'] ?>" required></td>
                          </tr>
                          <td style="color: red">Bo mạch</td>
                          <tr>
                            <td>Chipset :</td>
                            <td><input type="text"  name="8"   value="<?php  echo json_decode($p->description,true)['8'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Tốc độ Bus :</td>
                            <td><input type="text"   name="9"   value="<?php  echo json_decode($p->description,true)['9'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Hỗ trợ RAM tối đa :</td>
                            <td><input type="text"  name="10"  value="<?php  echo json_decode($p->description,true)['10'] ?>"  required> </td>
                          </tr>
                          <td style="color: red">Ram</td>
                          <tr>
                            <td>Dung lượng RAM :</td>
                            <td><input type="text"  name="11"  value="<?php  echo json_decode($p->description,true)['11'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Loại RAM :</td>
                            <td><input type="text"  name="12"  value="<?php  echo json_decode($p->description,true)['12'] ?>" required></td>
                          </tr>
                          <tr>
                            <td>Tốc độ BUS RAM :</td>
                            <td><input type="text"  name="13"  value="<?php  echo json_decode($p->description,true)['13'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Số lượng khe RAM :</td>
                            <td><input type="text"   name="14"  value="<?php  echo json_decode($p->description,true)['14'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Đĩa cứng</td>
                          <tr>
                            <td>Loại ổ đĩa :</td>
                            <td><input type="text"  name="15"  value="<?php  echo json_decode($p->description,true)['15'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Dung lượng ổ đĩa :</td>
                            <td><input type="text"  name="16"  value="<?php  echo json_decode($p->description,true)['16'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Khe cắm ổ SSD :</td>
                            <td><input type="text"  name="17"  value="<?php  echo json_decode($p->description,true)['17'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Đồ họa</td>
                          <tr>
                            <td>Chipset đồ họa :</td>
                            <td><input type="text" name="18"  value="<?php  echo json_decode($p->description,true)['18'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Bộ nhớ đồ họa :</td>
                            <td><input type="text" name="19"   value="<?php  echo json_decode($p->description,true)['19'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Kiểu thiết kế đồ họa :</td>
                            <td><input type="text"   name="20"  value="<?php  echo json_decode($p->description,true)['20'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Màn hình</td>
                          <tr>
                            <td>Kích thước màn hình :</td>
                            <td><input type="text" name="21"  value="<?php  echo json_decode($p->description,true)['21'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Độ phân giải (W x H) :</td>
                            <td><input type="text" name="22"  value="<?php  echo json_decode($p->description,true)['22'] ?>"  required> </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><input type="text"   name="23"  value="<?php  echo json_decode($p->description,true)['23'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Cảm ứng :</td>
                            <td><input type="text"  name="24" value="<?php  echo json_decode($p->description,true)['24'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Âm thanh</td>
                          <tr>
                            <td>Kênh âm thanh :</td>
                            <td><input type="text"   name="25" value="<?php  echo json_decode($p->description,true)['25'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><input type="text" name="26"  value="<?php  echo json_decode($p->description,true)['26'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Đĩa quang</td>
                          <tr>
                            <td>Có sẵn đĩa quang :</td>
                            <td><input type="text" name="27"  value="<?php  echo json_decode($p->description,true)['27'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Tính năng mở rộng & cổng giao tiếp</td>
                          <tr>
                            <td>Cổng giao tiếp :</td>
                            <td><input type="text" name="28"   value="<?php  echo json_decode($p->description,true)['28'] ?>"  required> </td>
                          </tr>
                          <tr>
                            <td>Tính năng mở rộng :</td>
                            <td><input type="text" name="29"  value="<?php  echo json_decode($p->description,true)['29'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Giao tiếp mạng</td>
                          <tr>
                            <td>LAN :</td>
                            <td><input type="text"  name="30"  value="<?php  echo json_decode($p->description,true)['30'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Công nghệ màn hình :</td>
                            <td><input type="text" name="31"  value="<?php  echo json_decode($p->description,true)['31'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Chuẩn Wi-Fi :</td>
                            <td><input type="text" name="32"  value="<?php  echo json_decode($p->description,true)['32'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Kết nối không dây khác :</td>
                            <td><input type="text" name="33" value="<?php  echo json_decode($p->description,true)['33'] ?>" required></td>
                          </tr>
                          <td style="color: red">Card Reader</td>
                          <tr>
                            <td>Đọc thẻ nhớ :</td>
                            <td><input type="text" name="34" value="<?php  echo json_decode($p->description,true)['34'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Khe đọc thẻ nhớ :</td>
                            <td><input type="text" name="35"  value="<?php  echo json_decode($p->description,true)['35'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Webcam</td>
                          <tr>
                            <td>Độ phân giải :</td>
                            <td><input type="text" name="36"  value="<?php  echo json_decode($p->description,true)['36'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Thông tin thêm :</td>
                            <td><input type="text"  name="37"  value="<?php  echo json_decode($p->description,true)['37'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Hệ điều hành, phầm mềm có sẵn</td>
                          <tr>
                            <td>Hệ điều hành :</td>
                            <td><input type="text" name="38"  value="<?php  echo json_decode($p->description,true)['38'] ?>"required> </td>
                          </tr>
                          <tr>
                            <td>Phần mềm có sẵn :</td>
                            <td><input type="text" name="39" value="<?php  echo json_decode($p->description,true)['39'] ?>" required> </td>
                          </tr>
                          <td style="color: red">PIN/Battery</td>
                          <tr>
                            <td>Loại pin :</td>
                            <td><input type="text" name="40"  value="<?php  echo json_decode($p->description,true)['40'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Kiểu pin :</td>
                            <td><input type="text" name="41" value="<?php  echo json_decode($p->description,true)['41'] ?>"  required> </td>
                          </tr>
                          <td style="color: red">Thông tin khác</td>
                          <tr>
                            <td>Cảm biến vân tay :</td>
                            <td><input type="text"  name="42" value="<?php  echo json_decode($p->description,true)['42'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Đèn bàn phím :</td>
                            <td><input type="text" name="43"  value="<?php  echo json_decode($p->description,true)['43'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Bàn phím số :</td>
                            <td><input type="text" name="44"  value="<?php  echo json_decode($p->description,true)['44'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Phụ kiện kèm theo :</td>
                            <td><input type="text" name="45"  value="<?php  echo json_decode($p->description,true)['45'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Kích thước & trọng lượng</td>
                          <tr>
                            <td>Kích Thước :</td>
                            <td><input type="text"   name="46"  value="<?php  echo json_decode($p->description,true)['46'] ?>" required> </td>
                          </tr>
 
                          <tr>
                            <td>Trọng lượng :</td>
                            <td><input type="text" name="47"   value="<?php  echo json_decode($p->description,true)['47'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Chất liệu :</td>
                            <td><input type="text" name="48"  value="<?php  echo json_decode($p->description,true)['48'] ?>" required> </td>
                          </tr>
                          <td style="color: red">Bảo hành</td>
                          <tr>
                            <td>Thời gian bảo hành :</td>
                            <td><input type="text"  name="49"  value="<?php  echo json_decode($p->description,true)['49'] ?>"  required> </td>
                          </tr>
                          <td style="color: red">Thông tin hàng hóa</td>
                          <tr>
                          <tr>
                            <td>Xuất xứ :</td>
                            <td><input type="text" name="50" value="<?php  echo json_decode($p->description,true)['50'] ?>" required> </td>
                          </tr>
                          <tr>
                            <td>Năm sản xuất :</td>
                            <td> <input type="text" name="51" id="username"  value="<?php  echo json_decode($p->description,true)['50'] ?>" required> </td>
                          </tr>
                         
                        </table>
                        <input type="submit" class="btn btn-primary" value="Cập nhập"></input>
                       </form>
                      </div>
                      <!-- Modal footer -->
                   <div class="modal-footer">
                   
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                
            </div>
        </div>
    </div>
             
@endsection
@section('script-section')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
         var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
    </script>
@endsection
