@extends('layout_home')
@section( 'slide')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                             <div class="col-sm-6">
                                <h1><span>lapTop</span>-Shop</h1>
                                <h2>giao hàng tận nơi</h2>
                                <p>miễn phí giao hàng tận tay bạn , thanh toán khi sản phẩm được giao và kiểm tra. </p>
                                <button type="button" class="btn btn-default get">xem sản phẩm</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ ('fronend/images/slide6.jpg') }}" class="girl img-responsive" alt="" />

                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>lapTop</span>-Shop</h1>
                                <h2>100% hàng chất lương</h2>
                                <p>uy tính và chất lượng đặt trên hàng đầu. </p>
                                <button type="button" class="btn btn-default get">xem sản phẩm</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ ('fronend/images/slide5.jpg') }}" class="girl img-responsive" alt="" />

                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>lapTop</span>-Shop</h1>
                                <h2>giao dịch trực tiếp trên website</h2>
                                <p>uy tính chất lượng là điều quan trọng tạo nên LapTop-shop của chúng tôi. </p>
                                <button type="button" class="btn btn-default get">xem sản phẩm</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ ('fronend/images/slide4.jpg') }}" class="girl img-responsive" alt="" />

                            </div>
                        </div>

                    </div>


                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<!--slide-->
@endsection


<!--product trang home-->
@section('product')

<div class="col-sm-12 padding-right">

    <div class="card">
        <div class="box">
            <h2>Laptop</h2>
        </div>
        <div class="category" >

        <a href=""><img src="{{ ('fronend/images/mac.jpg') }}" alt=""></a>
        <a href=""><img src="{{ ('fronend/images/Asus.jpg') }}" alt=""></a>
       <a href=""> <img src="{{ ('fronend/images/Dell.jpg') }}" alt=""></a>
      <a href="">  <img src="{{ ('fronend/images/Acer.jpg') }}" alt=""></a>
        <a href=""><img src="{{ ('fronend/images/HP.jpg') }}" alt=""></a>
        <a href=""><img src="{{ ('fronend/images/MSI.jpg') }}" alt=""></a>
      <a href="">  <img src="{{ ('fronend/images/Lenovo.jpg') }}" alt=""></a>

        </div>
    </div>
        <div class="features_items"><!--features_items-->
        <div class="spm">
        <h2 class="title text-center">sản phẩm mới </h2> <br>
        </div>
        <!--sản phẩm-->
        <div class="sort" >
            <div class="col-sm-12" style="background: rgb(245, 244, 244); margin-top:-10px; ">
                <div class="dropdown" style="float:right;padding-right:40px">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#">giá cao đến thấp </a></li>
                      <li><a href="#">giá thấp đến cao</a></li>
                      <li><a href="#">laptop mới nhất</a></li>
                    </ul>
                  </div>
            </div>
        </div>
        <div class="footer">
            <div class="col-sm-12" style="height: 5px; width:10px;">

            </div>

        </div>


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

</div><!--features_items-->
<div class="spm">
    <h2 class="title text-center">sản phẩm bán chạy nhất</h2>
</div>

<div class="spm">
    <h2 class="title text-center">MacBook </h2>
</div>
</div>
@endsection

<!--tìm theo chi tiết sản phẩm trang home-->