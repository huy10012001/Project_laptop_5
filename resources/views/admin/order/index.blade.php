<!-- Lưu tại resources/views/product/index.blade.php -->
<script>
      function deleteOrder(order_id)
 {  
    var x = confirm("Are you sure you want to delete?");
    if (x)
    {
      
        $.get(
       " {{ asset('admin/order/delete')}}",
       {
           order_id:order_id,
           function()
           {    
              
              location.reload();
           }
       }
    );
    }
 }
 
</script>

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
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                        {{Session::forget('message')}}
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>User Id</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                           
                            @foreach($orders as $o)
                            <tr>
                                <td>{{$o->id}}</td>
                                <td>{{$o->user_id}}</td>
                                <td>{{$o->status}}</td>
                                <td>{{$o->total}}</td>
                                <td>{{$o->date}}</td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/order/view/'.$o->id) }}">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/order/update/'.$o->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick="deleteOrder('{{$o->id}}')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                               
                                
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                               
                                <th>Order Id</th>
                                <th>User Id</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date</th>
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
