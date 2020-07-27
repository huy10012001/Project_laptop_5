<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

class contact_user extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "contact_user";
    // khai báo trường khóa chính
    protected $primaryKey = "id";
    // mặc định khóa chính sẽ tự động tăng
  
    protected $fillable = [
        'id','name','email','phone','address','subject','message'
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
