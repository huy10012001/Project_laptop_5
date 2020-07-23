<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // khai báo table ứng với model
    protected $table = "cart";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id', 'amount',  'user_id', 'updated_at', 'created_at'];
  
    public function user()
    {
        return $this->hasOne('App\User','id');
    }
    public function Cart_item()
    {
        return $this->hasOne('App\Cart_item');
    }
}
