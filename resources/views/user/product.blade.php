
@php
session_start();
@endphp
@extends('layout_home')

@section( 'dell')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function AddCart(product_id)
 {
    
    //var userName = document.getElementById("name").value;
   
    $.ajax({
    type:  "GET",
    url: "{{ asset('Addcart')}}",
    
    data: { product_id: product_id },
    datatype: 'json',
    success: function (data) {
        if(data.status=="error")
        {
            alert(data.message);
        }
       
        location.reload();

    },
  
    });
    /*$.get(
       
       " {{ asset('Addcart')}}",
       {
        product_id:product_id,
         
           function()
           {
             location.reload();
           }
       }
    )*/
   
 }
</script>

<div class="container">
    <!--tìm theo chi tiết sản phẩm trang home-->


<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>loại sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Sportswear
                        </a>
                    </h4>
                </div>
                <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Nike </a></li>
                            <li><a href="#">Under Armour </a></li>
                            <li><a href="#">Adidas </a></li>
                            <li><a href="#">Puma</a></li>
                            <li><a href="#">ASICS </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            máy tính văn phòng
                        </a>
                    </h4>
                </div>
                <div id="mens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Fendi</a></li>
                            <li><a href="#">Guess</a></li>
                            <li><a href="#">Valentino</a></li>
                            <li><a href="#">Dior</a></li>
                            <li><a href="#">Versace</a></li>
                            <li><a href="#">Armani</a></li>
                            <li><a href="#">Prada</a></li>
                            <li><a href="#">Dolce and Gabbana</a></li>
                            <li><a href="#">Chanel</a></li>
                            <li><a href="#">Gucci</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Womens
                        </a>
                    </h4>
                </div>
                <div id="womens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Fendi</a></li>
                            <li><a href="#">Guess</a></li>
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
<div class="col-sm-9 padding-right">

    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">sản phẩm Laptop {{$c->name}}</h2>
        <!--sản phẩm-->

 @foreach($c->product as $p)
<div class="col-sm-4">

    <div class="product-image-wrapper">
         
        <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{ url('fronend/images/slide1.jpg') }}" alt="" />
                    <h2>{{number_format($p->price)}}</h2>
                    <p>{{$p->name}}</p>
                    <a onclick="AddCart('{{$p->id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($p->price)}}</h2>
                        <p>{{$p->name}}</p>
                        <a   onclick="AddCart('{{$p->id}}')"     class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
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

@endforeach 

</div><!--features_items-->

</div>



</div>

@endsection
