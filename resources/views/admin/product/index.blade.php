<!-- Lưu tại resources/views/product/index.blade.php -->
<script>
      function deleteProduct(product_id)
 {
    var x = confirm("Are you sure you want to delete?");
    if (x)
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
 }
 
</script>
@extends('layout.layout')
@section('title', 'Danh sách sản phẩm')
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
                                <th>Mã sản phẩm</th>
                                <th>Thương hiệu</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                               
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                               
                                <td>{{ $p::find($p->id)->category->name
                                    }}</td>
                                <td>{{ $p->name }}</td>
                              
                                <td>{{number_format($p->price,0,",",".")}}  đ</td>
                                <td><img width="100px" src="{{ url('images/'.$p->image) }}"/></td>
                               
                                @if( $p->status=="1")
                                <td><div class="alert alert-primary" role="alert">
                                 Sản phẩm  hoạt động!
                                </div></td>
                                @else
                                <td><div class="alert alert-danger" role="alert">
                                 Sản phẩm không hoạt động!
                                </div></td>
                                @endif
                                <td class="text-right">
                                <a class="btn btn-info btn-sm" href="{{ url('admin/product/detail/'.$p->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Xem chi tiết
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/product/update/'.$p->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                   
                                    <a class="btn btn-danger btn-sm"  
                                  onclick="deleteProduct('{{$p->id}}')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Mã sản phẩm</th>
                                <th>Thương hiệu</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                               
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
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
