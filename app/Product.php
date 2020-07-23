<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // khai báo table ứng với model
    protected $table = "product";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id','category_id' ,'name', 'price', 'description', 'image', 'updated_at', 'created_at'];
    public function category()
    {
        return $this->belongsTo('App\category');
    }
  
    public function order()
    {
        return $this->belongsToMany('App\Order');
    }
    public function cart_item()
    {
        return $this->belongsToMany('App\Cart_item');
    }
}
