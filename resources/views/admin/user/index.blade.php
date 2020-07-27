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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>image</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $p)
                            <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->name}}</td>
                                    <td>{{$p->email}}</td>
                                    <td>{{$p->age}}</td>
                                    <td>{{$p->phone}}</td>
                                    <td>{{$p->address}}</td>
                                    <td>{{$p->image}}</td>
                                   @if($p::find($p->id)->role->count()>0)
                                     <td>
                                    @php
                                    $count=0;
                                    @endphp
                                    @foreach($p::find($p->id)->role as $p)
                                       @php
                                       echo $count=$count+1;
                                       
                                      @endphp
                                    
                                      .{{ $p->name }} 
                                      <br/>
                                   @endforeach
                                    </td>
                                  @else
                                     <td>123</td>
                                   @endif
                                    <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/role/update/'.$p->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>image</th>
                                
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
