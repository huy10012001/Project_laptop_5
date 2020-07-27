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
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Cart Id</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>qry</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $c)
                               @if($c->status=="1")
                               {
                                    @foreach($c::find($c->id)->productA as $p)
                                <tr> 
                                    <td>{{$p->pivot->	order_id}}</td>
                                    <td>{{$p->pivot->	product_id}}</td>
                                    <td>{{$p->pivot->	price}}</td>
                                    <td>{{$p->pivot->	qty}}</td>
                                    <td>{{$p->pivot->	amount}}</td>
                                    <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('product/update/'.$p->pivot->cart_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/order_product/delete/'.$p->pivot->order_id.'/'.$p->pivot->product_id) }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                    </td>
                                </tr>
                                }
                                @else
                                @foreach($c::find($c->id)->productB as $p)
                                <tr> 
                                    <td>{{$p->pivot->	order_id}}</td>
                                    <td>{{$p->pivot->	product_id}}</td>
                                    <td>{{$p->pivot->	price}}</td>
                                    <td>{{$p->pivot->	qty}}</td>
                                    <td>{{$p->pivot->	amount}}</td>
                                    <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('product/update/'.$p->pivot->cart_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/order_product/delete/'.$p->pivot->order_id.'/'.$p->pivot->product_id) }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                 <th>Order Id</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>qry</th>
                                <th>Amount</th>
                                
                                <th></th>
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
