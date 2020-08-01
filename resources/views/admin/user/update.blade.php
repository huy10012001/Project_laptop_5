<!-- lưu tại /resources/views/product/create.blade.php -->

<script>

function myFunction() {
    var select = document.createElement("select");
    select.name="role[]"; 
 <?php
   foreach(App\role::all() as  $category)
 {?>
     
    var option = document.createElement("option");
    option.text = "<?php echo "$category->name"?>";
    option.value ="<?php echo "$category->id"?>";
  
    select.appendChild(option);
    
 <?php }?>

var demo=document.getElementById("demo");


demo.appendChild(select);
demo.appendChild(document.createTextNode (" "));
var newLink = document.createElement("a");
    // add the URL attribute
    newLink.setAttribute("class", "btn btn-danger btn-sm");
  
    newIcon=document.createElement("i");
    newIcon.setAttribute("class","fas fa-trash");
    newLink.appendChild(newIcon);
   
    // Add some text
    newText = document.createTextNode("Delete");
    // Add it to the new hyperlink
    newLink.appendChild(document.createTextNode (" "));
    newLink.appendChild(newText);
  
    // Find the place to put it
    newLink.setAttribute('onclick',' runCommand();');
    // add this to the DOM in memory
     demo.appendChild(newLink);
     demo.appendChild(document.createElement("br"));
     demo.appendChild(document.createElement("br"));

}
</script>
@extends('layout.layout')
@section('title', 'product - create new')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update user {{$p->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- xử lý hiện thông báo lỗi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (\Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                    <!-- form start -->
                        <form role="form" action="{{ url('admin/user/postUpdate/'.$p->id) }}"  method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="txt-name">Role</label>
                                    <div id="demo">
                                    @foreach(App    \User::find($p->id)->role as $p)
                                  
                                     <select name="role[]">
                                     <option value="@php echo  $p->id @endphp"
                                     selected  hidden> 
                                         {{$p->name}}
                                     </option> 
                                        @foreach(App\role::all() as  $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                         @endforeach
                                      </select>
                                      <a class="btn btn-danger btn-sm"  onclick=" runCommand()">
                                         <i class="fas fa-trash"></i> Delete
                                        </a>
                                        <br/> <br/>
                                        @endforeach
                                   </div>
                                    
                                     
                                </div>
                            <i class="fa fa-plus" aria-hidden="true" onclick="myFunction()" >Chọn thêm role</i> 
                              
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script-section')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
         var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
    </script>
@endsection
