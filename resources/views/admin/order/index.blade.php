<!-- Lưu tại resources/views/product/index.blade.php -->
<style>
  


select option[value="1"] {
    background-color: white;
    color:black;
}

select option[value="2"] {
    background-color: white;
    color:black;
}

</style>
<script>
      function editOrder(order_id,status)
 {  

      //  $("tbody").find(".status").css("background-color", "yellow");
        var x=$(status).parentsUntil("tbody").find(".status option:selected").val();
      
        $.get(
       " {{ asset('admin/order/edit')}}",
       {
           order_id:order_id,status:x,
           function()
           {    
              
              location.reload();
           }
       }
    );
    
 }
 
</script>

@extends('layout.layout')
@section('title', 'Danh sách hóa đơn')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
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
                                <th>Mã hóa đơn</th>
                                <th>Tên khách hàng</th>
                                <th>Tình trạng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                           
                            @foreach($orders as $o)
                            @if($o->status=="1"||$o->status=="2")
                            <tr>
                                <td>{{$o->id}}</td>
                                <td>{{$o->user->name}}
                                <td>@if($o->status=="1" )
                                <div class="alert alert-primary">
                                    đang xử lý
                                </div>
                                @else
                                <div class="alert alert-danger">
                                    đã hoàn thành
                                </div>
                                @endif</td>
                            <!--
                                @if($o->status=="1" )

                                <td class="status">
                             
                                    <select  style="padding-left: 15px;font-size:16px"  class="alert-primary custom-select mb-3">
                                
                                <option  value="{{$o->status}}"
                                     selected hidden > 
                                       đang  xử lý
                                </option>
                                
                                
                                 <option  value="1" >đang xử lý</option>
                                 <option value="2">đã hoàn thành</option>
                                 
                                </select></td>
                                @elseif($o->status=="2")
                                
                                <td><div class="alert alert-danger" role="alert">
                                 đã hoàn thành
                                </div></td>
                                @endif-->
                                <td>	{{number_format($o->total,0,",",".")}} đ</td>
                                <td>
                                {{date('d/m/Y', strtotime($o->date)) }}
                                </td>
                                <td class="text-right">
                                <a class="btn btn-danger btn-sm" href="{{ url('dynamic_pdf/'.$o->id.'/pdf')}}">
                                        <i class="fas fa-folder"></i> xuất hóa đơn
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/order/view/'.$o->id) }}">
                                        <i class="fas fa-folder"></i> Xem
                                    </a> 
                                    <!-- <a class="btn btn-info btn-sm"   onclick="editOrder('{{$o->id}}',this)">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                    
                                   <a class="btn btn-info btn-sm"  href="{{ url('admin/order/update/'.$o->id) }}"  >
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>-->
                                </td>
                               
                                
                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                               
                                <th>Mã hóa đơn</th>
                                <th>Tên khách hàng</th>
                                <th>Tình trạng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
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
