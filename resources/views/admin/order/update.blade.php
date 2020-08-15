<!-- lưu tại /resources/views/product/create.blade.php -->

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
                            <h3 class="card-title">Cập nhập đơn hàng {{$p->id}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- xử lý hiện thông báo lỗi -->
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
                        <form role="form" action="{{ url('admin/order/postUpdate/'.$p->id) }}"  method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="txt-name">Status</label>
                                    <select name="status">
                                    <option value="{{$p->status}}"
                                     selected  hidden> 
                                    @if($p->status=="0")
                                        đang trong giỏ hàng
                                    @elseif($p->status=="1")
                                     đã xác nhận
                                     @else
                                     đã hoàn thành
                                      @endif
                                     </option> 
                                        <option value="1">đang  xử lý</option>
                                        <option value="2">đã hoàn thành</option>
                                       
  
  
                                       
                                    </select>

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
