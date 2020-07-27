<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class category extends Model
{
    // khai báo table ứng với model
    use SoftDeletes;
    protected $table = "category";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id', 'name', 'updated_at', 'created_at'];
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
