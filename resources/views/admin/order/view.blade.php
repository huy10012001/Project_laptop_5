<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout')
@section('title', 'xem chi tiết hóa đơn')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-12">
            @if(Session::has('message'))
                 <div class="alert alert-success">
                      {{ Session::get('message')}}    
                      {{Session::forget('message')}} 
                 </div>
            @endif
         </h1>
        </div>
            <div class="col-12">
                
                <div class="card">
                   
                     <!-- /.card-header -->
                    
                     <div class="card-body">
                        <table class="table table-bordered ">
                             <tr>
                                
                                 <td colspan="2">Thông tin chi tiết mã đơn hàng {{$p->id}}</td>
                            </tr>
                            
                            <tr>
                                 <th>Tên người nhận</th>
                                 <td>{{$p->name}}</td>
                            </tr>
                            <tr>   
                                <th>Email</th> 
                                <td>{{App\User::find($p->user_id)->email}}</td>
                            </tr>
                           
                            <tr>
                                <th>Địa chỉ</th>
                                <td>{{$p->address}}</td> 
                            <tr>
                            <tr>
                                 <th>Số điện thoại</th> 
                                 <td>{{$p->phone}}</td>
                                
                            </tr>
                            <tr>
                                 <th>Tổng tiền</th> 
                                 <td>{{number_format(App\Order::find($p->id)->total,0,",",".")}} đ </td>
                            
                               
                            </tr>
                           
                        </table>
                     </div>
                    
                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                               
                            </tr>
                            </thead>
                           
                            <tbody>
                      
                                @foreach($p->product as $o_p)
                                <tr> 
                                   
                                    <td>  <img style=" margin-right:5em;" width="100px" height="80px" src="{{ url('images/'.$o_p->image) }}"/> </td>
                                    <td>{{ App\Product::
                                     find($o_p->pivot->product_id)->name}}</td>
                                    <td>{{number_format($o_p->pivot->price,0,",",".")}} đ</td>
                                    <td>{{$o_p->pivot->qty}}</td>
                                    <td>{{number_format($o_p->pivot->amount,0,",",".")}} đ</td>
                                   
                                </tr>
                                @endforeach
                          
                           
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                               
                               
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <form role="form" action="{{ url('admin/order/postUpdate/'.$p->id) }}"  method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                            <label for="txt-name">Trạng thái đơn hàng:</label>
                            @if($p->status=="1")
                            <div class="form-group">
                                  
                                    <select name="status">
                                    
                                    <option value="{{$p->status}}"
                                     selected  hidden> 
                                 
                                     @if($p->status=="1")
                                     đang xử lý
                                     @else
                                     đã hoàn thành
                                      @endif
                                     </option> 
                                        <option value="1">đang  xử lý</option>
                                        <option value="2">đã hoàn thành</option>
                                       
  
  
                                       
                                    </select>
                                    <button type="submit" class="btn btn-primary">Cập nhập</button>
                                </div>
                                @else
                                <div class="form-group">
                                            Đã hòan thành
                                </div>
                               @endif
                            
                            </div>
                            <!-- /.card-body -->
                           
                               
                          
                        </form>
@endsection
@section('script-section')
    <script>
        $(function () {
            $('#product').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
