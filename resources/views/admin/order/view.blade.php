<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout')
@section('title', 'product index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
                    <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    </div>
                     <!-- /.card-header -->
                    
                     <div class="card-body">
                        <table class="table table-bordered ">
                            
                            
                            <tr>
                                 <th>Tên người nhận</th>
                                 <td>{{App\Order::find($p->id)->name}}</td>
                            </tr>
                            <tr>   
                                <th>Email</th> 
                                <td>{{App\Order::find($p->id)->user->email}}</td>
                            </tr>
                           
                            <tr>
                                <th>Địa chỉ</th>
                                <td>{{App\Order::find($p->id)->address}}</td> 
                            <tr>
                            <tr>
                                 <th>Số điện thoại</th> 
                                 <td>{{App\Order::find($p->id)->phone}}</td>
                                </tr>
                            </tr>
                            <tr>
                                 <th>Total</th> 
                                 <td>{{App\Order::find($p->id)->total}}</td>
                                </tr>
                            </tr>
                           
                        </table>
                     </div>
                    
                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th></th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>qty</th>
                                <th>Amount</th>
                               
                            </tr>
                            </thead>
                           
                            <tbody>
                            @if($p->status=="1")
                                @foreach($p->product as $o_p)
                                <tr> 
                                    <td>{{$o_p->pivot->	order_id}}</td>
                                    <td>  <img style=" margin-right:5em;" width="100px" height="80px" src="{{ url('images/'.$o_p->image) }}"/> </td>
                                    <td>{{ App\Product::
                                     find($o_p->pivot->product_id)->name}}</td>
                                    <td>{{$o_p->pivot->	price}}</td>
                                    <td>{{$o_p->pivot->	qty}}</td>
                                    <td>{{$o_p->pivot->	amount}}</td>
                                   
                                </tr>
                                @endforeach
                            @else
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
                                 <th>Order Id</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>qty</th>
                                <th>Amount</th>
                               
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
