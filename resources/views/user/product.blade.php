@extends('layout_home')
@section( 'dell')
<style>
   
</style>

<script>


function onClickBox() {
  
}

$(document).ready(function() {
    if(localStorage.getItem('mySelectLocalstorageValue'))
    {
        var x=localStorage.getItem('mySelectLocalstorageValue');
        $("#orderBy").val(x);
    }
    $("#form_product input").each(function(){
        var x =($(this).attr('name'));
        if(this.value=="tất-cả" && x!="tenhang[]" )
         $(this).prop('checked',true);
    });
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

  $(".box").click(onClickBox);

  $("#orderBy").change(function()
    { 
        localStorage.setItem('mySelectLocalstorageValue', $(this).val());
        
        $("#form_product").submit();
       
    });
    

  
  $("#form_product input").change(function(){
      
    var array_name = $(this).attr("name");
    array_name=array_name.replace('[]','');
    var y=$("[name^="+array_name+"]");
    var tatCa=false;
   
   
 
    if($(this).prop('checked')==true&&($(this).val()=="tất-cả"))
    {
        tatCa=true;
    }
    else if($(this).prop('checked')==true)
    {
        $(y).each(function(){
          if(this.value=="tất-cả")
           { $(this).prop('checked',false);
         
           }
        });
    }
    if(tatCa==true)
    {
        $(y).each(function(){
          if(this.value!="tất-cả")
         $(this).prop('checked',false);
         });
    }
    var count=0;
  
    $(y).each(function()
    {
        if($(this).prop('checked')==true)
            count+=1;
        
    });
  
    if(count==0)
    {
        $(y).each(function(){
          if(this.value=="tất-cả")
         $(this).prop('checked',true);
         });
    }
   var arr = $('.box').map(function() {
    return this.checked;
  }).get();
   localStorage.setItem("checked", JSON.stringify(arr));
    
  

  
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
    if((tatCa==true ||count>1) &&$(this).attr("name")=="tenhang[]")
    { 
       
     
      
        $('#form_product').attr('action','/product');
       
    }

        $("#form_product").submit();
});
});


    /*$( "#form_product" ).submit(function( event ) {


    /*  var url = $('#form_product').prop('action'); 
        
        url=decodeURIComponent(url);
    
        //url=url.replace(/[^\&]+(=tất-cả)/,'')
        countHang=0;
        allHang=false;
        tenHang="";
        $('input[name="tenhang"]').each(function(){
            if($(this).prop('checked')==true)
            {   
                countHang+=1;
                tenHang=$(this).val();
                if(tenHang=="tất-cả")
                    allHang=true;
            }
        })
        if(countHang<2)
        {
            url=url.replace(/(tenhang=)[^\&]+&/,'')
        }
        if(allHang=true)
        {

        }
        alert(url);
    // $('#form_product').attr('action', url)

    if(countHang==1 && allHang==false)
    {
        
        
        
    
    }
    
    });*/
   
    
    
    

    
    </script>
    <form action="">
    <label for="cars">Sắp xếp:</label>

<select name="orderby" id="orderBy">

<option  value="default">Mặc định</option>

<option value="asc">Tăng dần</option>
<option value="desc">Giảm dần</option>

</select>
</form>
@if(isset($c->name))
<input type="hidden" class="current_tenhang" value="{{$c->name}}">
@endif

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
    <form    id="form_product"   method="get">
   
<a value="default">Mặc định</option>
  
  <a  href="{{request()->fullUrlWithQuery(['orderBy'=>'asc'])}}">Tăng dần</a>
  <a    href="{{request()->fullUrlWithQuery(['orderBy'=>'desc'])}}">giảm dần</a>
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
  </form>
</select>
  
        </div><!--/category-products-->



    </div>
</div>

<div class="col-sm-9 padding-right">

    <div class="features_items"><!--features_items-->

        <h2 class="title text-center">sản phẩm laptop </h2>
        <!--sản phẩm-->
    
    
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
<div class="row">{{$product->links()}}</div>

@endsection
    </div>
</div><!--features_items-->

</div>



</div>
</div>
