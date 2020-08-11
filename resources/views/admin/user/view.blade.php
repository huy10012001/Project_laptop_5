<!-- Lưu tại resources/views/product/index.blade.php -->


<script>


/*function addRole(user_id)
 {
     
  alert($( "#test" ).val());
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url:  " {{ asset('admin/user/addRole')}}",
        data: { user_id:user_id ,role_id:$( "#test  " ).val()}, 
        success: function(data) {
            location.reload();  
            return data;
          
            
        }
    });
 }*/

    function deleteRole(user_id,role_id)
 {
   
  
    $.get(
       " {{ asset('admin/user/deleteRole')}}",
       {
        user_id:user_id,role_id:role_id,
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
                        <br/>
                        <h3 class="card-title">vai trò của người dùng {{$p->name}}</h3>
                       
                    </div>
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message')}}</p>
                        {{Session::forget('message')}}
                         @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Role Id</th>
                                <th>Role</th>
                               
                               
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                 @foreach($p->role as $p1)
                                <tr> 
                                    <td>{{$p1->id}}</td>
                                    <td>{{$p1->name}}</td>
                                   
                                    <td class="text-right">
                                    @if($p1->name!="super admin")
                                    <a class="btn btn-danger btn-sm" 
                                   onclick="deleteRole('{{$p->id}}','{{$p1->id}}')">
                                         <i class="fas fa-trash"></i> Delete
                                    </a>
                                    @endif
                                    </td>
                                </tr>
                           
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                 <th>Role Id</th>
                                <th>Role </th>
                               
                                
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
    <form  action="{{ url('admin/user/postAddRole/'.$p->id) }}" method="post"
    enctype="multipart/form-data"     >
                            {{ csrf_field() }}
        
        <div class="card-body">
            <div class="form-group">
                <label for="txt-name">Role</label>
                    <select name="roleUser">
                        @foreach(App\role::all() as  $category)
                        
                        @if($category->name!="super admin" )
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                        @endforeach
                    </select>                                       
                    <br/></br>
                    <button type="submit"  name="submit" class="btn btn-primary">Add</button>
                    <br/> <br/>
            </div>
                              
        </div>
                            <!-- /.card-body -->
    </form>
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
