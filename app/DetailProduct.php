<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    //
    protected $table = "detail_product";
    protected $primaryKey = 'id';
    
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id','description' ,'product_id'];
    public function product()
    {
    return $this->hasOne('App\Product');
    }
}
