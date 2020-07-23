<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
// khai báo table ứng với model
protected $table = "order";
// khai báo trường khóa chính
protected $primaryKey = 'id';

// mặc định khóa chính sẽ tự động tăng
public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
protected $fillable = ['id','transaction_id' ,'product_id','qty', 'amount', 'status', 'updated_at', 'created_at'];
public function transaction()
{
    return $this->hasOne('App\transaction','id');
}

public function product()
{
       
    return $this->belongsToMany('App\Product');

}

}
