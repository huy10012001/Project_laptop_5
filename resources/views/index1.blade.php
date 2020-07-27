

<?php
USE Illuminate\Support\Facades\DB;



//$flights=App\product::
//where('id',5)
//->get();

//$flights = App\product::find(5);
//foreach($flights->order as $p)

//echo $p->pivot->price;
//$flights = App\product::
//where('id', 4)
//->delete();

$purchases = DB::table('cart')
    ->select('cart_product.cart_id',DB::raw("SUM(cart_product.amount) as count"))
    ->join('cart_product', 'cart_product.cart_id', '=', 'cart.id')
 
    ->groupby('cart_product.cart_id')
    ->get();
  
   $carts= DB::table('cart')
    
    ->leftJoin(DB::raw('(Select cart_product.cart_id,SUM(cart_product.amount) as count
    FROM cart_product,cart
    WHERE cart.id=cart_product.cart_id
      GROUP BY (cart_product.cart_id)
      ) as T'), function ($join) {
          $join->on ( 'T.cart_id', '=', 'cart.id' );
      })
    
      ->update(['total'=>DB::raw('T.count' )]);
      
  
 /* $carts=App\cart::all();
  
  foreach($carts as $c)
  {
    $total=0;
    foreach($c::find($c->id)->product as $p)
    {
      $total +=$p->pivot->amount;
    }
    $c->total=$total;
    $c->save();
  }
   
   
  
  
 
   
/*
*/
//$flights=App\product
//::withTrashed()
//->where('id', 5)->get();


//$flights->history()->withTrashed()->get();

//$flights->history();
//echo $flights->history();

//foreach($flights->order as $p)
//echo $p->pivot->price;
?>
