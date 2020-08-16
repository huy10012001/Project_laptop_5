@extends('layout_home')
@section( 'dell')
<style>
   
</style>

<script>

  $(document).ready(function(){
  $('#order').change(function(){

  });
});
  
   
   

   
</script>

<div class="container">
    <!--tìm theo chi tiết sản phẩm trang home-->

<div class="row">
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
    <form  action=""  id="form_product" method="get">
   
    <select name="order" id="order">
        <option value="md" selected>mặc định</option>
  <option value="desc">Gỉam dần</option>
  <option value="asc">Tăng dần</option>
  <input type="checkbox" name="vehicle1" value="Bike">
  <label for="vehicle1"> I have a bike</label><br>
  <input type="checkbox" name="vehicle2" value="Car">
  <label for="vehicle2"> I have a car</label><br>
  <input type="checkbox" name="vehicle3" value="Boat" checked>
  <label for="vehicle3"> I have a boat</label><br><br>
  <input type="submit" value="Submit">
  <input type="checkbox" name="vehicle1" value="Bike">
  <label for="vehicle1"> I have a bike</label><br>
  <input type="checkbox" name="vehicle2" value="Car">
  <label for="vehicle"> I have a car</label><br>
  <input type="checkbox" name="vehicle3" value="Boat" checked>
  <label for="vehicle3"> I have a boat</label><br><br>
 
<input type="submit" value="search" >
  </form>
</select>
            <label for="cars">Choose a car:</label>
  <ul>
       <li><a href="{{request()->fullUrlWithQuery(['price' => '1'])}}">Từ 1 triệu tới 3 triệu</a></li>
       <li><a href="{{request()->fullUrlWithQuery(['price' => '2'])}}">Trên 3 triệ</a></li>
       <li><a href="{{request()->fullUrlWithQuery(['price' => '3'])}}">Trên 5 triệ</a></li>
       <li><a href="?price=4"></a></li>
  </ul>
        </div><!--/category-products-->
 <ul>
       <li><a href="{{request()->fullUrlWithQuery(['boxuly' => '80'])}}">Bộ xử lý</a></li>
       <li><a href="?boxuly=40">Trên 3 triệ</a></li>
       <li><a href="?price=3">Trên 5 triệ</a></li>
       <li><a href="?price=4"></a></li>
  </ul>


    </div>
</div>

<div class="col-sm-9 padding-right">

    <div class="features_items"><!--features_items-->
    @if(isset($c))
        <h2 class="title text-center">sản phẩm Laptop {{$c->name}}</h2>
        <!--sản phẩm-->
    @endif
<div class="row">

 @foreach($product as $p)
<div class="col-sm-4">

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

                <li><a href="{{ URL::to('/'.Str::slug($p->name)) }}" ><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
            </ul>
        </div>
    </div>
   
</div>

@endforeach 
</div>
<div class="row">{{$product->links()}}</div>
    </div>
</div><!--features_items-->

</div>



</div>
</div>
@section('script')

@endsection
@endsection
