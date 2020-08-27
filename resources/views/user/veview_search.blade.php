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
   
    if(valueOrder!="")
    {
        if(valueOrder=="asc")
            valueOrder="giá thấp đến cao";
        else if(valueOrder=="desc")
            valueOrder="giá cao đến thấp";
        else
            valueOrder="Laptop mới nhất";
        $("#sapxep").text(valueOrder).append(" <span class='caret'></span>");
    }
   });
   
   $('a').each(function () {
    if ($(this).attr('href').indexOf('other') > -1) {
        var hrefStr = $(this).attr('href');
        var start_pos = hrefStr.indexOf('fruit=') + 1;
        var end_pos = hrefStr.indexOf('&',start_pos); //works as long as fruit=apple is in the middle or front of the string
        var fruit = hrefStr.substring(start_pos,end_pos);
       console.log(fruit)
        //put modified href back in <a>
    }
});
   function UrlWithOrderBy(order)
   {
       var orderBy="";
      
        if(order.text=="giá thấp đến cao")
            orderBy="asc";
        else if(order.text=="giá cao đến thấp")
            orderBy="desc";
        else if(order.text=="Laptop mới nhất")
            orderBy="new";
           //lấy url hiện tại 
       
      //  var fullUrl = window.location.href;
        //tìm vị trí orderby
       //var indexOrderBy=fullUrl.indexOf("orderby");
        //var urlwithorderBy="";
        //lấy value sau chuỗi orderby
       // if(indexOrderBy!=-1)
      //  {  
            //if(orderBy!="")
            //urlwithorderBy = fullUrl.substring(0,indexOrderBy+8)+orderBy; 
           // else
           // urlwithorderBy = fullUrl.substring(0,indexOrderBy-1); 
        
       // }
       // else
      //  {   
            //if(orderBy!="")
           // urlwithorderBy=fullUrl+"&orderby="+orderBy;
       //// }
     // window.location.href=urlwithorderBy;
        //gán value vô input 
      
   }
</script>

@if($product->count()>0)
<div class="container" style="background: rgb(255, 255, 255);">
<input type="hidden" id="keyword" value="{{$keyword}}">
@if(isset($requestorderby))
    <input type="hidden" id="orderByR" value="{{$requestorderby}}" name="orderby"> 
@else
<input type="hidden" id="orderByR"  name="orderby"> 
@endif

    <h5>tìm thấy {{$count}} sản phẩm cho từ khóa <b>{{$keyword}}</b></h5>
    <p  style="  font-size: 20px;">Sản Phẩm</p>
    <div class="row">
        <div class="col-sm-12" style="padding-right:60px;padding-bottom:10px;margin-bottom:10px; background: rgb(245, 244, 244); margin-top:-10px; ">
            <div class="dropdown" style=" float:right;">
                <button id="sapxep" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Laptop mới nhất
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
             <li><a   href="{{request()->fullUrlWithQuery(['orderby'=>'asc'])}}">giá thấp đến cao </a></a></li>
                <li> <a    href="{{request()->fullUrlWithQuery(['orderby'=>'desc'])}}">giá cao đến  thấp</a></li>
                        <li><a    href="{{request()->fullUrlWithQuery(['orderby'=>'new'])}}">Laptop mới nhất</a></li>
   
              
                </ul>
              </div>
        </div>
    </div>

 @foreach($product->chunk(4) as $products)
 <div class="row course-set courses__row">
@foreach($products as $p)

<div class="col-sm-3">

    <div class="product-image-wrapper">

        <div class="single-products">
                <div class="productinfo text-center">
                    <img  height="200px" src="{{ url('images/'.$p->image) }}" alt="" />
                    <h2>{{number_format($p->price,0,",",".")}} đ</h2>
                    <p style="word-break: break-all;" >{{$p->name}}</p>
                    <a onclick="AddCart('{{$p->product_id}}')" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
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


</div>

@endforeach

</div>
@endforeach
{{$product->links()}}


@else
không tìm thấy sản phẩm cho từ khóa {{$keyword}}

@endif
@endsection