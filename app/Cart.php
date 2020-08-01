<?php


namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cart extends Model
{
    // khai báo table ứng với model
  public $items=[];
  public $totalQty;
  public $totalPrice;
  //public $soldout;
  public function __construct($cart=null)
 
  {
      if($cart)
      {
          $this->items=$cart->items;
          $this->totalQty=$cart->totalQty;
          $this->totalPrice=$cart->totalPrice;
      }
      else
      {
        $this->items=[];
        $this->totalQty=0;
        $this->totalPrice=0;
      }
      
  }
  public function add($product)
  {
      $item=[
          'id'=>$product->id,
          'price'=>$product->price,
          'qty'=>0,
          'amount'=>0,
          //status 1 là còn hàng
          'status'=>1,
          'deleted_at'=>null
      ];
      if(!array_key_exists($product->id,$this->items))
      {
          $this->items[$product->id]=$item;
          $this->totalQty+=1;
          $this->totalPrice+=$product->price;
         
      }
      else
      {
          $this->totalQty+=1;
          $this->totalPrice+=$product->price;

      }
      $this->items[$product->id]['qty']+=1;
      $this->items[$product->id]['amount']= $this->items[$product->id]['qty']* $this->items[$product->id]['price'];
  }
  public function update1($product,$qty)
  {
     
      $this->items[$product->id]['qty']=$qty;
      $this->items[$product->id]['amount']= $this->items[$product->id]['qty']* $this->items[$product->id]['price'];
      $sum=0;
      $qty=0;
      foreach( $this->items as $item)
      { 
        if($item['status']==1)
       { 
         $sum+=   $item['amount'];
          $qty+=$item['qty'];
       }
      }
      $this->totalPrice=$sum;
      $this->totalQty=$qty;
  }
  public function Adminupdate($product,$price)
  {
     
      $this->items[$product->id]['price']=$price;
      $this->items[$product->id]['amount']= $this->items[$product->id]['qty']* $this->items[$product->id]['price'];
      $sum=0;
      
      foreach( $this->items as $item)
      { 
        if($item['status']==1)
         $sum+=  $item['amount'];
       
      }
      $this->totalPrice=$sum;
      
  }
  public function delete1($product)
  {
    if($this->items[$product->id]['status']==1)
    {
      $this->totalPrice-=$this->items[$product->id]['amount'];
      $this->totalQty-=$this->items[$product->id]['qty'];
    }
    unset($this->items[$product->id]);
    
    
  }
  public function Admindelete($product)
  {
     
      
      $this->totalPrice-=$this->items[$product->id]['amount'];
      //0 là sold out
      $this->items[$product->id]['status']=0;
      //Ngày admin xóa sản phẩm
      $this->items[$product->id]['deleted_at']=Carbon::now();
      //Cập nhập lại số lượng
      $this->totalQty-=$this->items[$product->id]['qty'];
  }
 
}