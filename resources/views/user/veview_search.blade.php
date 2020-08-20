@extends('layout_home')
@section( 'search')
<script>
   function macDinh()
   {
       var x=$("#keyword").val();
      window.location.href = "/search?keyword="+x;
   }
   $(document).ready(function() {
    $("#show").hide();
    setTimeout(function(){
        $('#show').fadeIn('slow');
    },500);
    var valueOrder= $("#orderByR").val();
    console.log(valueOrder);
    if(valueOrder!="")
    {
        if(valueOrder=="asc")
            valueOrder="giá cao đến thấp";
        else if(valueOrder=="desc")
            valueOrder="giá thấp đến cao";
        else
            valueOrder="Laptop mới nhất";
        $("#sapxep").text(valueOrder).append(" <span class='caret'></span>");
    }
   });
</script>

@if($product->count()>0)
<div class="container" style="background: rgb(255, 255, 255);">
<input type="hidden" id="keyword" value="{{$keyword}}">
@if(isset($requestorderby))
    <input type="hidden" id="orderByR" value="{{$requestorderby}}" name="orderby"> 
@else
<input type="hidden" id="orderByR"  name="orderby"> 
@endif
<div class="col-sm-12">
    <h5>tìm thấy sản phẩm cho từ khóa <b>{{$keyword}}</b></h5>
</div>
<div class="row" id="show" >
    <div class="col-sm-12" style="  font-size: 20px;">
       <p>Sản Phẩm</p>

    </div>
    <div class="sort" >
        
        <div class="col-sm-12" style="padding-right:60px;padding-bottom:10px;margin-bottom:10px; background: rgb(245, 244, 244); margin-top:-10px; ">
            <div class="dropdown" style=" float:right;">
                <button id="sapxep" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                <li><a    href="{{request()->fullUrlWithQuery(['orderby'=>'default'])}}">mặc định</option></li>
                <li><a   href="{{request()->fullUrlWithQuery(['orderby'=>'asc'])}}">giá cao đến thấp</a></a></li>
                <li> <a    href="{{request()->fullUrlWithQuery(['orderby'=>'desc'])}}">giá thấp đến cao</a></li>
                <li><a    href="{{request()->fullUrlWithQuery(['orderby'=>'new'])}}">Laptop mới nhất</a></li>
   
              
                </ul>
              </div>
        </div>

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

            @if(strpos($p->name, '/'))
             <li><a href="{{ URL::to('/product/'.Str::slug(substr($p->name, 0, strpos($p->name, '/')))) }}" ><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
             @else
             <li><a href="{{ URL::to('/product/'.Str::slug($p->name)) }}" ><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
             @endif
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