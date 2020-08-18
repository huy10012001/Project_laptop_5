@extends('layout_home')
@section( 'search')
<script>
   function macDinh()
   {
       var x=$("#keyword").val();
      window.location.href = "/search?keyword="+x;
   }
    $('.filterForm').on('submit',function(e){
            e.preventDefault();
            var formData=$(this).serialize();
            var fullUrl = window.location.href;
            var finalUrl = fullUrl+"&"+formData;
          //  window.location.href = finalUrl;

    })
</script>
@if($product->count()>0)
<div class="container" style="background: rgb(255, 255, 255);">
<input type="hidden" id="keyword" value="{{$keyword}}">
<div class="col-sm-12">
    <h5>tìm thấy sản phẩm cho từ khóa <b>{{$keyword}}</b></h5>
</div>
<div class="row">
    <div class="col-sm-12" style="  font-size: 20px;">
       <p>Sản Phẩm</p>

    </div>
<form class="filterForm" >
  <label for="cars">Choose a car:</label>
  <select name="cars" id="cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="opel">Opel</option>
    <option value="audi">Audi</option>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>
<div class="col-sm-12">
<a  onclick="macDinh()">Mặc định</option>
<a  href="{{request()->fullUrlWithQuery(['orderBy'=>'asc'])}}">Tăng dần</a>
<a    href="{{request()->fullUrlWithQuery(['orderBy'=>'desc'])}}">giảm dần</a>
@foreach($product as $p)

   



<div class="col-sm-3">

    <div class="product-image-wrapper">
         
        <div class="single-products">
                <div class="productinfo text-center">
                    <img  height="200px" src="{{ url('images/'.$p->image) }}" alt="" />
                    <h2>{{number_format($p->price)}} đ</h2>
                    <p style="word-break: break-all;" >{{$p->name}}</p>
                    <a onclick="AddCart('{{$p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($p->price)}} đ</h2>
                        <p  style="word-break: break-all;" >{{$p->name}}</p>
                        <a   onclick="AddCart('{{$p->product_id}}')"     class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                    </div>
                </div>
                
        </div>
        
        <div class="choose">
            <ul class="nav nav-pills nav-justified">

                <li><a href="{{ URL::to('/product/'.Str::slug($p->name)) }}" ><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
            </ul>
        </div>
    </div>
   
</div>

@endforeach 
</div>
@else
không tìm thấy sản phẩm cho từ khóa {{$keyword}}
@endif
@endsection
