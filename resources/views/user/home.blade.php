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
                                <img src="{{ ('public/fronend/images/slide6.jpg') }}" class="girl img-responsive" alt="" />

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
                                <img src="{{ ('public/fronend/images/slide5.jpg') }}" class="girl img-responsive" alt="" />

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
                                <img src="{{ ('public/fronend/images/slide4.jpg') }}" class="girl img-responsive" alt="" />

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
<div class="col-sm-9 padding-right">

    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">sản phẩm mới </h2>
        <!--sản phẩm-->


<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{ ('public/fronend/images/slide1.jpg') }}" alt="" />
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

</div>
@endsection

<!--tìm theo chi tiết sản phẩm trang home-->

@section( 'detail_home')
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>loại sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Dòng máy
                        </a>
                    </h4>
                </div>
                <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">ASUS </a></li>
                            <li><a href="#">DELL</a></li>
                            <li><a href="#">MacBook </a></li>
                            <li><a href="#">HP</a></li>
                            <li><a href="#">Huawei </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Loại máy
                        </a>
                    </h4>
                </div>
                <div id="mens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">laptop Văn phòng</a></li>
                            <li><a href="#">Đồ Họa</a></li>
                            <li><a href="#"></a>Gameming</li>
                            <li><a href="#">máy nhân viên IT</a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Rom-Ram
                        </a>
                    </h4>
                </div>
                <div id="womens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">4gb-256gb</a></li>
                            <li><a href="#">4gd-1TB</a></li>
                            <li><a href="#">Valentino</a></li>
                            <li><a href="#">Dior</a></li>
                            <li><a href="#">Versace</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div><!--/category-products-->




    </div>
</div>
@endsection




