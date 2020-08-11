<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
// khai báo table ứng với model
protected $table = "order";
// khai báo trường khóa chính


// mặc định khóa chính sẽ tự động tăng
public $incrementing =true;   // false: khóa chỉnh sẽ không tự động tăng
protected $fillable = ['id','total','status','date',  'user_id', 'updated_at', 'created_at'];
public function user()
{
    return $this->belongsTo('App\User');
}
public function product()
{
     

    return $this->belongsToMany('App\Product')->withPivot('price', 'qty','amount','created_at','updated_at');
   

}
public function detail()
{
    return $this->hasOne('App\DetailProduct');
}
/*public function productB()
{
     

    return $this->belongsToMany('App\Product')->withPivot('price', 'qty','amount');
   

}*/
}
