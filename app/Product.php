<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Product extends Model
{
    // khai báo table ứng với model
   
    use Sluggable;
    protected $table = "product";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id','category_id' ,'slug','name', 'price', 'description', 'image','deleted_at', 'updated_at', 'created_at'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo('App\category');
    }
    public function detail()
    {
        return $this->hasOne('App\DetailProduct');
    }
  
    public function order()
    {
        return $this->belongsToMany('App\Order')->withPivot('price', 'qty','amount');
    }
    public function cart()
    {
        return $this->belongsToMany('App\Cart')->withPivot('price', 'qty','amount');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment','product_id','id');
    }
  
}
