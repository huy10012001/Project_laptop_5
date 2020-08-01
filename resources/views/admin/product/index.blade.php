<!-- Lưu tại resources/views/product/index.blade.php -->
<script>
      function deleteProduct(product_id)
 {
 
    $.get(
       " {{asset('admin/product/delete')}}",
       {
         product_id:product_id,
         function()
           {
               location.reload();
           }
       }
    );
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
                                <th>Product Id</th>
                                <th>Product Category</th>
                                <th>Product Name</th>
                                <th>Price</th>
                               
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                               
                                <td>{{ $p::find($p->id)->category->name
                                    }}</td>
                                <td>{{ $p->name }}</td>
                              
                                <td>{{ $p->price }}</td>
                                
                                <td><img width="100px" src="{{ url('images/'.$p->image) }}"/></td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/product/update/'.$p->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"  
                                  onclick="deleteProduct('{{$p->id}}')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Product Id</th>
                                <th>Product Category</th>
                                <th>Product Name</th>
                                <th>Price</th>
                               
                                <th>Image</th>
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
