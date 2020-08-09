
<?php
  use App\Product;
  $product=Product::find(107);
 $a= json_decode($product->description,true)['1'];
echo $a

?>