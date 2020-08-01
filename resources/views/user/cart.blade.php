
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
$(document).ready(function() {
  $('#form').submit(function(event){
    var event= $('#demo').vale();
      event.preventDefault();
      return false;
       
  });
});
</script>
<script type="text/javascript">
       
   
    function updateCart(qty,product_id,order_id)
 {
  
    $.get(
       " {{ asset('cart/update')}}",
       {
           qty:qty,order_id:order_id,product_id:product_id,
         function()
           {
               location.reload();
           }
       }
    );
 }
    function deleteCart(product_id,order_id)
 {
  

    $.get(
       " {{ asset('cart/delete')}}",
       {
         order_id:order_id,product_id:product_id,
         function()
           {
               location.reload();
           }
       }
    );
 }
</script>
<body>
    
<tbody>
</div><!-- /.container-fluid -->
   
                      
    @if(Session::has('cart'))
    <table  class="table table-bordered table-hover">
                      <thead>
                            <tr>
                                <th>Product Id</th>
                                <th>Product Price</th>
                                <th>qty</th>  
                                <th>Amount</th>
                               
                               
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
              @foreach(Session::get('cart')->items as $product)
              <tr> 
                  <tr>
                               <td> {{$product['id']}}</td>
                               @if($product['status']==1)
                               {  
                                 <td> {{$product['price']}}</td>
                                <td></td>
                                <td><input   type="number" name="qty"  id="myInput"     value="{{$product['qty']}}"
                                  oninput="updateCart(this.value,<?php echo $product['id'] ?>)"></td>
                                <td>  {{$product['amount']}} </td>
                                <td class="text-right">
                                <a class="btn btn-danger btn-sm" 
                                onclick="deleteCart(<?php echo $product['id'] ?>)">
                                         <i class="fas fa-trash"></i> Delete
                                    </a>
                                 </td>
                                
                              }
                              @else
                              {
                                
                                <td> {{$product['price']}}</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                <a class="btn btn-danger btn-sm" 
                                onclick="deleteCart(<?php echo $product['id'] ?>)">
                                         <i class="fas fa-trash"></i> Delete
                                    </a>
                                 </td>
                                </tr>
                                 
                                  <tr><Td>da het hang</Td> </tr>
                                    
                              }
                              @endif
                                
                   </tr>
              </tr>
                          
             @endforeach
             @if(Session::get('cart')->totalPrice>0)
              {{Session::get('cart')->totalPrice}}
              {{Session::get('cart')->totalQty}}
            
            @endif
             </tbody>
    </table>
    <!-- Main content -->
    @else
    @if(isset($orders)  )
    <form role="form" id="form" action="{{ url('/order') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}                   
    <section class="content">
   
        <div class="row">
            <div class="col-12">
                <div class="card">
               
                    <div class="card-body">
                        <table  class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Product Id</th>
                                <th>Product Price</th>
                                <th>Amount</th>
                                <th>qty</th>
                                <th>name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php  $countQy=0  @endphp
                            @foreach($orders->product as $p)
                            <tr> 
                               <tr>
                           
                               @if($p->trashed())
                               <td>{{ $p->pivot->product_id  }}</td>
                            
                                <td>{{ $p->pivot->price  }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $p->name  }}</td>
                                
                                <td class="text-right">
                                <a class="btn btn-danger btn-sm" 
                                onclick="deleteCart('{{$p->id}}','{{$orders->id}}',)">
                                         <i class="fas fa-trash"></i> Delete
                                    </a>
                                 </td>
                                </tr>
                                 <tr><td>Da het hang.</td></tr>
                               @else
                                <td>{{ $p->pivot->product_id  }}</td>
                          
                                <td>{{ $p->pivot->price  }}</td>
                               
                                <td>{{ $p->pivot->amount  }}</td>
                                <td>{{ $p->pivot->qty  }}</td>
                                <td><input   type="number" name="qty"  id="myInput"     value="{{ $p->pivot->qty}}"
                                  oninput="updateCart(this.value,'{{$p->id}}','{{$orders->id}}')"/></td>
                                
                                <td>{{ $p->name  }}</td>
                             
                                <td class="text-right">
                                <a class="btn btn-danger btn-sm" 
                                onclick="deleteCart('{{$p->id}}','{{$orders->id}}',)">
                                         <i class="fas fa-trash"></i> Delete
                                    </a>
                                  
                                 </td>
                                 @php  $countQy+=$p->pivot->qty @endphp
                                 @endif
                            </tr>
                          
                            
                            
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                
                            </tr>
                            </tfoot>
                        </table>
                     
                       @if($orders->total>0)
                       <input type="submit" value="Mua" class="btn btn-primary"  > 
                       <p id="demo1">{{ $orders->total  }}</p>
                       <p id="demo1">{{ $countQy  }}</p>
                      @else
                      
                      <input type="button" onclick="location.href = 'home'"  value="Tiếp tục Mua" class="btn btn-primary" href="{{ url('index/' )}}">
                     
                      @endif  
                    </div>
                    <!-- /.card-body -->
                </div>
            
            
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    
    @else
    <input type="submit" value="Tiếp tục Mua" class="btn btn-primary" href="{{ url('index/' )}}">
    @endif
  
    </form>
    @endif
</body>




</html> 