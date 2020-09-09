
@extends('layout_home')
@section( 'slide')
<style>

.carousel-control
{
  width: 4%;

}

</style>
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
                             <div class="col-sm-6" style="margin-top:-50px;">
                                <h1><span>LapTop</span>-Shop</h1>
                                <h2>giao hàng tận nơi</h2>
                                <p>miễn phí giao hàng tận tay bạn , thanh toán khi sản phẩm được giao và kiểm tra. </p>
                                <button type="button" class="btn btn-default get">xem sản phẩm</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ ('fronend/images/slide6.jpg') }}" class="girl img-responsive" alt="" />

                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6"style="margin-top:-50px;">
                                <h1><span>LapTop</span>-Shop</h1>
                                <h2>100% hàng chất lương<l/h2>
                                <p>uy tính và chất lượng đặt trên hàng đầu. </p>
                                <button type="button" class="btn btn-default get">xem sản phẩm</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ ('fronend/images/slide5.jpg') }}" class="girl img-responsive" alt="" />

                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6" style="margin-top:-50px;">
                                <h1><span>LapTop</span>-Shop</h1>
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



    <div class="card">
        <div class="box">
            <h2>Laptop</h2>
        </div>

        <a href="/product/macbook"><img src="{{ ('fronend/images/mac.jpg') }}" alt=""></a>
        <a href="/product/asus"><img src="{{ ('fronend/images/Asus.jpg') }}" alt=""></a>
       <a href="/product/dell"> <img src="{{ ('fronend/images/Dell.jpg') }}" alt=""></a>
      <a href="/product/acer">  <img src="{{ ('fronend/images/Acer.jpg') }}" alt=""></a>
        <a href="/product/hp"><img src="{{ ('fronend/images/HP.jpg') }}" alt=""></a>
        <a href="/product/msi"><img src="{{ ('fronend/images/MSI.jpg') }}" alt=""></a>
      <a href="/product/lenovo">  <img src="{{ ('fronend/images/Lenovo.jpg') }}" alt=""></a>

        </div>
    </div>
    <div class="col-sm-12">
        <a href="/product/dell"><img src="https://laptopxachtayshop.com/images/banner/11-56-11_28-07-2020.jpg" alt="" style="width:100%;"></a>
    </div>
    <div class="spm">
        <div style="text-align: right;">
        <a   href="{{ url('product') }}">Xem tất cả</a>
    </div>
    <h2 class="title text-center">Giá sốc hôm nay</h2>
    </div>

<div id="giasocproductcarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="margin-bottom: 30px;">
      <!--Nếu sản phẩm hoạt đang hoạt động và đã cập nhập detail -->

        <div class="item  row active">
          @foreach($sale_product->take(4) as $s_p)
          <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$s_p->image) }}" alt="" />
              <h2>{{number_format($s_p->price,0,",",".")}} đ</h2>

               <p style="word-break: break-all;" >{{$s_p->name}}</p>
                <div class="row" style="font-size: 12px;">
               <div class="col-sm-4"> Ram:<?php  echo json_decode($s_p->description,true)['11'] ?></div>
               <div class="col-sm-8"> Ổ cứng:<?php  echo json_decode($s_p->description,true)['16'] ?></div>
              </div>
                <a onclick="AddCart('{{$s_p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>

          </div>
         <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="{{ url('product/'.$s_p->slug) }}"></i>Chi tiết sản phẩm</a></li>
            </ul>
          </div>
        </div>
        @endforeach
      </div>
      @php
      $product_slide2over=$sale_product->skip(4)
      @endphp
      @foreach($product_slide2over->chunk(4) as $s_products)
      <div class="row  item course-set courses__row">
        @foreach($s_products as $s_p)
        <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$s_p->image) }}" alt="" />
              <h2>{{number_format($s_p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$s_p->name}}</p>
               <div class="row" style="font-size: 12px;" >
               <div class="col-sm-4"> Ram:<?php  echo json_decode($s_p->description,true)['11'] ?></div>
               <div class="col-sm-8"> Ổ cứng:<?php  echo json_decode($s_p->description,true)['16'] ?></div>
              </div>
                <a onclick="AddCart('{{$s_p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>

          </div>
          <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="{{ url('product/'.$s_p->slug) }}"></i>Chi tiết sản phẩm</a></li>
            </ul>
          </div>
       </div>
        @endforeach
      </div>
      @endforeach

    </div>

    <!-- Left and right controls -->

      <a class="left carousel-control" href="#giasocproductcarousel" data-slide="prev">

        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>

      </a>
      <a class="right carousel-control" href="#giasocproductcarousel" data-slide="next">

        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>

      </a>

</div>

<div class="spm">
        <div style="text-align: right;">
    <a   href="{{ url('product?orderby=new') }}">Xem tất cả</a>
    </div>
    <h2 class="title text-center">sản phẩm mới nhất</h2>
</div>

<div id="newproductcarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="margin-bottom: 30px;">
      <!--Nếu sản phẩm hoạt đang hoạt động và đã cập nhập detail -->

        <div class="item  row active">
          @foreach($new_product->take(4) as $n_p)
          <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$n_p->image) }}" alt="" />
              <h2>{{number_format($n_p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$n_p->name}}</p>
               <div class="row" style="font-size: 12px;">
               <div class="col-sm-4"> Ram:<?php  echo json_decode($s_p->description,true)['11'] ?></div>
               <div class="col-sm-8"> Ổ cứng:<?php  echo json_decode($s_p->description,true)['16'] ?></div>
              </div>
                <a onclick="AddCart('{{$n_p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>

          </div>
          <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="{{ url('product/'.$n_p->slug) }}"></i>Chi tiết sản phẩm</a></li>
            </ul>
          </div>
        </div>
        @endforeach
      </div>
      @php
      $product_slide2over=$new_product->skip(4)
      @endphp
      @foreach($product_slide2over->chunk(4) as $n_products)
      <div class="row  item course-set courses__row">
        @foreach($n_products as $n_p)
        <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$n_p->image) }}" alt="" />
              <h2>{{number_format($n_p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$n_p->name}}</p>
               <div class="row" style="font-size: 12px;">
               <div class="col-sm-4"> Ram:<?php  echo json_decode($s_p->description,true)['11'] ?></div>
               <div class="col-sm-8"> Ổ cứng:<?php  echo json_decode($s_p->description,true)['16'] ?></div>
              </div>
                <a onclick="AddCart('{{$n_p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>

          </div>
          <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="{{ url('product/'.$n_p->slug) }}"></i>Chi tiết sản phẩm</a></li>
            </ul>
          </div>
       </div>
        @endforeach
      </div>
      @endforeach

    </div>

    <!-- Left and right controls -->

      <a class="left carousel-control" href="#newproductcarousel" data-slide="prev">

        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>

      </a>
      <a class="right carousel-control" href="#newproductcarousel" data-slide="next">

        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>

      </a>

</div>


@foreach($all_category->take(3) as $category)

  <div class="spm"  >
    <div style="text-align: right;">
    <a   href="{{ url('product/'.$category->name) }}">Xem tất cả</a>
    </div>
    <h2 class="title text-center">{{$category->name}} </h2>

  </div>
  <!--
  @php
    $products[$category->id]=App\product::where(['category_id'=>$category->id,'status'=>"1"])
    ->join('detail_product','detail_product.product_id','=','product.id');
    $products[$category->id]=$products[$category->id]->paginate(2);
  @endphp
  @foreach($products[$category->id] as $product[$category->id])
      {{$product[$category->id]->name}}

  @endforeach
  {{$products[$category->id]->links()}}
-->
    @php

    $product=App\product::where(['category_id'=>$category->id,'status'=>"1"])
    ->join('detail_product','detail_product.product_id','=','product.id')->get();


    @endphp

   <div id="categorycarousel{{$category->id}}" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="margin-bottom: 30px">
      <!--Nếu sản phẩm hoạt đang hoạt động và đã cập nhập detail -->

        <div class="item  row active">
          @foreach($product->take(4) as $p)
          <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$p->image) }}" alt="" />
              <h2>{{number_format($p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$p->name}}</p>
               <div class="row" style="font-size: 12px;">
               <div class="col-sm-4"> Ram:<?php  echo json_decode($s_p->description,true)['11'] ?></div>
               <div class="col-sm-8"> Ổ cứng:<?php  echo json_decode($s_p->description,true)['16'] ?></div>
              </div>
                <a onclick="AddCart('{{$p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>

          </div>
          <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="{{ url('product/'.$p->slug) }}"></i>Chi tiết sản phẩm</a></li>
            </ul>
          </div>
        </div>
        @endforeach
      </div>
      @php
      $product_slide2over=$product->skip(4)
      @endphp
      @foreach($product_slide2over->chunk(4) as $products)
      <div class="row  item course-set courses__row " >
        @foreach($products as $p)
        <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$p->image) }}" alt="" />
              <h2>{{number_format($p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$p->name}}</p>
               <div class="row" style="font-size: 12px;">
               <div class="col-sm-4"> Ram:<?php  echo json_decode($s_p->description,true)['11'] ?></div>
               <div class="col-sm-8"> Ổ cứng:<?php  echo json_decode($s_p->description,true)['16'] ?></div>
              </div>
                <a onclick="AddCart('{{$p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>

          </div>
          <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="{{ url('product/'.$p->slug) }}"></i>Chi tiết sản phẩm</a></li>
            </ul>
          </div>
       </div>
        @endforeach
      </div>
      @endforeach

    </div>

    <!-- Left and right controls -->
    @if( $product->count()>4)
      <a class="left carousel-control" href="#categorycarousel{{$category->id}}" data-slide="prev">

        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>

      </a>
      <a class="right carousel-control" href="#categorycarousel{{$category->id}}" data-slide="next">

        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>

      </a>
      @endif
  </div>

@endforeach


@endsection

<!--tìm theo chi tiết sản phẩm trang home-->
