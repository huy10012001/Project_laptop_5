<!-- Lưu tại resources/views/product/index.blade.php -->
<script>
      function deleteContact(contact_id)
 {  

    var x = confirm("Are you sure you want to delete?");
    if (x)
    {
        $.get(
            " {{ asset('admin/comment/delete')}}",
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
@section('title', 'Danh sách liên hệ')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                   
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
                                <th>Tên Người bình luận</th>
                                <th>Email</th>
                             
                                <th>Tên sản phẩm</th>
                                <th>Nội dung</th>
                                
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comment_user as $p)
                            <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->user->name}}</td>
                                    <td>{{$p->user->email}}</td>
                              
                                    <td>{{$p->product->name}}</td>
                                    <td>{{$p->content}}</td>
                                  
                                   
                                    <td><a class="btn btn-danger btn-sm" onclick="deleteContact('{{$p->id}}')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a></td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <tr>
                          
                            <th>Id</th>
                                <th>Tên Người dùng</th>
                                <th>Email</th>
                                <th>Tên sản phẩm</th>
                                <th>Nội dung</th>
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
