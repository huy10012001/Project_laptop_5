@extends('layout_home')
@section( 'search')
<script>
   
</script>
@if($product->count()>0)
<div class="container" style="background: rgb(255, 255, 255);">
<div class="col-sm-12">
    <h5>tìm thấy sản phẩm cho từ khóa <b>{{$keyword}}</b></h5>
</div>
<div class="row">
    <div class="col-sm-12" style="  font-size: 20px;">
       <p>Sản Phẩm</p>

    </div>

<div class="col-sm-12">
<a>Mặc định</option>
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
