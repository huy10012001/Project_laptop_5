

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
 <!--
@foreach($all_category as $category)
   {{$category->product->count()}}
  @foreach($category->product as $product)
    
    @if($product->status=="0" && $product->detail!="")
      {{$product->name}} ::
      {{$product->detail}}
      <br/>
    @endif
  @endforeach
@endforeach

-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<script>
 $(document).ready(function()
{
  var x=$('.carousel');
  console.log(x.attr('id');
});
</script>

<body>
<div class="container" style="margin-bottom: 30px;">
@foreach($all_category as $category)
  
  <div class="spm">
  <h2 class="title text-center">{{$category->name}} </h2>
  </div>
  @php   
      $product=App\product::where(['category_id'=>$category->id,'status'=>"1"])
      ->join('detail_product','detail_product.product_id','=','product.id')->get()    
      @endphp

  <div id="categorycarousel{{$category->id}}" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <!--Nếu sản phẩm hoạt đang hoạt động và đã cập nhập detail -->
     
        <div class="item  row active">
          @foreach($product->take(4) as $p)
          <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$p->image) }}" alt="" />
              <h2>{{number_format($p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$p->name}}</p>
                <a onclick="AddCart('{{$p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>
            <div class="product-overlay">
              <div class="overlay-content">
                <div class="row">
                  <div class="core" >
                  <div class="col-sm-5">  <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_22.png')}}" alt="" />core 3</p></div>
                  <div class="col-sm-7"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_23.png')}}" alt="" />16.5 in</p></div>
                  </div>
                <div class="ram" >
                  <div class="col-sm-6" > <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_27.png')}}" alt="" />Intel UHD Graphics</p></div>
                  <div class="col-sm-6"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_25.png')}}" alt="" />16.5 in</p></div>
                </div>
                <div class="rom" >
                  <div class="col-sm-6" > <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_24.png')}}" alt="" />ssd 520gb</p></div>
                  <div class="col-sm-6"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_27.png')}}" alt="" />16.5 in</p></div>
                  </div>
                </div>
                <h2>{{number_format($p->price,0,",",".")}} đ</h2>
                  <p  style="word-break: break-all;" >{{$p->name}}</p>
                  <a   onclick="AddCart('{{$p->product_id}}')"     class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                </div>
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
      <div class="row  item course-set courses__row " name="{{$category->name}}">
        @foreach($product_slide2over as $p)
        <div class="col-sm-3" style="height: 500px;">
          <div class="single-products" >
            <div class="productinfo text-center">
              <img  height="200px" src="{{ url('images/'.$p->image) }}" alt="" />
              <h2>{{number_format($p->price,0,",",".")}} đ</h2>
               <p style="word-break: break-all;" >{{$p->name}}</p>
                <a onclick="AddCart('{{$p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
            </div>
            <div class="product-overlay">
              <div class="overlay-content">
                <div class="row">
                  <div class="core" >
                  <div class="col-sm-5">  <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_22.png')}}" alt="" />core 3</p></div>
                  <div class="col-sm-7"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_23.png')}}" alt="" />16.5 in</p></div>
                  </div>
                <div class="ram" >
                  <div class="col-sm-6" > <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_27.png')}}" alt="" />Intel UHD Graphics</p></div>
                  <div class="col-sm-6"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_25.png')}}" alt="" />16.5 in</p></div>
                </div>
                <div class="rom" >
                  <div class="col-sm-6" > <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_24.png')}}" alt="" />ssd 520gb</p></div>
                  <div class="col-sm-6"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_27.png')}}" alt="" />16.5 in</p></div>
                  </div>
                </div>
                <h2>{{number_format($p->price,0,",",".")}} đ</h2>
                  <p  style="word-break: break-all;" >{{$p->name}}</p>
                  <a   onclick="AddCart('{{$p->product_id}}')"     class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                </div>
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
      <a class="left carousel-control" href="#{{$category->id}}" data-slide="prev">
   
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
       
      </a>
      <a class="right carousel-control" href="#{{$category->id}}" data-slide="next">
      
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
       
      </a>
      @endif
  </div>
 
@endforeach
</div>
<script>
  
  $(document).ready(function() {
    $('.carousel').each(function()
    {
        console.log($(this).attr('id'))
    });
    /*
    var x=$(".product_category");
    var name=[];
        $(x.children()).each(function( index ) {
         var x=$(this).attr('name');
         if(!name.includes(x))
          name.push(x);
    });
    
    for (i = 0; i < name.length; i++) {
      
        var y=$("[name^="+name[i]+"]");
        $("[name^="+name[i]+"]:eq(0)").addClass("active");
        
        
    }*/
  });

</script>

</html>
