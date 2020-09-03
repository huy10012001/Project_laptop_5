<!-- Lưu tại resources/views/product/index.blade.php -->
<script>
      function deleteRole(role_id)
 {  

    var x = confirm("Are you sure you want to delete?");
    if (x)
    { 
        $.get(
       " {{ asset('admin/role/delete')}}",
       {
           role_id:role_id,
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
@section('title', 'Danh sách vai trò')
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
                                <th> vai trò</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($role as $p)
                            
                            <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->name}}</td>
                                    <td class="text-right">
                                   @if($p->name!="admin")
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/role/update/'.$p->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm"  onclick="deleteRole('{{$p->id}}')">
                                        
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                 
                                    </td>
                                    @endif
                            </tr>
                            
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Id</th>
                                <th> vai trò</th>
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
