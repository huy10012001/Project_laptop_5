<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "role_user";
    // khai báo trường khóa chính
    protected $primaryKey = array('user_id', 'role_id');
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = false;
    protected $fillable = ['role_id',
        'user_id'
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
