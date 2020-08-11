<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class order_product extends Model
{
  
  


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $table = "order_product";
    // khai báo trường khóa chính
    protected $primaryKey = array('order_id', 'product_id');
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = false;
    protected $fillable = ['order_id',
        'product_id','price','qty','amount'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    

}