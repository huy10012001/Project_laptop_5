@extends('layout_home')
@section( 'search')
<script>

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
 

   function redirectOrderSearch(order)
   {
         var orderBy="";
        if(order.text=="giá thấp đến cao")
            orderBy="asc";
        else if(order.text=="giá cao đến thấp")
            orderBy="desc";
        else if(order.text=="Laptop mới nhất")
            orderBy="new";
            //lấy query search param
        let searchParams = new URLSearchParams(window.location.search);
        searchParams=decodeURIComponent(searchParams);
    
        var param = searchParams.split('&');
        
       
        //Nếu như param chỉ có searchkeyword
        if(param.length=="1")
            window.location.href="search?"+param+"&orderby="+orderBy;
        //param có từ 2 trở lên
        //check xem orderby có ở vị trí 1 hay không
        var checkorderbyIndex1=param[1].split('=');
        orderBy="orderby="+orderBy;
        
        if(checkorderbyIndex1[0]=="orderby")
        {   
            var arr = [];
          
            param.forEach(function(element) {
                var a=element.split('=')[0];
                //nếu orderby ở vị trí 1 thì nếu mảng ở vị trí push value orerby,còn lại push value element từ param
                if(a=="orderby")
                    arr.push(orderBy);
                else
                     arr.push(element);
               
            });

        }
       
        else
        {
            var arr = [];
            //push value tham số param
            param.forEach(element => arr.push(element));
            //push value orderby vào index1
             arr.splice(1, 0, orderBy);
           
        }
        var urlQuery="";
        //lấy query từ arr
        arr.forEach(element => urlQuery+="&"+element);
        //cắt bỏ & ở vị trí đầu tiên
        urlQuery=urlQuery.substring(1,urlQuery.length);
        window.location.href="search?"+urlQuery;
       

     
     
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
             <li><a   onclick="redirectOrderSearch(this)">giá thấp đến cao</a></li>
            <li> <a     onclick="redirectOrderSearch(this)">giá cao đến thấp</a></li>
             <li><a     onclick="redirectOrderSearch(this)">Laptop mới nhất</a></li>
   
              
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
                    <div class="row">
                            <div class="core" >
                            <div class="col-sm-5">  <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_22.png')}}" alt="" />Cpu:<?php  echo json_decode($p->description,true)['3'] ?></p></div>
                            <div class="col-sm-7"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_23.png')}}" alt="" />Card màn hình:<?php  echo json_decode($p->description,true)['19'] ?></p></div>
                            </div>
                            <div class="ram" >
                            <div class="col-sm-6" > <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_27.png')}}" alt="" />Màn hình:<?php  echo json_decode($p->description,true)['21'] ?></p></div>
                            <div class="col-sm-6"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_25.png')}}" alt="" />Ổ cứng:<?php  echo json_decode($p->description,true)['16'] ?></p></div>
                            </div>
                            <div class="rom" >
                                <div class="col-sm-6" > <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_24.png')}}" alt="" />RAM:<?php  echo json_decode($p->description,true)['11'] ?></p></div>
                                <div class="col-sm-6"> <p class="core"> <img  height="40px" src="{{URL::asset('fronend/images/Screenshot_27.png')}}" alt="" />Trọng lượng:<?php  echo json_decode($p->description,true)['47'] ?></p></div>
                            </div>
``          

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


</div>

@endforeach

</div>
@endforeach
{{$product->links()}}


@else
không tìm thấy sản phẩm cho từ khóa {{$keyword}}

@endif
@endsection