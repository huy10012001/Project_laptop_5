

@extends('layout_home')
@section( 'dell')
<script>


$(document).ready(function() {
    /*C1:Lưu anchor orderBy
    $('.sort').click(function(e)
    {
        var x=$(this).text();
       
        if(x=="Tăng dần")
            x="asc";
        else if(x=="giảm dần")
            x="desc";
        else
            x="default";
        localStorage.setItem('orderBy',x);
    });
    if(localStorage.getItem('orderBy'))
    {
         var x=localStorage.getItem('orderBy');
       
        $("#orderByR").val(x);
      
    }*/
    /*C2:Lấy giá trị selected orderBy
    
    $("#orderBy").change(function()
    { 
        localStorage.setItem('mySelectLocalstorageValue', $(this).val());
        
        $("#form_product").submit();
       
    });
    
    if(localStorage.getItem('mySelectLocalstorageValue'))
    {
        var x=localStorage.getItem('mySelectLocalstorageValue');
        $("#orderBy").val(x);
    }*/
    $("#form_product input").each(function(){
        var x =($(this).attr('name'));
        if(this.value=="tất-cả" && x!="tenhang[]" )
         $(this).prop('checked',true);
    });
    //checked những hãng với url hiện tại
    if(!localStorage.getItem('checked'))
    {
        var hang=$('.current_tenhang').val();
        $('input[name^="tenhang"]').each(function(){

            if(this.value==hang)
            $(this).prop('checked',true);
         });
    }
    var arr = JSON.parse(localStorage.getItem('checked')) || [];
    arr.forEach(function(checked, i) {
    $('.box').eq(i).prop('checked', checked);
  });
    //form thay đổi input
    $("#form_product input").change(function(){
    var array_name = $(this).attr("name");
    array_name=array_name.replace('[]','');
    var y=$("[name^="+array_name+"]");
    var tatCa=false;
    //check xem giá trị này có value tất cả hay không
    if($(this).prop('checked')==true&&($(this).val()=="tất-cả"))
    {
        tatCa=true;
    }
    //nếu checked value khác tất cả thì checked có value tất-cả trong input cùng tên sẽ return false
    else if($(this).prop('checked')==true)
    {
        $(y).each(function(){
          if(this.value=="tất-cả")
           { $(this).prop('checked',false);
         
           }
        });
    }
    //nếu checked value tất cả thì những checked khác trong input cùng tên sẽ return false
    if(tatCa==true)
    {
        $(y).each(function(){
          if(this.value!="tất-cả")
         $(this).prop('checked',false);
         });
    }
    var count=0;
    //đếm số checked input cùng tên
    $(y).each(function()
    {
        if($(this).prop('checked')==true)
            count+=1;
        
    });
    //nếu trong input không có value nào thì input cùng tên có value tất-cả return true
    if(count==0)
    {
        $(y).each(function(){
          if(this.value=="tất-cả")
         $(this).prop('checked',true);
         });
    }
    //lưu những checked
   var arr = $('.box').map(function() {
    return this.checked;
  }).get();
   localStorage.setItem("checked", JSON.stringify(arr));
    
    //nếu input tenhang có 1 hãng và không phải tất cả
    if(count==1 && tatCa==false &&$(this).attr("name")=="tenhang[]")
    { 
       var hang="";
        $(y).each(function()
        {
            if($(this).prop('checked')==true)
                hang=$(this).val();
               
        });
      
        $('#form_product').attr('action','/product/'+hang);
     
    }
      //nếu input tenhang có trên 1 hãng hoặc là tất cả
    if((tatCa==true ||count>1) &&$(this).attr("name")=="tenhang[]")
    { 
       $('#form_product').attr('action','/product');
       
    }

    $("#form_product").submit();
});
/*	
$("#form_product").on('submit',function(e){

    //lấy url hiện tại 
     var fullUrl = window.location.href;
    //tìm vị trí orderby
    var indexOrderBy=fullUrl.indexOf("orderby");
    var orderBy="";
    //lấy value sau chuỗi orderby
    if(indexOrderBy!=-1)
        orderBy = fullUrl.substring(indexOrderBy+8); 
    //gán value vô input 
    $("#orderByR").val(orderBy);
   })
*/
});

</script>
  
@if(isset($c->name))
<input type="hidden" class="current_tenhang" value="{{$c->name}}">
@endif

    <div class="container">
        <!--tìm theo chi tiết sản phẩm trang home-->

    <div class="row">
    <div class="col-sm-3">
        <div class="left-sidebar">

            <div class="panel-group category-products" id="accordian"><!--category-productsr-->


<form    id="form_product"   method="get">
    Lọc theo điều kiện
    <br/>
 @if(isset($all_category))

   <label for="sapxep">Tên hãng </label></br>
    <input type="checkbox" class="box all"  value="tất-cả"  class="categoryLoc" name="tenhang[]" >
    <label for="sapxep">Tất cả </label>
   <br/>

    @foreach($all_category as $all_c)

    <input type="checkbox" class="box"  value="{{$all_c->name}}"  class="categoryLoc" name="tenhang[]" >
     <label for="sapxep">{{$all_c->name}} </label>  <br/>

    @endforeach
    @endif


    <br/>
    <label for="sapxep">Mức giá</label>  <br/>
     <input type="checkbox" class="box all"  value="tất-cả"   name="price[]">
     <label for="sapxep">Tất cả </label>  <br/>
     <input type="checkbox" class="box" value="dưới-10-triệu" name="price[]" >
     <label for="sapxep" >Dưới 10 triệu </label>  <br/>
     <input type="checkbox" class="box"   value="từ-10-15-triệu" name="price[]" >
     <label for="sapxep" >Từ 10 - 15 triệu</label>  <br/>
     <input type="checkbox" class="box"  value="từ-15-20-triệu" name="price[]" >
     <label for="sapxep" >Từ 15 - 20 triệu</label>  <br/>
     <input type="checkbox"  class="box"  value="từ-20-25-triệu" name="price[]" >
     <label for="sapxep" >Từ 20 - 25 triệu</label>  <br/>
     <input type="checkbox"  class="box"  value="trên-25-triệu" name="price[]" >
     <label for="sapxep" >Trên 25    triệu</label>  <br/>
     <label for="cpu">CPU </label>
    <br/>
      <label for="sapxep">Màn hình </label>
    <br/>
     <input type="checkbox" class="box all" value="tất-cả" name="manhinh[]"  >
     <label for="sapxep" >Tất cả </label>  <br/>
     <input type="checkbox" class="box"  value="13 inch" name="manhinh[]">
     <label for="sapxep" >Khoảng 13 inch </label>  <br/>
     <input type="checkbox"  class="box" value="14 inch" name="manhinh[]" >
     <label for="sapxep" >Khoảng 14 inch</label>  <br/>
     <input type="checkbox"   class="box" value="15 inch" name="manhinh[]" >
     <label for="sapxep" >trên 15 inch</label>  <br/>

     <label for="cpu">CPU </label>
    <br/>
     <input type="checkbox" class="box all"  value="tất-cả"   name="cpu[]" >
     <label  >Tất cả </label>  <br/>
     <input type="checkbox"  class="box"  value="Intel Celeron" name="cpu[]">
     <label for="sapxep" >Intel Celeron </label><br/>
     <input type="checkbox"  class="box"   name="cpu[]"value="Intel Pentium">
     <label for="sapxep" >Intel Pentium</label> <br/>
     <input type="checkbox"  class="box"  name="cpu[]"   value="Intel Core i3">
     <label for="sapxep" >Intel Core i3</label> <br/>
     <input type="checkbox"  class="box"  name="cpu[]"  value="Intel Core i5" >
     <label for="sapxep" >Intel Core i5</label><br/>
     <input type="checkbox"  class="box"  name="cpu[]"    value="Intel Core i7">
     <label for="sapxep" >Intel Core i7</label> <br/>
     <input type="checkbox"   class="box"  name="cpu[]"    value="Intel Core i9">
     <label for="sapxep" >Intel Core i9</label> <br/>
     <input type="checkbox"  class="box"  name="cpu[]" value="AMD Ryzen 3">
     <label for="sapxep" >AMD Ryzen 3</label> <br/>
     <input type="checkbox"  class="box"  name="cpu[]"   value="AMD Ryzen 5">
     <label for="sapxep" >AMD Ryzen 5</label> <br/>
     <input type="checkbox"  class="box"  name="cpu[]"    value="AMD Ryzen 7">
     <label for="sapxep" >AMD Ryzen 7</label> <br/>
     <label for="sapxep">RAM </label>
     <br/>
     <input type="checkbox" class="box all" value="tất-cả" name="RAM[]"  >
     <label for="sapxep" >Tất cả </label>  <br/>
     <input type="checkbox" class="box"  value="4 GB" name="RAM[]">
     <label for="sapxep" >4 GB</label>  <br/>
     <input type="checkbox"  class="box" value="8 GB" name="RAM[]" >
     <label for="sapxep" >8 GB</label>  <br/>
     <input type="checkbox"   class="box" value="16 GB" name="RAM[]" >
     <label for="sapxep" >16 GB</label>  <br/>
     <input type="checkbox"   class="box" value="32 GB" name="RAM[]" >
     <label for="sapxep" >32 GB</label>  <br/>
     <label for="sapxep">Ổ cứng </label>
     <br/>
     <input type="checkbox" class="box all" value="tất-cả" name="ocung[]"  >
     <label for="sapxep" >Tất cả </label>  <br/>
     <input type="checkbox" class="box"  value="SSD 1 TB" name="ocung[]">
     <label for="sapxep" >SSD 1 TB</label>  <br/>
     <input type="checkbox"  class="box" value="SSD 512 GB" name="ocung[]" >
     <label for="sapxep" >SSD 512 GB</label>  <br/>
     <input type="checkbox"   class="box" value="SSD 256 GB" name="ocung[]" >
     <label for="sapxep" >SSD 256 GB</label>  <br/>
     <input type="checkbox"   class="box" value="SSD 128 GB" name="ocung[]" >
     <label for="sapxep" >SSD 128 GB</label>  <br/>
     @if(isset($requestorderby))
     <input type="text" id="orderByR" value="{{$requestorderby}}" name="orderby"> 
      
    @else
    <input type="text" id="orderByR"  name="orderby"> 
    @endif
  </form>
</select>

        </div><!--/category-products-->



    </div>
</div>

<div class="col-sm-9 padding-right">

    <div class="features_items"><!--features_items-->

        <h2 class="title text-center">sản phẩm laptop </h2>
        <!--sản phẩm-->
        <div class="sort" >
        
            <div class="col-sm-12" style="padding-right:60px;padding-bottom:10px;margin-bottom:10px; background: rgb(245, 244, 244); margin-top:-10px; ">
                <div class="dropdown" style=" float:right;">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><a    href="{{request()->fullUrlWithQuery(['orderby'=>'default'])}}">mặc định</option></li>
                    <li><a   href="{{request()->fullUrlWithQuery(['orderby'=>'asc'])}}">giá cao đến thấp</a></a></li>
                    <li> <a    href="{{request()->fullUrlWithQuery(['orderby'=>'desc'])}}">giá thấp đến cao</a></li>
                    <li><a    href="{{request()->fullUrlWithQuery(['orderby'=>'new'])}}">Laptop mới nhất</a></li>
       
                  
                    </ul>
                  </div>
            </div>
       

        </div>
<div class="row product_f">

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
@if($product!=[])
<div class="row">{{$product->links()}}</div>
@endif

    </div>
</div><!--features_items-->

</div>



</div>
</div>
@endsection