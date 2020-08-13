<?php


namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cart extends Model
{
    // khai báo table ứng với model
  public $items=[];
 
  
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
   
          'qty'=>0,
          
          //status 1 là còn hàng
          
          //thời gian order sản phẩm
          'time_at'=>time()+3600*7,
          
      ];
      if(!array_key_exists($product->id,$this->items))
      {
          $this->items[$product->id]=$item;
          //$this->items[$product->id]['time_at']= Carbon::now('Asia/Ho_Chi_Minh');
          //$this->items[$product->id]['time_at']+=1;
       
         
      }
     
      $this->items[$product->id]['qty']+=1;
     
  }
  public function update1($product,$qty)
  {
    
      $this->items[$product->id]['qty']=$qty;
    
  }
  public function Adminupdate($product,$price,$status)
  {
    $this->items[$product->id]['status']=$status;

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
  
    if($this->items[$product->id]!=null)
     {
        unset($this->items[$product->id]);
     
     }
    
    
    
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