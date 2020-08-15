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
@section('title', 'cập nhập sản phẩm')
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
                                    <label for="txt-name">Tên thương hiệu:</label>
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
                                    <label for="txt-name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="txt-name" name="name" value="{{$p->name}}"
                                           placeholder="Nhập tên sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label>Giá</label>
                                    <input type="text" class="form-control" id="txt-name" name="price" value="{{$p->price}}"
                                           placeholder="Nhập giá">
                                </div>
                                <div class="form-group">
                                <label for="txt-name">Trạng thái:</label>
                                    <select name="status">
                                    <option value="{{$p->status}}"

                                     selected  hidden> 
                                     @if($p->status=="0")
                                         Không hoạt động
                                    @else
                                        Hoạt động
                                     @endif
                                     </option> 
                                     <option value="0">Không hoạt động</option>
                                        <option value="1">Hoạt động</option>

                                       </select>

                                </div>

                                <div class="form-group">

                                    <label for="image">Image</label>
                                    <br/>

                                    <img class="img-fluid"  id="output" src="{{ url('images/'.$p->image) }}"/>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="your_input"  type="file" class="custom-file-input"  name="image" onchange="loadFile(event)">
                                            <label class="custom-file-label" for="image">Chọn Ảnh</label>
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
