<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    // khai báo table ứng với model
    protected $table = "cart_item";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id','cart_id' ,'qty', 'amount', 'status' ,'updated_at', 'created_at'];
    public function cart()
    {
        return $this->hasOne('App\Cart','id');
    }
   
    public function product()
    {
           
        return $this->belongsToMany('App\Product');
   
    }
}
