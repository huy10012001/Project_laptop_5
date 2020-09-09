

@extends('layout_home')
@section( 'dell')
<script>
    
    
let searchParams = new URLSearchParams(window.location.search);
searchParams=decodeURIComponent(searchParams);
function ChangeToSlug(title)
{
    var slug;
 
    //Lấy text từ thẻ input title 
   // title = document.getElementById("title").value;
 
    //Đổi chữ hoa thành chữ thường
    slug = title;
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\s/gi, '-');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, " - ");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
    //In slug ra textbox có id “slug”
 
}
function FindparseQuerystring(value){
   
   value= ChangeToSlug(value);
    console.log(value);
    var flag=false;
    
  
    if(searchParams!="")
    {
        var foo = searchParams.split('&');
   
    var dict = {};
    var elem = [];
    for (var i = foo.length - 1; i >= 0; i--) {
        elem = foo[i].split('=');
     
         if(elem[1].includes(value))
            flag=true;
    };  
    if(flag==true)
        return true;
    else
        return false;
    }
};

function requestOrder(order)
{
    var order=order.text;
    if(order=="giá thấp đến cao")
        order="asc";
    else if(order=="giá cao đến thấp")
        order="desc";
    else
        order="new";
    $("#orderByR").val(order);
    $("#form_product").submit();
}

  

$(document).ready(function() {
    $("#show").hide();
    setTimeout(function(){
        $('#show').fadeIn('slow');
    },1000);
    //Lấy value requesr orderby
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
        //checked những input có value-tất cả
    $("#form_product input").each(function(){
    
            if(this.value=="tất-cả" )
            $(this).prop('checked',true);
        });
    //checked tên hãng hiện tại

        var hang=$('.current_tenhang').val();
        $('input[name^="tenhang"]').each(function(){
          
            if(this.value==hang)
            {
                $(this).prop('checked',true);
               
            }
        });
        //checked những value input request 
        $("#form_product input").each(function(){
        
            if(FindparseQuerystring($(this).val())==true)
            $(this).prop('checked',true);
        });
        //nếu input cùng tên có value khác tất-cả thì checked tất-cả return false
        $("#form_product input").each(function(){
            if($(this).val()=="tất-cả")
            {
                var array_name = $(this).attr("name");
                array_name=array_name.replace('[]','');
                var y=$("[name^="+array_name+"]");
                //lấy những input cùng tên với input this
                var otherChecked=false;
                //Check xem trong input cùng tên ấy có value nào khác value tất-cả
                $(y).each(function(){
                    if($(this).val()!="tất-cả" && $(this).prop('checked')==true)
                    otherChecked=true;
                });
                if(otherChecked==true)
                    $(this).prop('checked',false);
            }
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
         /*
        if(count==0)
        {
        
            $(y).each(function(){
            if(this.value=="tất-cả")
            $(this).prop('checked',true);
            });
            if($(this).attr("name")=="tenhang[]")
            {
                $('#form_product').attr('action','/product');
            }
        }
        //lưu những checked
        /*
        
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
        */
        $("#form_product").submit();
    });
    $("#form_product").on('submit',function(e)
    {
      
        var order=$("#orderByR").val();
        if(order=="")
            $("#orderByR").val("new");
        
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
    <input type="hidden" class="current_tenhang" value="{{$c->slug}}">
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

        <input type="checkbox" class="box"  value="{{$all_c->slug}}"  class="categoryLoc" name="tenhang[]" >
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
        <input type="checkbox" class="box all"  value="tất-cả"   name="cpu[]" >
        <label  >Tất cả </label>  <br/>
        <input type="checkbox"  class="box"  value="Celeron" name="cpu[]">
        <label for="sapxep" >Intel Celeron </label><br/>
        <input type="checkbox"  class="box"   name="cpu[]"value="Pentium">
        <label for="sapxep" >Intel Pentium</label> <br/>
        <input type="checkbox"  class="box"  name="cpu[]"   value="Core i3">
        <label for="sapxep" >Intel Core i3</label> <br/>
        <input type="checkbox"  class="box"  name="cpu[]"  value="Core i5" >
        <label for="sapxep" >Intel Core i5</label><br/>
        <input type="checkbox"  class="box"  name="cpu[]"    value="Core i7">
        <label for="sapxep" >Intel Core i7</label> <br/>
        <input type="checkbox"   class="box"  name="cpu[]"    value="Core i9">
        <label for="sapxep" >Intel Core i9</label> <br/>
        <input type="checkbox"  class="box"  name="cpu[]" value="Ryzen 3">
        <label for="sapxep" >AMD Ryzen 3</label> <br/>
        <input type="checkbox"  class="box"  name="cpu[]"   value="Ryzen 5">
        <label for="sapxep" >AMD Ryzen 5</label> <br/>
        <input type="checkbox"  class="box"  name="cpu[]"    value="Ryzen 7">
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
        <input type="checkbox" class="box"  value="1 TB" name="ocung[]">
        <label for="sapxep" >SSD 1 TB</label>  <br/>
        <input type="checkbox"  class="box" value="512 GB" name="ocung[]" >
        <label for="sapxep" >SSD 512 GB</label>  <br/>
        <input type="checkbox"   class="box" value="256 GB" name="ocung[]" >
        <label for="sapxep" >SSD 256 GB</label>  <br/>
        <input type="checkbox"   class="box" value="128 GB" name="ocung[]" >
        <label for="sapxep" >SSD 128 GB</label>  <br/>
        @if(isset($requestorderby))
        <input type="hidden" id="orderByR" value="{{$requestorderby}}" name="orderby"> 
        
        @else
        <input type="hidden" id="orderByR"  name="orderby"> 
        @endif
    </form>
    </select>

            </div><!--/category-products-->



        </div>
    </div>

    <div class="col-sm-9 padding-right" id="show">

        <div class="features_items"><!--features_items-->

            <h2 class="title text-center">sản phẩm laptop </h2>
            <!--sản phẩm-->
 @if(isset($product) && $product->count()>0)

            <div class="sort" >
            
                <div class="col-sm-12" style="padding-right:60px;padding-bottom:10px;margin-bottom:10px;  margin-top:-10px; ">
                    <div class="dropdown" style=" float:right;">
                        <button  id="sapxep" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Laptop mới nhất
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                     
                        <li><a  onclick="requestOrder(this)">giá thấp đến cao</a></a></li>
                        <li> <a   onclick="requestOrder(this)">giá cao đến thấp</a></li>
                        <li><a    onclick="requestOrder(this)">Laptop mới nhất</a></li>
        
                    
                        </ul>
                    </div>
                </div>
        

            </div>
    @if(isset($count))
        Laptop {{ $count }} sản phẩm

    @foreach($product->chunk(3) as $products)
    <div class="row course-set courses__row">
    @foreach($products as $p)

    <div class="col-sm-4" style="height: 500px;">

        <div class="product-image-wrapper">

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
                <!--
                @if(strpos($p->name, '/'))
                <li><a href="{{ URL::to('/product/'.Str::slug(substr($p->name, 0, strpos($p->name, '/')))) }}" ><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
                @else
                <li><a href="{{ URL::to('/product/'.Str::slug($p->name)) }}" ><i class="fa fa-plus-square"></i>Chi tiết sản phẩm</a></li>
                @endif
                    -->
                </ul>
            </div>
        </div>

    </div>

    @endforeach
    </div>
    @endforeach


    @endif

    <div class="row">{{$product->links()}}</div>
    @else
    không tìm thấy items
    @endif

        </div>
    </div><!--features_items-->

    </div>



    </div>
    </div>
    @endsection