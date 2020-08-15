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
            @if(Session::has('flash_message'))
                 <div class="alert alert-success">
                      {{ Session::get('flash_message')}}     
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
                            </tr>
                            <tr>
                                 <th>Tổng tiền</th> 
                                 <td>{{App\Order::find($p->id)->total}}</td>
                                </tr>
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
                            @if($p->status=="2" ||$p->status=="1")
                                @foreach($p->product as $o_p)
                                <tr> 
                                   
                                    <td>  <img style=" margin-right:5em;" width="100px" height="80px" src="{{ url('images/'.$o_p->image) }}"/> </td>
                                    <td>{{ App\Product::
                                     find($o_p->pivot->product_id)->name}}</td>
                                    <td>{{$o_p->pivot->price}}</td>
                                    <td>{{$o_p->pivot->qty}}</td>
                                    <td>{{$o_p->pivot->amount}}</td>
                                   
                                </tr>
                                @endforeach
                            @elseif($p->status=="0")
                                @foreach($p->product as $o_p)
                                @if($o_p->status=="1")
                                <tr> 
                              
                                <td>  <img style=" margin-right:5em;" width="100px" height="80px" src="{{ url('images/'.$o_p->image) }}"/> </td>
                                    <td>{{ App\Product::
                                     find($o_p->pivot->product_id)->name}}</td>
                                    <td>{{$o_p->pivot->	price}}</td>
                                    <td>{{$o_p->pivot->	qty}}</td>
                                    <td>{{$o_p->pivot->	amount}}</td>   
                                </tr>
                                @endif
                                @endforeach
                            @endif
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
