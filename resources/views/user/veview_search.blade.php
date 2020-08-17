@extends('layout_home')
@section( 'search')
<div class="container" style="background: rgb(255, 255, 255);">
<div class="col-sm-12">
    <h5>tìm thấy sản phẩm cho từ khóa <b>"Macbook"</b></h5>
</div>
<div class="row">
    <div class="col-sm-12" style="  font-size: 20px;">
       <p>Sản Phẩm</p>

    </div>
<div class="col-sm-12">

    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ ('fronend/images/slide1.jpg') }}" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$56s</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                        </div>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">

                    <li><a href="#"><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
                </ul>
            </div>
    </div>

        </div>
</div>
</div>
</div>

@endsection
