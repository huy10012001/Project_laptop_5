<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout')
@section('title', 'Danh sách người dùng')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">

      
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
  
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
                                <th>Tên</th>
                                <th>Email</th>
                               
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                                <th>Ảnh</th>
                                <th>Vai trò</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->skip(1) as $p)
                            
                            <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->name}}</td>
                                    <td>{{$p->email}}</td>
                                   
                                    <td>{{$p->phone}}</td>
                                    <td>{{$p->address}}</td>
                                    <td>{{$p->image}}</td>
                                   @if($p::find($p->id)->role->count()>0)
                                     <td>
                                    @php
                                    $count=0;
                                    @endphp
                                    @foreach($p::find($p->id)->role as $p1)
                                    <!--
                                       @php
                                       echo $count=$count+1;
                                       
                                      @endphp.
-->
                                    
                                      {{ $p1->name }} 
                                      <br/>
                                   @endforeach
                                    </td>
                                   @else
                                     <td></td>
                                   @endif
                                    <td class="text-right">
                                   
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/user/viewRole/'.$p->id) }}">
                                        <i class="fas fa-pencil-alt"></i>  Xem vai trò
                                    </a>
                                   
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Id</th>
                                <th>Tên</th>
                                <th>Email</th>
                               
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                                <th>Ảnh</th>
                                <th>Vai trò</th>
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
