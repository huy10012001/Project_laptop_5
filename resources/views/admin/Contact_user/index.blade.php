<!-- Lưu tại resources/views/product/index.blade.php -->
<script>
      function deleteContact(contact_id)
 {  

    var x = confirm("Are you sure you want to delete?");
    if (x)
    {
        $.get(
            " {{ asset('admin/contact_user/delete')}}",
       {
         contact_id:contact_id,
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
                                <th>Id</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>suuject</th>
                                
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contact_user as $p)
                            <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->name}}</td>
                                    <td>{{$p->email}}</td>
                                    <td>{{$p->phone}}</td>
                                    <td>{{$p->address}}</td>
                                    <td>{{$p->subject}}</td>
                                    <td><a class="btn btn-danger btn-sm" onclick="deleteContact('{{$p->id}}')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a></td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Id</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>suuject</th>
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
