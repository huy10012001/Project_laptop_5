<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class category extends Model
{
    // khai báo table ứng với model
   use Sluggable;
    protected $table = "category";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id','slug','name', 'updated_at', 'created_at','deleted_at'];
    public function product()
    {
        return $this->hasMany('App\Product');
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
